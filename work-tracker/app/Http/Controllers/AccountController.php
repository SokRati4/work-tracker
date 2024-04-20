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

    public function details($id) {
        $user = User::find($id);
        if ($user) return view('accounts.details', ['user' => $user]);
        else return back()->with('error', 'Nie można znaleźć wybranego użytkownika');
    }
    
    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('accounts.index')->with('success', 'Konto użytkownika zostało usunięte.');
        } else {
            return redirect()->route('accounts.index')->with('error', 'Nie można znaleźć użytkownika.');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('accounts.edit', compact('user'));
        } else {
            return redirect()->route('accounts.index')->with('error', 'Nie można znaleźć użytkownika.');
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:50',
                'second_name' => 'nullable|string|max:50',
                'last_name' => 'required|string|max:50',
                'email' => 'required|email|max:255|unique:users,email,'.$id,
                'birth_date' => 'nullable|date',
                'phone' => 'nullable|string|max:12',
                'address' => 'nullable|string|max:100',
                'account_number' => 'nullable|string|max:26',
            ]);

            $user->update($validatedData);
            return redirect()->route('accounts.details', $user->id)->with('success', 'Dane użytkownika zostały zaktualizowane.');
        } else {
            return redirect()->route('accounts.index')->with('error', 'Nie można znaleźć użytkownika.');
        }
    }
}
