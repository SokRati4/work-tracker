@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista twoich prośb urlopowych</div>

                    <div class="card-body">
                        @if ($vacationRequests->isEmpty())
                            <p>Brak wysłanych prośb urlopowych.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Użytkownik</th>
                                        <th>Status</th>
                                        <th>Akcje<th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vacationRequests as $vacationRequest)
                                        <tr>
                                            <td>{{ $vacationRequest->id }}</td>
                                            <td>{{ $vacationRequest->user->first_name }}</td>
                                            <td>{{ $vacationRequest->status }}</td>
                                            <td><a href="{{ route('vacations.show', ['id' => $vacationRequest->id]) }}">Szczegóły</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if(Auth::user()->role == 1)
                            <a href="{{route('vacations.create') }}">Utwórz nową prośbę</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection