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
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edycja danych użytkownika:')}} {{ $user->first_name }} {{ $user->last_name }}</div>
                
                <div class="row p-3">
                    <form action="{{ route('accounts.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="input-group d-flex" style="justify-content:center;">
                        <div class="col-md-12 mx-1">
                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Imię
                                </div>

                                <div class="p-3" style="text-align:center;">
                                    <div>
                                        <input type="text" id="first_name" name="first_name" value="{{ $user->first_name }}">
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Drugie imię
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="text" id="second_name" name="second_name" value="{{ $user->second_name }}">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Nazwisko
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        E-mail
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="email" id="email" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Data urodzenia
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="date" id="birth_date" name="birth_date" value="{{ $user->birth_date }}">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Numer telefonu
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="number" id="phone" name="phone" value="{{ $user->phone }}">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Adres
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="text" id="address" name="address" value="{{ $user->address }}">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Numer konta
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="number" id="account_number" name="account_number" value="{{ $user->account_number }}">
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-12 mx-1">
                            <div class="dashboard-container box-1 d-flex" style="justify-content:center;">
                                <button class="button" type="submit">Zapisz zmiany</button>
                            </div>
                        </div>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div>
@endsection
