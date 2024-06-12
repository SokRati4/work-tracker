<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\WorkDay;
use App\Models\User;
use App\Models\VacationRequest;
use App\Models\Vacation;
use App\Models\Message;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();

        // Pobierz aktualny miesiąc i rok
        $currentMonth = Carbon::now()->format('m'); // Aktualny miesiąc w formacie 01, 02, itd.
        $currentYear = Carbon::now()->format('Y');  // Aktualny rok
        $currentDateTime = Carbon::now();

        // Pobierz rekordy WorkDay dla aktualnego miesiąca i zalogowanego użytkownika
        $workdays = WorkDay::where('id_user', $userId)
            ->whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->get();

        // Zsumuj godziny
        $totalHours = $workdays->sum('hours');


        // Liczba pracowników do zaakceptowania
        $toAccept = User::where('accepted', 0)->count();
        $vacation_requests = VacationRequest::all()->count();
        $requests_toaccept = VacationRequest::where('status','waiting')->count();
        $incomming_vacations = Vacation::where('id_user',$userId)
            ->where('date_from', '>', $currentDateTime)
            ->count();
        
        $chats = Message::where('id_user_sender', $userId)
        ->orWhere('id_user_receiver', $userId)
        ->distinct('id_thread')
        ->count('id_thread');
        $unread_messages = Message::where('status','sent')
        ->where('id_user_receiver',$userId)
        ->count();
        return view('home', [
            'totalHours' => $totalHours,
            'toAccept' => $toAccept,
            'vacation_requests' =>$vacation_requests,
            'requests_toaccept' =>$requests_toaccept,
            'incomming_vacations' => $incomming_vacations,
            'chats' =>$chats,
            'unread_messages' => $unread_messages,
        ]);
    }
}
