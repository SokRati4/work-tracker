@extends('layouts.app')

@section('content')
<div>
    <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>

    Dane użytkownika

    <form action="{{ route('accounts.delete', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Usuń Konto</button>
    </form>
    <a href="{{ route('accounts.edit', $user->id) }}">Edytuj dane</a>
</div>
@endsection