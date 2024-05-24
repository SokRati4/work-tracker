<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VacationRequest;
use App\Models\User;
use App\Models\AbsenceType;
use Illuminate\Support\Facades\Auth;
use App\Models\Vacation;
use App\Models\Employment;
use App\Models\WorkDay;
use Carbon\Carbon;


class VacationController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        // Sprawdź, czy istnieje rekord zatrudnienia dla użytkownika
        $employment = Employment::where('id_user', $user->id)->first();

        if ($employment) {
            $absenceTypes = AbsenceType::all();
            return view('vacations.create',['absenceTypes' => $absenceTypes]);
        } else {
            
            return redirect()->back()->with('error', 'Nie jesteś nawet zatrudniony');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Pobierz zalogowanego użytkownika
        $user = Auth::user();

        // Utwórz nową prośbę urlopową na podstawie danych przekazanych przez formularz
        $vacationRequest = new VacationRequest();
        $vacationRequest->id_user = $user->id;
        $vacationRequest->status = 'waiting'; // Domyślnie ustaw status na "waiting"
        // Dodaj inne wymagane dane z formularza
        $vacationRequest->date_from = $request->input('start_date');
        $vacationRequest->date_to = $request->input('end_date');
        $vacationRequest->id_absence_type = $request->input('absence_type');
        $vacationRequest->text = $request->input('text');
        $vacationRequest->save();

        // Przekieruj użytkownika po zapisaniu
        return redirect()->back()->with('success', 'Prośba urlopową została pomyślnie złożona.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Pobierz zalogowanego użytkownika
        $user = Auth::user();

        // Pobierz prośbę urlopową na podstawie jej identyfikatora
        $vacationRequest = VacationRequest::findOrFail($id);

        

        // Zwróć widok z danymi prośby urlopowej
        return view('vacations.show', ['vacationRequest' => $vacationRequest]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pobierz zalogowanego użytkownika
        $user = Auth::user();

        // Pobierz wszystkie prośby urlopowe przesłane przez zalogowanego użytkownika
        $vacationRequests = VacationRequest::where('id_user', $user->id)->get();

        // Zwróć widok z listą prośb urlopowych
        return view('vacations.index', ['vacationRequests' => $vacationRequests]);
    }

    /**
     * Display a listing of the resource for admins.
     */
    public function adminIndex()
    {
        // Pobierz wszystkie prośby urlopowe
        $vacationRequests = VacationRequest::all();

        // Zwróć widok z listą prośb urlopowych dla administratora
        return view('vacations.index', ['vacationRequests' => $vacationRequests]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function changeStatus(Request $request, $id)
    {
        // Pobierz prośbę urlopową na podstawie jej identyfikatora
        $vacationRequest = VacationRequest::findOrFail($id);

        // Sprawdź, czy przesłana wartość statusu jest prawidłowa
        $validatedData = $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        // Zaktualizuj pole status w rekordzie prośby urlopowej
        $vacationRequest->status = $validatedData['status'];
        $vacationRequest->save();

        $vacation = new Vacation();
        $vacation->id_user = $vacationRequest->id_user;
        $vacation->id_absence_type = $vacationRequest->id_absence_type;
        $vacation->date_from = $vacationRequest->date_from;
        $vacation->date_to = $vacationRequest->date_to;
        $vacation->save();

        // Tworzenie rekordów w tabeli WorkDay dla każdego dnia urlopu
        $startDate = Carbon::parse($vacationRequest->date_from);
        $endDate = Carbon::parse($vacationRequest->date_to);

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $workDay = new WorkDay();
            $workDay->id_user = $vacationRequest->id_user;
            $workDay->date = $date->toDateString();
            $workDay->attendance = 0; // Przykładowa wartość
            $workDay->hours = 0; // Zakładając, że w dniu urlopu nie ma godzin pracy
            $workDay->id_absence_type = $vacationRequest->id_absence_type;
            $workDay->notes = ""; // Przykładowa wartość
            $workDay->month = $date->format('m'); // Miesiąc jako numer
            $workDay->save();
        }

        // Przekieruj użytkownika po zapisaniu
        return redirect()->back()->with('success', 'Status prośby urlopowej został pomyślnie zmieniony.');
    }
}
