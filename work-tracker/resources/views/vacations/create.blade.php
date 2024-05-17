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
                <div class="card-header">{{ __('Wniosek urlopowy')}}</div>
                @if(session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                
                <div class="row p-3">
                    
                    
                    <div class="input-group d-flex" style="justify-content:center;">
                        <div class="col-md-12 mx-1">
                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Nowy wniosek urlopowy
                                </div>

                                <div class="p-3" style="text-align:center;">
                                    <div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-3 mx-1">
                        <form action="{{ route('vacations.store') }}" method="POST">
                            @csrf

                            <!-- Ukryte pole user_id z wartością ID zalogowanego użytkownika -->
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <!-- Status domyślnie ustawiony na "waiting" -->
                            <input type="hidden" name="status" value="waiting">

                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Data rozpoczęcia
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="date" id="start_date" name="start_date"><br><br>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Data zakończenia
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="date" id="end_date" name="end_date"><br><br>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Typ nieobecności
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <select id="absence_type" name="absence_type">
                                            @foreach($absenceTypes as $absenceType)
                                                <option value="{{ $absenceType->id }}">{{ $absenceType->name }}</option>
                                            @endforeach
                                        </select><br><br>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-8 mx-1">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Notatka
                                    </div>

                                    <div class="p-3" style="text-align:center;">
                                        <input type="text" name="text" id="text">
                                    </div>
                                </div>
                        </div>
                        

                        <div class="col-md-12 mx-1">
                            <div class="dashboard-container box-1 d-flex" style="justify-content:center;">
                                <button class="button" type="submit">Wyślij Prośbę</button>
                            </div>
                        </div>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div>
@endsection
