<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Employment;
use App\Models\Vacation;


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
            $startDate = $employment->start_date;
            $endDate = $employment->end_date ? $employment->end_date : now()->format('Y-m-d');
    
            // Tworzymy obiekt daty dla start_date
            $startDateTime = new \DateTime($startDate);
    
            // Sprawdzamy, czy end_date jest ustawione, jeśli nie to bierzemy dzisiaj
            $endDateTime = new \DateTime($endDate);
    
            // Pobieramy różnicę w miesiącach między datami
            $interval = $startDateTime->diff($endDateTime);
            $numMonths = $interval->format('%m');
    
            // Dodajemy miesiące do tablicy
            for ($i = 0; $i <= $numMonths; $i++) {
                $currentMonth = $startDateTime->format('m');
                $currentYear = $startDateTime->format('Y');
                $currentMonthName = $startDateTime->format('F');
    
                if ($startDateTime->format('Y-m') <= now()->format('Y-m')) {
                    // Klucz w postaci "miesiąc-rok", wartość to nazwa miesiąca
                    $months["$currentMonth-$currentYear"] = $currentMonthName;
                }
    
                // Przechodzimy do następnego miesiąca
                $startDateTime->modify('+1 month');
            }
        }
    
        // Usuwamy duplikaty z listy miesięcy
        $uniqueMonths = array_unique($months);
    
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
            $startDate = $employment->start_date;
            $endDate = $employment->end_date ? $employment->end_date : now()->format('Y-m-d');

            // Tworzymy obiekt daty dla start_date
            $startDateTime = new \DateTime($startDate);

            // Sprawdzamy, czy end_date jest ustawione, jeśli nie to bierzemy dzisiaj
            $endDateTime = new \DateTime($endDate);

            // Pobieramy różnicę w miesiącach między datami
            $interval = $startDateTime->diff($endDateTime);
            $numMonths = $interval->format('%m');

            // Dodajemy miesiące do tablicy
            for ($i = 0; $i <= $numMonths; $i++) {
                $currentMonth = $startDateTime->format('m');
                $currentYear = $startDateTime->format('Y');
                $currentMonthName = $startDateTime->format('F');

                if ($startDateTime->format('Y-m') <= now()->format('Y-m')) {
                    // Klucz w postaci "miesiąc-rok", wartość to nazwa miesiąca
                    $months["$currentMonth-$currentYear"] = $currentMonthName;
                }

                // Przechodzimy do następnego miesiąca
                $startDateTime->modify('+1 month');
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
