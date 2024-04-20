<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountController extends Controller
{
    public function index() {
        $users = User::all(); // Pobranie wszystkich użytkowników

        return view('accounts.index', ['users' => $users]);
    }

    public function accept($id) {
        $user = User::find($id);
        if ($user) {
            $user->update(['accepted' => 1]);
            return back()->with('success', 'Użytkownik został zaakceptowany.');
        } else {
            return back()->with('error', 'Nie można znaleźć użytkownika.');
        }
    }
    
}
