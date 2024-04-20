@extends('layouts.app')

@section('content')
<div>
    <h1>Edycja danych użytkownika: {{ $user->first_name }} {{ $user->last_name }}</h1>

    <form action="{{ route('accounts.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="first_name">Imię:</label>
            <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">
        </div>

        <div>
            <label for="second_name">Drugie Imię:</label>
            <input type="text" id="second_name" name="second_name" value="{{ $user->second_name }}">
        </div>

        <div>
            <label for="last_name">Nazwisko:</label>
            <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}">
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}">
        </div>

        <div>
            <label for="birth_date">Data Urodzenia:</label>
            <input type="date" id="birth_date" name="birth_date" value="{{ $user->birth_date }}">
        </div>

        <div>
            <label for="phone">Numer Telefonu:</label>
            <input type="number" id="phone" name="phone" value="{{ $user->phone }}">
        </div>

        <div>
            <label for="address">Adres:</label>
            <input type="text" id="address" name="address" value="{{ $user->address }}">
        </div>

        <div>
            <label for="account_number">Numer Konta:</label>
            <input type="number" id="account_number" name="account_number" value="{{ $user->account_number }}">
        </div>

        <button type="submit">Zapisz zmiany</button>
    </form>
</div>
@endsection
