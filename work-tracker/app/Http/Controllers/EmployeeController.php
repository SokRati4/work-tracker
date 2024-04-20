<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('accepted', 1)->get();

        return view('employees.index', ['employees' => $employees]);
    }
}
