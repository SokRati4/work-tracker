@extends('layouts.app')

@section('content')
<div>
    <h1>Lista Pracowników</h1>

    <ul>
        @foreach ($employees as $employee)
            <li>{{ $employee->login }} - {{ $employee->email }}</li>
        @endforeach
    </ul>
    </div>
    @endsection