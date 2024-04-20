<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Employment;

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

        foreach ($employments as $employment) {
              // Pobieramy daty z umowy
            $startDate = $employment->start_date;
            $endDate = $employment->end_date;

            // Tworzymy obiekt daty dla start_date
            $startDateTime = new \DateTime($startDate);

            // Sprawdzamy, czy end_date jest ustawione, jeśli nie to bierzemy dzisiaj
            $endDateTime = $endDate ? new \DateTime($endDate) : new \DateTime();

            // Pobieramy różnicę w miesiącach między datami
            $interval = $startDateTime->diff($endDateTime);
            $numMonths = $interval->format('%m');

            // Dodajemy miesiące do tablicy
            for ($i = 0; $i <= $numMonths; $i++) {
                $currentMonth = $startDateTime->format('m');
                $currentMonthName = $startDateTime->format('F');

                $months[$currentMonth] = $currentMonthName;

                // Przechodzimy do następnego miesiąca
                $startDateTime->modify('+1 month');
            }
        }

        // Usuwamy duplikaty z listy miesięcy
        $uniqueMonths = array_unique($months);
        

        return view('employees.employee', [
            'employee' => $employee,
            'uniqueMonths' => $uniqueMonths,
        ]);
    }
}
