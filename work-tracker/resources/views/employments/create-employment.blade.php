@extends('layouts.app')

@section('content')
<div>
    <h1>Dodaj nowe zatrudnienie dla: {{ $employee->first_name }} {{ $employee->last_name }}</h1>

    <form action="{{ route('employments.store-employment') }}" method="POST">
        @csrf
        <input type="hidden" name="id_user" value="{{ $employee->id }}">

        <div>
            <label for="contract_type">Typ umowy:</label>
            <input type="text" name="contract_type" id="contract_type" required>
        </div>

        <div>
            <label for="position">Stanowisko:</label>
            <input type="text" name="position" id="position" required>
        </div>

        <div>
            <label for="period_month">Okres miesięcy:</label>
            <input type="number" name="period_month" id="period_month" required>
        </div>

        <div>
            <label for="start_date">Data rozpoczęcia:</label>
            <input type="date" name="start_date" id="start_date" required>
        </div>

        <div>
            <label for="end_date">Data zakończenia:</label>
            <input type="date" name="end_date" id="end_date">
        </div>

        <div>
            <label for="rate">Stawka:</label>
            <input type="number" name="rate" id="rate" required>
        </div>

        <div>
            <label for="job_description">Opis stanowiska:</label>
            <textarea name="job_description" id="job_description" required></textarea>
        </div>

        <button type="submit">Dodaj Zatrudnienie</button>
    </form>
</div>
@endsection