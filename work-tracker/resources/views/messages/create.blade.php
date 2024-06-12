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
}

.form-text {
    font-size: 1rem;
    font-weight: bold;
}
.h4{
    background-color: #16C7AA;
}

.btn-primary {
    background-color: #16C7AA;
    border-color: black;
    width: 100%;
    
}
.btn-primary:hover{
    background-color: #16C7AA;
    border-color: white;
}
</style>
@endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header  text-white">
                    <h1 class="h4 mb-0">Nowa wiadomość</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            @if ($subject === null)
                                <label for="subject" class="form-label">Temat:</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            @else
                                <input type="hidden" name="subject" value="{{ $subject }}">
                                <div class="form-text"><strong>Temat:</strong> {{ $subject }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            @if ($receiver_id === null)
                                <label for="id_user_receiver" class="form-label">Odbiorca:</label>
                                <select id="id_user_receiver" class="form-select" name="id_user_receiver" required>
                                    @if (Auth::user()->role == 2 || Auth::user()->role == 3)
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    @else
                                        @foreach($admins as $admin)
                                            <option value="{{ $admin->id }}">{{ $admin->first_name }} {{ $admin->last_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            @else
                                <input type="hidden" name="id_user_receiver" value="{{ $receiver_id }}">
                                <div class="form-text"><strong>Odbiorca:</strong> {{ $receiver_name }}</div>
                            @endif
                        </div>
                        @if ($id_thread !== null)
                            <input type="hidden" name="id_thread" value="{{ $id_thread }}">
                        @endif
                        <div class="mb-3">
                            <label for="text" class="form-label">Treść:</label>
                            <textarea id="text" class="form-control" name="text" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Wyślij</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection