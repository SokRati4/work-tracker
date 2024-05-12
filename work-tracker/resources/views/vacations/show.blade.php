@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Szczegóły prośby</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Pole</th>
                    <th>Zawartość</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>{{ $vacationRequest->id }}</td>
                </tr>
                <tr>
                    <td>User</td>
                    <td>{{ $vacationRequest->user->first_name }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $vacationRequest->status }}</td>
                </tr>
                <tr>
                    <td>Absence Type</td>
                    <td>{{ $vacationRequest->absenceType->name }}</td>
                </tr>
                <tr>
                    <td>Date From</td>
                    <td>{{ $vacationRequest->date_from }}</td>
                </tr>
                <tr>
                    <td>Date To</td>
                    <td>{{ $vacationRequest->date_to }}</td>
                </tr>
                <tr>
                    <td>Text</td>
                    <td>{{ $vacationRequest->text }}</td>
                </tr>
            </tbody>
        </table>
        @if(Auth::user()->role == 2 || Auth::user()->role == 3)
        <form action="{{ route('vacations.changeStatus', ['id' => $vacationRequest->id]) }}" method="POST">
            @csrf

            <label for="status">Nowy status:</label><br>
            <select id="status" name="status">
                <option value="accepted">Zatwierdzony</option>
                <option value="rejected">Odrzucony</option>
            </select><br><br>

            <button type="submit">Zmień status</button>
        </form>
@endif
    </div>
@endsection