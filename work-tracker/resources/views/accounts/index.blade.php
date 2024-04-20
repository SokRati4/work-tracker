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
    <h1>Lista Użytkowników</h1>

    <ul>
        @foreach ($users as $user)
            <li>
                <a href="{{ route('accounts.details', $user->id) }}">{{ $user->first_name }} {{ $user->last_name }} - {{ $user->email }}</a>
                @if ($user->accepted == 0)
                    <form action="{{ route('accounts.accept', $user->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit">Akceptuj</button>
                    </form>
                @else
                    <span style="color: green;"> - Zaakceptowany</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection