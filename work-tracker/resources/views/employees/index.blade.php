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



</style>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lista pracowników') }}</div>
                
                <div class="row p-3">
                    <div class="col-md-8">
                        <div class="dashboard-container box-1 bg-1">
                            <div class="header-box">
                                Lista pracowników
                            </div>

                            <div class="p-3">
                                <div>
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
                                    
                                    <ul>
                                        @foreach ($employees as $employee)
                                            <li>
                                                <a class="link-color" href="{{ route('employees.employee', $employee->id) }}">
                                                    <span class="employee-name">{{ $employee->first_name }} {{ $employee->last_name }}:</span> 
                                                    {{ $employee->login }} | {{ $employee->email }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div> 
                    </div>
                <div class="col-md-4">
                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Wyszukaj pracownika
                                </div>

                                <div class="p-3">
                                    <div class="input-group rounded">
                                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                        <span class="input-group-text border-0" id="search-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Dodaj pracownika
                                </div>

                                <div class="p-3">
                                    <div class="row mt-1">
                                            <div class="col-md-3">
                                                <div class="ms-3">
                                                    <img src="{{asset('icon/new_user_icon.png') }}" alt="Logo" class="img-fluid" style="width: 50px; height: auto;">
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-9 ">
                                                <a class="link-color-2" href="{{ url('{id}/employee') }}">
                                                    <div class="func-box vertical-center" style="font-size: 12px;">
                                                        Nowy pracownik
                                                    </div>
                                                </a>
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