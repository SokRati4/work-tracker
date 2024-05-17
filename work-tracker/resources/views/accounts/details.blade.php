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
    .center{
        justify-content: center;
        text-align: center;
    }
    .button{
        background-color: #C3C3C3;
        border-radius: 10px;
        text-align: center;
        font-weight: bold;
        width: 100px;
        height: 30px;
        justify-content: center;
        font-size: 10px;
    }
    .button-1{
        background-color: #C3C3C3;
        border-radius: 10px;
        text-align: center;
        font-weight: bold;
        width: 180px;
        height: 40px;
        justify-content: center;
        font-size: 12px;
    }
    .button-2{
        background-color: #c7251a;
        border-radius: 10px;
        text-align: center;
        font-weight: bold;
        width: 180px;
        height: 40px;
        justify-content: center;
        font-size: 12px;
    }
    .text-color{
        color: black;
        text-decoration: none;
    }
    /* The Modal (background) */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    text-align: center;
    border-radius: 10px;
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.cancel-btn {
    background-color: #c3c3c3;
    border-radius: 10px;
    text-align: center;
    font-weight: bold;
    width: 100px;
    height: 30px;
    margin-left: 10px;
    justify-content: center;
    font-size: 10px;
    border: none;
}

/* Dodaj do swojego stylu CSS */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
}

/* Dodaj do swojego stylu CSS */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    text-align: center;
    border-radius: 10px;
}

/* Dodaj do swojego stylu CSS */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}




</style>
@endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Zarządzanie kontem') }}</div>
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
                            <div class="col-md-8">
                                <div class="dashboard-container box-1 bg-1">
                                    <div class="header-box">
                                        Dane użytkownika
                                    </div>

                                    <div class="row p-3">
                                        <div class="p-3 col-md-4">
                                            <div class="header-box">
                                                Imię i nazwisko
                                            </div>

                                            <div class="p-1 center">
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            </div>
                                        </div>

                                        <div class="p-3 col-md-4">
                                            <div class="header-box">
                                                Login
                                            </div>

                                            <div class="p-1 center">
                                                {{ $user->login }} 
                                            </div>
                                        </div>

                                        <div class="p-3 col-md-4">
                                            <div class="header-box">
                                                E-mail
                                            </div>

                                            <div class="p-1 center">
                                                {{ $user->email }} 
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-4">
                                    <div class="dashboard-container box-1 bg-1">
                                        <div class="row p-3">
                                            <div class="vertical-center col-md-6">
                                                <button class="button-1" ><a class="text-color" href="{{ route('accounts.edit', $user->id) }}">Edytuj dane</a></button>
                                            </div>

                                            <button class="button-2" data-bs-toggle="modal" data-bs-target="#deleteModal">Usuń konto</button>
                                        </div>
                                    </div>

                                    <div class="dashboard-container box-1 bg-1 center">
                                        <div class="header-box">
                                            Zmień rolę użytkownika
                                        </div>
                                        <form action="{{ route('accounts.change-role', $user->id) }}" method="POST">
                                            <div class="p-3 col-md-12">     
                                                <div class="header-box">
                                                    Aktualna rola
                                                </div>
                                                    @csrf
                                                <div class="p-1 center">
                                                    {{ $user->role }}
                                                </div>
                                            </div>

                                            <div class="p-3 col-md-12">
                                                <div class="header-box">
                                                    Nowa rola
                                                </div>

                                                <div class="p-1 center">
                                                        <select name="new_role" id="new_role">
                                                            @foreach($roles as $role)
                                                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->role }}</option>
                                                            @endforeach
                                                        </select>
                                                
                                                    <div class="mt-2">
                                                        <button id="deleteBtn" class="button" type="submit">Zmień Rolę</button>
                                                    </div>
                                                </div>
                                                </form>
                                        </div>
                                </div> 
                                <!-- Modal -->
                                <div id="deleteModal" class="modal">
                                                <div class="modal-content">
                                                    <span class="close">&times;</span>
                                                    <h2>Potwierdzenie</h2>
                                                    <p>Czy na pewno chcesz usunąć konto?</p>
                                                    <form id="deleteForm" action="{{ route('accounts.delete', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="button-2">Tak, usuń</button>
                                                        <button type="button" class="button-2 cancel-btn">Anuluj</button>
                                                    </form>
                                                </div>
                                            </div>
                            </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Dodaj do swojego skryptu JavaScript
var modal = document.getElementById("deleteModal");
var btn = document.getElementById("deleteBtn");
var span = document.getElementsByClassName("close")[0];
var cancelBtn = document.querySelector(".cancel-btn");

btn.onclick = function(event) {
    event.preventDefault();
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

cancelBtn.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>
@endsection