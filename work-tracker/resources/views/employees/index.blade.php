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