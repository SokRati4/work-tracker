@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    <h1>Praca w miesiącu {{ $month }} {{ $year }} - {{ $user->first_name }} {{ $user->last_name }}</h1>

    @foreach(range(1, $daysInMonth) as $day)
        <div>
            <h2>{{ $day }}. {{ $month }} {{ $year }}</h2>

            @php
                $workday = $workdays->firstWhere('date', Carbon\Carbon::createFromDate($year, $month, $day)->format('Y-m-d'));
            @endphp

            <form method="POST" action="{{ route('workdays.update') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="date" value="{{ "$year-$month-$day" }}">
                <input type="hidden" name="month_number" value="{{ $month }}">

                <div>
                    <label>
                        <input type="radio" name="attendance" value="1" {{ $workday && $workday->attendance == 1 ? 'checked' : '' }}>
                        Obecny
                    </label>
                    <label>
                        <input type="radio" name="attendance" value="0" {{ $workday && $workday->attendance == 0 ? 'checked' : '' }}>
                        Nieobecny
                    </label>
                </div>
                <div>
                    <label for="hours">Godziny przepracowane:</label>
                    <input type="number" name="hours" id="hours" value="{{ $workday ? $workday->hours : '' }}">
                </div>
                <div>
                    <label for="absence_type">Typ absencji:</label>
                    <select name="absence_type" id="absence_type">
                        <option value="">Brak</option>    
                        @foreach ($absenceTypes as $absenceType)
                            <option value="{{ $absenceType->id }}" {{ $workday && $workday->id_absence_type == $absenceType->id ? 'selected' : '' }}>
                                {{ $absenceType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="notes">Notatka:</label>
                    <input type="text" name="notes" id="notes" value="{{ $workday ? $workday->notes : '' }}">
                </div>

                <button type="submit">Zapisz</button>
            </form>
        </div>
    @endforeach
@endsection
