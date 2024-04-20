<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::all(); // Pobranie wszystkich użytkowników

        return view('employees.index', ['employees' => $employees]);
    }
}
