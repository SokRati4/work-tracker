@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <!-- Przycisk przekierowujący do /employees -->
                <a href="{{ route('employees.index') }}">Przejdź do Listy Pracowników</a>
                <a href="{{ route('accounts.index') }}">Zarządzanie kontami</a>
                <a href="{{ route('employments.index') }}">Zatrudnienia</a>
                <a href="{{ route('employees.my-months') }}">Zobacz swoją pracę</a>
            </div>
        </div>
    </div>
</div>
@endsection
