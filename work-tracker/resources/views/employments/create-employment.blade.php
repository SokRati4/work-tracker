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
    .button{
        background-color: #16C7AA;
        border-radius: 10px;
        text-align: center;
        font-weight: bold;
        width: 200px;
    }
    form{
        
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dodaj nowe zatrudnienie') }}</div>
                
                <div class="row p-3">
                    <form class="form-inline" action="{{ route('employments.store-employment') }}" method="POST">
                    <div class="input-group d-flex" style="justify-content:center;">
                    @csrf
                        <div class="col-md-12 mx-1">
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
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Typ umowy
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="text" name="contract_type" id="contract_type" required>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Stanowisko
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="text" name="position" id="position" required>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Okres miesięcy
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="number" name="period_month" id="period_month" required>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Data rozpoczęcia
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="date" name="start_date" id="start_date" required>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Data zakończenia
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="date" name="end_date" id="end_date">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Stawka
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="number" name="rate" id="rate" required>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Opis stanowiska
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <textarea name="job_description" id="job_description" required></textarea>
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-12 mx-1">
                            <div class="dashboard-container box-1 d-flex" style="justify-content:center;">
                                <button class="button" type="submit">Dodaj Zatrudnienie</button>
                            </div>
                        </div>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div>
@endsection