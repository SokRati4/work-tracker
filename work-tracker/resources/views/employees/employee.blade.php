@extends('layouts.app')

@section('styles')
<style>
    .dashboard-container {
        justify-content: space-between;
        border-radius: 10px;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .bg-1{
        background-color: #ebedeb;
    }
    .vertical-center {
            min-height: 15px;
            display: flex;
            align-items: center;
    }
    .header-box{
        background-color: #16C7AA;
        border-radius: 10px;
        text-align: center;
        font-weight: bold;
        width: 100%;
    }
    .dashboard-links {
        display: flex;
        justify-content: space-between;
        padding: 5px;
        text-align: center;
    }

    .dashboard-links a {
        color: black;
        text-decoration: none; 
        font-weight: bold;
        background-color: #C3C3C3;
        border-radius: 10px;
        font-size: small;
        flex-grow: 1;
    }
    .box-1, .box-2, .box-3, .box-4{
        height: auto;
    }
    .link-color{
        color: #16C7AA;
        text-decoration: none;
    }
    .link-color-2{
        color: black;
        text-decoration: none;
    }
    .func-box{
        background-color: #16C7AA;
        border-radius: 10px;
        justify-content: center;
        font-weight: bold;
        height: 50px;
    }

    .links-box{
        color: black;
        text-decoration: none; 
        font-weight: bold;
        background-color: #C3C3C3;
        border-radius: 10px;
        font-size: small;
        flex-grow: 1;
    }
    .img-size {
        width: 100px; 
        height: auto; 
        max-width: 100%; 
    }
    .text-color {
    color: black;
    font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dane pracownika') }}</div>
                
                <div class="row p-3">
                    <div class="col-md-4">
                        <div class="dashboard-container box-1 bg-1">
                            <div class="header-box">
                                Imię i nazwisko
                            </div>

                            <div class="p-3" style="text-align:center;">
                                <div>
                                {{ $employee->first_name }} {{ $employee->last_name }}
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Login
                                </div>

                                <div class="p-3" style="text-align:center;">
                                {{ $employee->login }}
                                </div>
                            </div>
                    </div>

                    <div class="col-md-4">
                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    E-mail
                                </div>

                                <div class="p-3" style="text-align:center;">
                                {{ $employee->email }}
                                </div>
                            </div>
                    </div>
                    <div class="col-md-12">
                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Zatrudnienia
                                </div>

                                <div class="p-3">
                                @if ($currentEmployment === null)
                                    <div class="links-box p-1" style="text-align: center;">
                                            <a class="text-color" style="text-decoration:none;" href="{{ route('employments.create-employment', $employee->id) }}">Dodaj nowe zatrudnienie</a>
                                    </div>
                                @endif

                                    <ul>
                                        @foreach($uniqueMonths as $monthKey => $monthName)
                                            @php
                                                list($monthNumber, $year) = explode('-', $monthKey);
                                            @endphp
                                            <li>
                                                <a class="link-color" href="{{ route('workdays.work-month', ['id' => $employee->id, 'month' => $monthNumber, 'year' => $year]) }}">{{ $monthNumber }} | {{ $monthName }} {{ $year }}</a>
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
                            </div>
                    </div>


            </div>
        </div>
    </div>
</div>
@endsection