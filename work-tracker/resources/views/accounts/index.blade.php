@extends('layouts.app')

@section('content')
<div>
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