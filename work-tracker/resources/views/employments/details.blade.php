@extends('layouts.app')

@section('content')
<div>
    <h1>Zatrudnienie P. {{ $employment->user->first_name }} {{ $employment->user->last_name }}</h1>

    Dane zatrudnienia (tabela employment)
</div>
@endsection