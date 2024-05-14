@extends('layouts.app')

@section('styles')
<style>
    .dashboard-container {
        justify-content: space-between;
        margin-bottom: 20px;
        border-radius: 10px;
    }

    .dashboard-links {
        padding: 10px;
    }
    .bg-1{
        background-color: #f1f3f5;
    }
    .container{
        padding: 10px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
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

                    {{ __('You are logged in!') }}
                </div>
    
                @if (Auth::user()->role == 2 || Auth::user()->role == 3)
                <div class="row">
                    <div class="col-md-4">
                        <div class="dashboard-container bg-1">
                            <div class="dashboard-links">
                                <a href="{{ route('employees.index') }}">Przejdź do Listy Pracowników</a>
                            </div>
                            <div class="dashboard-links">
                                <a href="{{ route('accounts.index') }}">Zarządzanie kontami</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-container bg-1">
                            <div class="dashboard-links">
                                    <a href="{{ route('employments.index') }}">Zatrudnienia</a>
                                </div>
                            <div class="dashboard-links">
                                <a href="{{ route('vacations.adminIndex') }}">Zarządzaj urlopami</a>
                            </div>
                        </div>
                    </div>

                    <!-- <a href="{{ route('employees.index') }}">Przejdź do Listy Pracowników</a>
                    <a href="{{ route('accounts.index') }}">Zarządzanie kontami</a>
                    <a href="{{ route('employments.index') }}">Zatrudnienia</a>
                    <a href="{{ route('vacations.adminIndex') }}">Zarządzaj urlopami</a> -->
                @endif
                <div class="col-md-4">
                    <div class="dashboard-container bg-1">
                        <div class="dashboard-links">
                            <a href="{{ route('employees.my-months') }}">Zobacz swoją pracę</a>
                        </div>
                        <div class="dashboard-links">
                            <a href="{{ route('vacations.index') }}">Urlopy</a>
                        </div>
                    </div>
                </div>
                <!-- <a href="{{ route('employees.my-months') }}">Zobacz swoją pracę</a>
                <a href="{{route('vacations.index') }}">Urlopy</a>  -->
            </div>
        </div>
    </div>
</div>
@endsection
