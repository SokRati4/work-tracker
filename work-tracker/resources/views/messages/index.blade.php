@extends('layouts.app')

@section('styles')
<style>

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.card-header {
    background-color: #16C7AA;
    color: white;
}

.card-header h1 {
    font-size: 1.25rem;
    margin-bottom: 0;
    background-color: #16C7AA;
}

.list-group-item {
    transition: background-color 0.3s, color 0.3s;
}

.list-group-item:hover {
    background-color: #f8f9fa;
}

.text-primary {
    color: #007bff !important;
}

.text-decoration-none {
    text-decoration: none !important;
}
a{
    color: #16C7AA;
}

</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-white">
                    <h1 class="h4 mb-0">Wiadomości</h1>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ route('messages.sentMessages') }}" class="text-decoration-none">Wysłane wiadomości</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('messages.receivedMessages') }}" class="text-decoration-none">Odebrane wiadomości</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('messages.create') }}" class="text-decoration-none">Nowa wiadomość</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection