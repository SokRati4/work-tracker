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
                                <div class="col-md-4 p-3">
                                    <div class="bg-1 box-1">
                                        @php
                                            $workday = $workdays->firstWhere('date', Carbon\Carbon::createFromDate($year, $month, $day)->format('Y-m-d'));
                                        @endphp
                                        <div class="func-box">{{ $day }}.{{ $month }}.{{ $year }} {{ $workday ? "✔️" : "❌" }}</div>
                                        <div class="p-3">
                                            

                                            <form method="POST" action="{{ route('workdays.update') }}">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <input type="hidden" name="date" value="{{ $year-$month-$day }}">
                                                <input type="hidden" name="month_number" value="{{ $month }}">
                                                
                                                <div class="py-1">
                                                    <label>
                                                        <input type="radio" name="attendance" value="1" {{ $workday && $workday->attendance == 1 ? 'checked' : '' }}>
                                                        Obecny
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="attendance" value="0" {{ $workday && $workday->attendance == 0 ? 'checked' : '' }}>
                                                        Nieobecny
                                                    </label>
                                                </div>
                                                <div class="py-1">
                                                    <label for="hours">Godziny przepracowane:</label>
                                                    <input type="number" name="hours" id="hours" value="{{ $workday ? $workday->hours : '' }}">
                                                </div>
                                                <div class="py-1">
                                                    <label for="absence_type">Typ absencji:</label>
                                                    <select name="absence_type" id="absence_type">
                                                        <option value="">Brak</option>    
                                                        @foreach ($absenceTypes as $absenceType)
                                                            <option value="{{ $absenceType->id }}" {{ $workday && $workday->id_absence_type == $absenceType->id ? 'selected' : '' }}>
                                                                {{ $absenceType->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="py-1">
                                                    <label for="notes">Notatka:</label>
                                                    <input type="text" name="notes" id="notes" value="{{ $workday ? $workday->notes : '' }}">
                                                </div>

                                                <button class="button" type="submit">Zapisz</button>
                                            </form>
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
