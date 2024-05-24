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
        border-radius: 10px;
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
        height: 20px;
        width: 100%;
        text-align: center;
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
    .button{
        background-color: #16C7AA;
        border-radius: 10px;
        text-align: center;
        font-weight: bold;
        width: 100px;
        height: 30px;
        justify-content: center;
    }
    .month{
        font-weight: bold;
    }
</style>
@endsection

@section('content')
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
    
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Praca w miesiącu') }} <span class="month">{{ $month}} | {{ $year }}</span> </div>
                
                <div class="row p-3">
                    
                    <div class="input-group d-flex" style="justify-content:center;">
                    @csrf
                        <div class="col-md-12">
                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Imię i nazwisko
                                </div>

                                <div class="p-3" style="text-align:center;">
                                    <div>
                                    {{ $user->first_name }} {{ $user->last_name }}
                                    </div>
                                </div>
                            </div> 
                        </div>
                        
                        
                        <div class="row">
                                @foreach(range(1, $daysInMonth) as $day)
                                    <div class="col-md-2 p-3">
                                        <div class="bg-1 box-1">
                                            <div class="func-box">{{ $day }}.{{ $month }}.{{ $year }}</div>
                                            <div class="p-2">
                                                @php
                                                    $workday = $workdays->firstWhere('date', Carbon\Carbon::createFromDate($year, $month, $day)->format('Y-m-d'));
                                                @endphp
                                                @if ($workday)
                                                    <p>{{ $workday->attendance === 1 ? "Obecność" : "Nieobecność" }}</p>
                                                    <p>
                                                        @if ($workday->attendance === 1)
                                                            Godziny: {{ $workday->hours }}
                                                        @else
                                                            Typ nieobecności: {{ $workday->absenceType->name }}
                                                        @endif
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection