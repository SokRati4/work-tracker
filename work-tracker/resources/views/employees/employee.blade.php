@extends('layouts.app')

@section('content')
<div>
    <p>
        {{ $employee->first_name }} {{ $employee->last_name }}
        @if ($currentEmployment === null)
            <a href="{{ route('employments.create-employment', $employee->id) }}">Dodaj nowe zatrudnienie</a>
        @endif
    </p>


    @foreach($uniqueMonths as $monthNumber => $monthName)
        <li>{{ $monthNumber }} - {{ $monthName }}</li>
    @endforeach

</div>
@endsection