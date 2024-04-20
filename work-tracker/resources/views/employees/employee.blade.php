@extends('layouts.app')

@section('content')
<div>
    <p>{{ $employee->first_name }} {{ $employee->last_name }}</p>


    @foreach($uniqueMonths as $monthNumber => $monthName)
        <li>{{ $monthNumber }} - {{ $monthName }}</li>
    @endforeach

</div>
@endsection