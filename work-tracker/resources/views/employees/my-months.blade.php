@extends('layouts.app')

@section('content')
<div>
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
    <p>
        {{ $employee->first_name }} {{ $employee->last_name }}
        @if ($currentEmployment === null)
            <p>Aktualnie nie jesteś w trakcie żadnej umowy</p>
        @endif
    </p>


    <ul>
        @foreach($uniqueMonths as $monthKey => $monthName)
            @php
                list($monthNumber, $year) = explode('-', $monthKey);
            @endphp
            <li>
                <a href="{{ route('workdays.work-month-normal', ['month' => $monthNumber, 'year' => $year]) }}">{{ $monthNumber }} - {{ $monthName }} - {{ $year }}</a>
            </li>
        @endforeach
    </ul>

</div>
@endsection