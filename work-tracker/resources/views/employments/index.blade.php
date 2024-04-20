@extends('layouts.app')

@section('content')
<div>
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