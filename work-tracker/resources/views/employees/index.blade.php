@extends('layouts.app')

@section('content')
<div>
    <h1>Lista Pracowników</h1>

    <ul>
        @foreach ($employees as $employee)
            <li>
                <a href="{{ route('employees.employee', $employee->id) }}" >{{ $employee->login }} - {{ $employee->email }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection