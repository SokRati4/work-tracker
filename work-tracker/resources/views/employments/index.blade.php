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
                <div class="card-header">{{ __('Lista umów') }}</div>
                
                <div class="row p-3">
                    <div class="col-md-12">
                        <div class="dashboard-container box-1 bg-1">
                            <div class="header-box">
                                Lista umów
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
                                    @foreach ($employments as $employment)
                                        <li>
                                            <a class="link-color" href="{{ route('employments.details', $employment->id) }}">
                                                    <span class="employee-name">{{ $employment->user->first_name }} {{ $employment->user->last_name }}:</span> 
                                                    {{ $employment->start_date }} 
                                            </a>
                                        </li>
                                    @endforeach
                                    </ul>
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