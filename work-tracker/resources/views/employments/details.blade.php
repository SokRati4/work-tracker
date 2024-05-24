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
    .employee-name {
        color: black;
        font-weight: bold;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 18px;
        text-align: left;
    }
    .table th, .table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
    }
    .table th {
        background-color: #f4f4f4;
    }
    .table tbody tr:nth-of-type(even) {
        background-color: #f9f9f9;
    }
    .table tbody tr:hover {
        background-color: #f1f1f1;
    }
    .table-header th {
        background-color: #16C7AA;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .button{
        background-color: #16C7AA;
        border-radius: 10px;
        text-align: center;
        font-weight: bold;
        width: 100px;
        height: 30px;
        justify-content: center;
        font-size: 10px;
    }
    .table td{
        text-align: center;
    }
    .table thead th{
        text-align: center;
    }

</style>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dane zatrudnienia') }}</div>
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
                
                <div class="row p-3">
                    <div class="col-md-12">
                        <div class="dashboard-container box-1 bg-1">
                            <div class="header-box">
                                Dane zatrudnienia
                            </div>

                            <div class="p-3">
                                <div>
                                    <table class="table">
                                        <thead class="table-header">
                                            <tr>
                                                <th>Imię i nazwisko</th>
                                                <th>Rodzaj umowy</th>
                                                <th>Stanowisko</th>
                                                <th>Stawka</th>
                                                <th>Okres miesięcy</th>
                                                <th>Data rozpoczęcia umowy</th>
                                                <th>Data zakończenia umowy</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td>{{ $employment->user->first_name }} {{ $employment->user->last_name }}</td>
                                                    <td>{{ $employment->contract_type }}</td>
                                                    <td>{{ $employment->position }}</td>
                                                    <td>{{ $employment->rate }}</td>
                                                    <td>{{ $employment->period_month }}</td>
                                                    <td>{{ $employment->start_date }}</td>
                                                    <td>{{ $employment->end_date }}</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                    </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection