<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\WorkDay;
use App\Models\User;


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

        // Pobierz rekordy WorkDay dla aktualnego miesiąca i zalogowanego użytkownika
        $workdays = WorkDay::where('id_user', $userId)
            ->whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->get();

        // Zsumuj godziny
        $totalHours = $workdays->sum('hours');


        // Liczba pracowników do zaakceptowania
        $toAccept = User::where('accepted', 0)->count();

        return view('home', [
            'totalHours' => $totalHours,
            'toAccept' => $toAccept,
        ]);
    }
}
