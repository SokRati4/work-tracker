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
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Moje urlopy</div>

                <div class="row p-3">
                    <div class="col-md-12">
                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Moje prośby urlopowe
                                </div>

                                <div class="p-3">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                @if ($vacationRequests->isEmpty())
                                                    <p>Brak wysłanych prośb urlopowych.</p>
                                                @else
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Użytkownik</th>
                                                                <th>Status</th>
                                                                <th>Akcje<th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($vacationRequests as $vacationRequest)
                                                                <tr>
                                                                    <td>{{ $vacationRequest->id }}</td>
                                                                    <td>{{ $vacationRequest->user->first_name }}</td>
                                                                    <td>{{ $vacationRequest->status }}</td>
                                                                    <td><a class="link-color" href="{{ route('vacations.show', ['id' => $vacationRequest->id]) }}">Szczegóły</a></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                            @if(Auth::user()->role == 1)
                            <div class="dashboard-container box-1 bg-1 col-md-4">
                                <div class="header-box">
                                    Złóż wniosek urlopowy
                                </div>

                                <div class="p-3">
                                    <div style="text-align: center;">
                                        <a class="link-color" href="{{route('vacations.create') }}">Utwórz nową prośbę</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                    </div>
                </div>

                    
                        
                    </div>
                </div>
            </div>             
        </div>
    </div>
</div>

@endsection