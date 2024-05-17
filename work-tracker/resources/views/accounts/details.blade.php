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
    <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>

    Dane użytkownika

    <form action="{{ route('accounts.delete', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Usuń Konto</button>
    </form>
    <a href="{{ route('accounts.edit', $user->id) }}">Edytuj dane</a>

    <br>
    <h2>Zmień Rolę:</h2>
    <form action="{{ route('accounts.change-role', $user->id) }}" method="POST">
        @csrf
        <div>
            <label>Aktualna Rola: {{ $user->role }}</label>
            
        </div>
        <div>
            <label for="new_role">Nowa Rola:</label>
            <select name="new_role" id="new_role">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->role }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Zmień Rolę</button>
    </form>

</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lista pracowników') }}</div>
                
                <div class="row p-3">
                    <div class="col-md-4">
                        <div class="dashboard-container box-1 bg-1">
                            <div class="header-box">
                                Lista pracowników
                            </div>

                            <div class="p-3">
                                <div>
                                   
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
                                    
                                </div>
                            </div>

                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Dodaj pracownika
                                </div>

                                <div class="p-3">
                                    <div class="row mt-1">
                                                <a class="link-color-2" href="{{ url('/home') }}">
                                                    <div class="func-box vertical-center" style="font-size: 12px;">
                                                        Edycja
                                                    </div>
                                                </a>
                                            <div class="col-md-3">
                                                <div class="ms-3">
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-9 ">
                                                <a class="link-color-2" href="{{ url('/home') }}">
                                                    <div class="func-box vertical-center" style="font-size: 12px;">
                                                        Edycja
                                                    </div>
                                                </a>
                                            </div>
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
                                    
                                </div>
                            </div>

                            <div class="dashboard-container box-1 bg-1">
                                <div class="header-box">
                                    Dodaj pracownika
                                </div>

                                <div class="p-3">
                                    <div class="row mt-1">
                                                <a class="link-color-2" href="{{ url('/home') }}">
                                                    <div class="func-box vertical-center" style="font-size: 12px;">
                                                        Edycja
                                                    </div>
                                                </a>
                                            <div class="col-md-3">
                                                <div class="ms-3">
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-9 ">
                                                <a class="link-color-2" href="{{ url('/home') }}">
                                                    <div class="func-box vertical-center" style="font-size: 12px;">
                                                        Edycja
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