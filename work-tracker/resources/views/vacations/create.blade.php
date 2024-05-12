@extends('layouts.app')
@section('content')
    <h1>Nowa Prośba Urlopowana</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('vacations.store') }}" method="POST">
        @csrf

        <!-- Ukryte pole user_id z wartością ID zalogowanego użytkownika -->
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <!-- Status domyślnie ustawiony na "waiting" -->
        <input type="hidden" name="status" value="waiting">

        <label for="start_date">Data Rozpoczęcia:</label><br>
        <input type="date" id="start_date" name="start_date"><br><br>

        <label for="end_date">Data Zakończenia:</label><br>
        <input type="date" id="end_date" name="end_date"><br><br>

        <label for="absence_type">Typ nieobecności:</label><br>
        <select id="absence_type" name="absence_type">
            @foreach($absenceTypes as $absenceType)
                <option value="{{ $absenceType->id }}">{{ $absenceType->name }}</option>
            @endforeach
        </select><br><br>
    <div>
        <label for="text">Notatka:</label>
        <input type="text" name="text" id="text">
    </div>
    <br>

        <button type="submit">Wyślij Prośbę</button>
    </form>
    @endsection