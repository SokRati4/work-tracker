@extends('layouts.app')

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
@endsection