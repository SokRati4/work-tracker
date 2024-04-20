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
    <h1>Lista umów</h1>

    <ul>
        @foreach ($employments as $employment)
            <li>
                <a href="{{ route('employments.details', $employment->id) }}" >{{ $employment->user->first_name }} - {{ $employment->start_date }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection