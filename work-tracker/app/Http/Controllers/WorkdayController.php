<?php

namespace App\Http\Controllers;

use App\Models\AbsenceType;
use App\Models\Employment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Workday;

class WorkdayController extends Controller
{
    public function workMonth($id, $month, $year) {

        $user = User::find($id);
        if (!$user) return redirect()->route('employees.index')->with('error', 'Nie można znaleźć użytkownika.');

        // Sprawdzamy, czy podane wartości miesiąca i roku są poprawne
        if (!checkdate($month, 1, $year)) {
            // Niepoprawny miesiąc lub rok
            return redirect()->route('employees.index')->with('error', 'Niepoprawny miesiąc lub rok.');
        }

        $employments = Employment::where('id_user', $id)->get();
        $employmentDates = [];
        foreach ($employments as $employment) {
            $start = new \DateTime($employment->start_date);
            $end = $employment->end_date ? new \DateTime($employment->end_date) : now();
            $interval = $start->diff($end);

            for ($i = 0; $i <= $interval->m; $i++) {
                $currentMonth = $start->format('m');
                $currentYear = $start->format('Y');
                $employmentDates["$currentMonth-$currentYear"] = $start->format('F Y');
                $start->modify('+1 month');
            }
        }
        // var_dump($employmentDates);
        // var_dump("$month-$year"); exit();
        $employmentExists = array_key_exists("$month-$year", $employmentDates);

        // Jeśli rekord zatrudnienia nie istnieje, przekieruj do odpowiedniego widoku z informacją
        if (!$employmentExists) {
            return redirect()->route('employees.index')->with('error', 'Nie znaleziono użytkownika pracującego w tym terminie.');
        }

        // Pobieramy ilość dni w danym miesiącu i roku
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Pobieramy wszystkie rekordy z tabeli workdays dla danego roku, miesiąca i użytkownika
        $workdays = Workday::where('id_user', $id)
                        ->whereMonth('date', $month)
                        ->whereYear('date', $year)
                        ->get();

        $absenceTypes = AbsenceType::all();

        return view('workdays.work-month', ['workdays' => $workdays, 'daysInMonth' => $daysInMonth, 'user' => $user, 'absenceTypes' => $absenceTypes, 'month' => $month, 'year' => $year]);
    }

    public function update(Request $request) {
        $user = User::find($request->input('user_id'));
        if (!$user) return redirect()->route('employees.index')->with('error', 'Nie można znaleźć użytkownika.');

        // Pobierz dane z żądania
        $userId = $request->input('user_id');
        $date = $request->input('date');
        $monthNumber = $request->input('month_number');
        $attendance = $request->input('attendance');
        $hours = $request->input('hours');
        $absenceType = $request->input('absence_type');
        $notes = $request->input('notes');

        // Sprawdź, czy istnieje rekord dla danego użytkownika i daty
        $workday = Workday::where('id_user', $userId)
            ->where('date', $date)
            ->first();

        // Jeśli nie ma, utwórz nowy rekord
        if (!$workday) {
            $workday = new Workday();
            $workday->id_user = $userId;
            $workday->date = $date;
        }

        // Walidacja na poziomie kontrolera
        if ($attendance == 1) {
            if ($hours <= 0) {
                return redirect()->back()->with('error', 'Ilość godzin musi być większa od zera.');
            }
            // Jeżeli jest obecny, ustaw godziny i typ absencji na null
            $workday->hours = $hours;
            $workday->id_absence_type = null;
        } elseif ($attendance == 0) {
            // Jeżeli jest nieobecny, ustaw godziny na null
            $workday->hours = null;
            // Sprawdź, czy wybrano typ absencji
            if ($absenceType === null || $absenceType === '') {
                return redirect()->back()->with('error', 'Wybierz typ absencji.');
            }
            $workday->id_absence_type = $absenceType;
        }

        // Zaktualizuj pozostałe pola
        $workday->attendance = $attendance;
        $workday->notes = $notes;
        $workday->month = $monthNumber;
        $workday->save();

        // Przekieruj użytkownika po zapisaniu
        return redirect()->back()->with('success', 'Dane zaktualizowane pomyślnie.');
    }

    public function workMonthNormal($month, $year) {
        
        $id = auth()->id();
        $user = auth()->user();

        if (!$user) return redirect()->route('employees.my-months')->with('error', 'Coś poszło nie tak.');

        // Sprawdzamy, czy podane wartości miesiąca i roku są poprawne
        if (!checkdate($month, 1, $year)) {
            // Niepoprawny miesiąc lub rok
            return redirect()->route('employees.my-months')->with('error', 'Niepoprawny miesiąc lub rok.');
        }

        $employments = Employment::where('id_user', $id)->get();
        $employmentDates = [];
        foreach ($employments as $employment) {
            $start = new \DateTime($employment->start_date);
            $end = $employment->end_date ? new \DateTime($employment->end_date) : now();
            $interval = $start->diff($end);

            for ($i = 0; $i <= $interval->m; $i++) {
                $currentMonth = $start->format('m');
                $currentYear = $start->format('Y');
                $employmentDates["$currentMonth-$currentYear"] = $start->format('F Y');
                $start->modify('+1 month');
            }
        }
        // var_dump($employmentDates);
        // var_dump("$month-$year"); exit();
        $employmentExists = array_key_exists("$month-$year", $employmentDates);

        // Jeśli rekord zatrudnienia nie istnieje, przekieruj do odpowiedniego widoku z informacją
        if (!$employmentExists) {
            return redirect()->route('home')->with('error', 'Coś poszło nie tak');
        }

        // Pobieramy ilość dni w danym miesiącu i roku
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Pobieramy wszystkie rekordy z tabeli workdays dla danego roku, miesiąca i użytkownika
        $workdays = Workday::where('id_user', $id)
                        ->whereMonth('date', $month)
                        ->whereYear('date', $year)
                        ->get();

        $absenceTypes = AbsenceType::all();

        return view('workdays.work-month-normal', ['workdays' => $workdays, 'daysInMonth' => $daysInMonth, 'user' => $user, 'absenceTypes' => $absenceTypes, 'month' => $month, 'year' => $year]);
    }
}
