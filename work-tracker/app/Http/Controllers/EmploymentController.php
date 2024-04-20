<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employment;

class EmploymentController extends Controller
{
    public function index() {
        $employments = Employment::all();

        return view('employments.index', ['employments' => $employments]);
    }

    public function createEmployment($id) {
        $employee = User::find($id);
        if (!$employee) {
            return redirect()->route('employees.index')->with('error', 'Nie można znaleźć użytkownika.');
        }

        return view('employments.create-employment', [
            'employee' => $employee,
        ]);
    }

    public function storeEmployment(Request $request)
    {   
        // $data = [
        //     'id_user' => $request->id_user,
        //     'contract_type' => $request->contract_type,
        //     'position' => $request->position,
        //     'period_month' => $request->period_month,
        //     'start_date' => $request->start_date,
        //     'end_date' => $request->end_date,
        //     'rate' => $request->rate,
        //     'job_description' => $request->job_description,
        // ];
        // var_dump($data); exit();
        
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'contract_type' => 'required|string',
            'position' => 'required|string',
            'period_month' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'rate' => 'required|numeric',
            'job_description' => 'required|string',
        ]);

        $rate = (float) $request->rate;
        
        
        Employment::create([
            'id_user' => $request->id_user,
            'contract_type' => $request->contract_type,
            'position' => $request->position,
            'period_month' => $request->period_month,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'rate' => $request->rate,
            'job_description' => $request->job_description,
        ]);

        return redirect()->route('employments.index')->with('success', 'Zatrudnienie dodane pomyślnie.');
    }

    public function details($id) {
        $employment = Employment::find($id);

        if (!$employment) return redirect()->route('employments.index')->with('error', 'Nie znaleziono wybranego zatrudnienia.');
    
        return view('employments.details', ['employment' => $employment]);
    }
}
