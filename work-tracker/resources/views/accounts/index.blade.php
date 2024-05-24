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

</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lista użytkowników') }}</div>

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
                                Lista użytkowników
                            </div>

                            <div class="p-3">
                                <div>
                                    <table class="table">
                                        <thead class="table-header">
                                            <tr>
                                                <th>Imię i nazwisko</th>
                                                <th>E-mail</th>
                                                <th>Status</th>
                                                <th>Akcje</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>
                                                        <a class="link-color" href="{{ route('accounts.details', $user->id) }}">{{ $user->first_name }} {{ $user->last_name }}</a>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if ($user->accepted == 0)
                                                            <span style="color: red;">Niezaakceptowany</span>
                                                        @else
                                                            <span style="color: green;">Zaakceptowany</span>
                                                        @endif
                                                    </td>
                                                    <td style="text-align:center;">
                                                        @if ($user->accepted == 0)
                                                            <form action="{{ route('accounts.accept', $user->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="button" type="submit">Akceptuj</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
