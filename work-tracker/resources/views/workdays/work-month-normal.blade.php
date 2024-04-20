@extends('layouts.app')

@section('content')
    <h1>Praca w miesiącu {{ $month }} {{ $year }} - {{ $user->first_name }} {{ $user->last_name }}</h1>

    @foreach(range(1, $daysInMonth) as $day)
        <div>
            <h2>{{ $day }}. {{ $month }} {{ $year }}</h2>

            @php
                $workday = $workdays->firstWhere('date', Carbon\Carbon::createFromDate($year, $month, $day)->format('Y-m-d'));
            @endphp

            @if ($workday)
                <p>{{ $workday->attendance === 1 ? "Obecność" : "Nieobecność" }}</p>
                <p>
                    @if ($workday->attendance === 1)
                        Godziny: {{ $workday->hours }}
                    @else
                        Typ nieobecności: {{ $workday->absenceType->name }}
                    @endif
                </p>
            @endif
        </div>
    @endforeach
@endsection
