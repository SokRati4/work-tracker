<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Employment;
use App\Models\Vacation;
use Carbon\Carbon;


use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('accepted', 1)->get();

        return view('employees.index', ['employees' => $employees]);
    }

    public function employee($id) {
        $employee = User::find($id);
        if (!$employee) return redirect()->route('employees.index')->with('error', 'Nie można znaleźć użytkownika.');
        
        $employments = Employment::where('id_user', $id)->get();
        $months = [];
    
        $currentEmployment = Employment::where('id_user', $id)
            ->where(function ($query) {
                $query->where('end_date', '>=', now()) // Umowa kończy się po dzisiejszej dacie
                      ->orWhereNull('end_date'); // Umowa nie ma ustalonej daty zakończenia
            })
            ->first();
    
        foreach ($employments as $employment) {
            // Pobieramy daty z umowy
            $startDate = Carbon::parse($employment->start_date);
            $endDate = $employment->end_date ? Carbon::parse($employment->end_date) : now();
    
            // Iterujemy przez każdy miesiąc między startDate i endDate
            while ($startDate->lessThanOrEqualTo($endDate)) {
                $currentMonth = $startDate->format('m');
                $currentYear = $startDate->format('Y');
                $currentMonthName = $startDate->format('F');

                // Klucz w postaci "miesiąc-rok", wartość to nazwa miesiąca
                $months["$currentMonth-$currentYear"] = $currentMonthName;

                // Przechodzimy do następnego miesiąca
                $startDate->addMonth();
            }
        }
    
        // Usuwamy duplikaty z listy miesięcy
        $uniqueMonths = $months;
    
        // Pobieramy wszystkie urlopy pracownika
        $vacations = Vacation::where('id_user', $id)->get();
    
        return view('employees.employee', [
            'employee' => $employee,
            'uniqueMonths' => $uniqueMonths,
            'currentEmployment' => $currentEmployment,
            'vacations' => $vacations,
        ]);
    }

    public function myMonths() {
        $id = auth()->id();
        $employee = auth()->user();

        if (!$employee) return redirect()->route('home')->with('error', 'Coś poszło nie tak.');
        
        $employments = Employment::where('id_user', $id)->get();
        $months = [];

        $currentEmployment = Employment::where('id_user', $id)
        ->where(function ($query) {
            $query->where('end_date', '>=', now()) // Umowa kończy się po dzisiejszej dacie
                  ->orWhereNull('end_date'); // Umowa nie ma ustalonej daty zakończenia
        })
        ->first();

        foreach ($employments as $employment) {
              // Pobieramy daty z umowy
            $startDate = Carbon::parse($employment->start_date);
            $endDate = $employment->end_date ? Carbon::parse($employment->end_date) : now();
    
            // Iterujemy przez każdy miesiąc między startDate i endDate
            while ($startDate->lessThanOrEqualTo($endDate)) {
                $currentMonth = $startDate->format('m');
                $currentYear = $startDate->format('Y');
                $currentMonthName = $startDate->format('F');

                // Klucz w postaci "miesiąc-rok", wartość to nazwa miesiąca
                $months["$currentMonth-$currentYear"] = $currentMonthName;

                // Przechodzimy do następnego miesiąca
                $startDate->addMonth();
            }
        }

        // Usuwamy duplikaty z listy miesięcy
        $uniqueMonths = array_unique($months);
        
        
        return view('employees.my-months', [
            'employee' => $employee,
            'uniqueMonths' => $uniqueMonths,
            'currentEmployment' => $currentEmployment,
            
            
        ]);
    }
}
