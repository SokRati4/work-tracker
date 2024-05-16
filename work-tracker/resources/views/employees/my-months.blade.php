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
    


</style>
@endsection

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Moja praca') }}</div>
                

                <div class="row p-3">
                    <div class="col-md-12">
                            <div class="dashboard-container box-1 bg-1 vertical-center p-3">
                                <div>
                                    <p><strong>Imię i nazwisko:</strong>
                                        {{ $employee->first_name }} {{ $employee->last_name }}
                                        @if ($currentEmployment === null)
                                            <p>Aktualnie nie jesteś w trakcie żadnej umowy</p>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if ($currentEmployment === null)
                            <div class="dashboard-container box-1 bg-1 vertical-center p-3">
                                <div>
                                    <p>Aktualnie nie jesteś w trakcie żadnej umowy</p>
                                </div>
                            </div>
                            @endif

                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Moje umowy
                                </div>

                                <div class="p-3">
                                        <div class="col-md-12">
                                            <div>
                                                <ul>
                                                    @foreach($uniqueMonths as $monthKey => $monthName)
                                                        @php
                                                            list($monthNumber, $year) = explode('-', $monthKey);
                                                        @endphp
                                                        <li>
                                                            <a class="link-color" href="{{ route('workdays.work-month-normal', ['month' => $monthNumber, 'year' => $year]) }}">{{ $monthNumber }} - {{ $monthName }} - {{ $year }}</a>
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
        </div>
    </div>
</div>
@endsection
