@extends('layouts.app')

@section('content')
<div>
    <p>
        {{ $employee->first_name }} {{ $employee->last_name }}
        @if ($currentEmployment === null)
            <a href="{{ route('employments.create-employment', $employee->id) }}">Dodaj nowe zatrudnienie</a>
        @endif
    </p>

    <ul>
        @foreach($uniqueMonths as $monthKey => $monthName)
            @php
                list($monthNumber, $year) = explode('-', $monthKey);
            @endphp
            <li>
                <a href="{{ route('workdays.work-month', ['id' => $employee->id, 'month' => $monthNumber, 'year' => $year]) }}">{{ $monthNumber }} - {{ $monthName }} - {{ $year }}</a>
                <ul>
                    @foreach($vacations as $vacation)
                        @php
                            $vacationMonth = date('m', strtotime($vacation->date_from));
                            $vacationYear = date('Y', strtotime($vacation->date_from));
                        @endphp
                        @if ($vacationMonth == $monthNumber && $vacationYear == $year)
                            <li>{{ $vacation->date_from }} - {{ $vacation->date_to }}</li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
    
</div>
@endsection