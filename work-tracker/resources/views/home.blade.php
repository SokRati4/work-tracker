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
    .welcome-box{
        height: 30px;
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
    .box-1{
        height: auto;
    }
    .akcept-box, .praca-box, .wnioski-box, .func-box{
        background-color: #16C7AA;
        border-radius: 10px;
        justify-content: center;
        font-weight: bold;
        height: 50px;
    }
    .wnioski-box, .func-box{
        background-color: #C3C3C3;
    }
    .box-2, .box-3, .box-4{
        height: auto;
    }
    .urlopy-box{
        height: 80px;
    }


</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Strona główna') }}</div>

                <!-- <div class="card-body car-box">
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
                </div> -->
    
                
                <div class="row p-3">
                    <div class="col-md-4">
                            <div class="dashboard-container welcome-box bg-1 px-5 vertical-center">
                                @if(Auth::check())
                                    <div>
                                        Witaj, <strong>{{ Auth::user()->first_name }}</strong>!
                                    </div>
                                @endif     
                            </div>
                            @if (Auth::user()->role == 2 || Auth::user()->role == 3)
                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Pracownicy
                                </div>

                                <div class="p-3">
                                    <div class="row mt-3">
                                        <div class="col-md-7">
                                            <div style="text-align: center;">Pracownicy do zaakceptowania</div>
                                            <div class="akcept-box vertical-center">
                                                X
                                            </div>
                                            

                                        </div>
                                        <div class="col-md-5">
                                            <div class="dashboard-links vertical-center">
                                                <a href="{{ route('employees.index') }}">Lista pracowników</a>
                                            </div>
                                            <div class="dashboard-links vertical-center">
                                                <a href="{{ route('accounts.index') }}">Zarządzanie kontami</a>
                                            </div>
                                            <div class="dashboard-links vertical-center">
                                                <a href="{{ route('employments.index') }}">Zatrudnienia</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if (Auth::user()->role == 1)
                            <div class="dashboard-container box-3 bg-1">
                                <div class="header-box">
                                    Przepracowane godziny
                                </div>
                                <div class="col-md-12 p-3">
                                        <div class="miesiac" style="text-align: center;">
                                                <?php
                                                    setlocale(LC_TIME, 'pl_PL.UTF-8'); // Ustawienie lokalizacji na polską
                                                    $nazwa_miesiaca = strftime('%B'); // Pobranie nazwy aktualnego miesiąca
                                                    $rok = date('Y'); // Pobranie aktualnego roku
                                                    echo $nazwa_miesiaca . ' ' . $rok; // Wyświetlenie nazwy miesiąca i roku
                                                ?>
                                        </div>
                                        <div class="praca-box vertical-center" style="justify-content: center;">
                                            <div>
                                                X
                                            </div>
                                        </div> 
                                </div>
                            </div>
                            <div class="dashboard-container box-4 bg-1">
                                <div class="header-box">
                                    Moje dane
                                </div>
                                <div class="p-3">
                                <div class="dashboard-links mt-3 func-box vertical-center">
                                    <a href="{{ route('employees.my-months') }}">Moja praca</a>
                                </div>
                                </div>
                            </div>
                        
                            @endif
                    </div>
                    
                    @if (Auth::user()->role == 2 || Auth::user()->role == 3)
                        <div class="col-md-4">
                            <div class="dashboard-container box-2 bg-1">
                                <div class="header-box">
                                    Wiadomości
                                </div>

                                <div class="m-3">
                                    X
                                </div>
                            </div>
                        </div>
                    @endif



                    @if (Auth::user()->role == 2 || Auth::user()->role == 3)
                    <div class="col-md-4">
                        <div class="dashboard-container box-3 bg-1">
                            <div class="header-box">
                                Urlopy
                            </div>

                            <div class="p-3">
                                    <div class="dashboard-container bg-1 px-5">
                                        <div class="dashboard-links func-box vertical-center">
                                            <a href="{{ route('vacations.adminIndex') }}">Zarządzaj urlopami</a>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-md-6">
                                                <div style="text-align: center;">Nowe prośby</div>
                                                <div class="akcept-box vertical-center">
                                                    X
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div style="text-align: center;">Wszystkie prośby</div>
                                                <div class="akcept-box vertical-center">
                                                    X
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <div class="dashboard-container box-4 bg-1">
                            <div class="header-box">
                                Moje dane
                            </div>
                            <div class="p-3">
                            <div class="dashboard-links mt-3 func-box vertical-center">
                                <a href="{{ route('employees.my-months') }}">Moja praca</a>
                            </div>
                                <div class="row mt-3">
                                            <div class="col-md-7">
                                                <div style="text-align: center;">Nadchodzące urlopy</div>
                                                <div class="akcept-box vertical-center">
                                                    X
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-5">
                                                <div class="dashboard-links urlopy-box">
                                                    <a href="{{ route('vacations.index') }}" class="vertical-center" style="justify-content:center;">Moje urlopy</a>
                                                </div>
                                            </div>
                                        </div>
                            </div>


                        </div>
                    </div>
                    @endif 

                    @if (Auth::user()->role == 1)
                    <div class="col-md-4">
                    <div class="dashboard-container box-2 bg-1">
                                <div class="header-box">
                                    Wiadomości
                                </div>

                                <div class="m-3">
                                    X
                                </div>
                        </div>
                        
                    </div>
                        
                    <div class="col-md-4">
                    <div class="dashboard-container box-3 bg-1">
                            <div class="header-box">
                                Urlopy
                            </div>
                            <div class="row p-3">
                                            <div class="col-md-7">
                                                <div style="text-align: center;">Nadchodzące urlopy</div>
                                                <div class="akcept-box vertical-center">
                                                    X
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-5">
                                                <div class="dashboard-links urlopy-box">
                                                    <a href="{{ route('vacations.index') }}" class="vertical-center" style="justify-content:center;">Moje urlopy</a>
                                                </div>
                                            </div>
                            </div>
                            <div class="col-md-12 p-3">
                                                <div class="akcept-box vertical-center wnioski-box">Wnioski urlopowe</div>
                            </div>
                    </div>
                    @endif 
        </div>
    </div>
</div>
@endsection
