@extends('layouts.app')

@section('styles')
<style>
h2 {
    font-size: 1.75rem;
    margin-bottom: 1.5rem;
}

.accordion-button {
    font-size: 1.25rem;
    font-weight: bold;
}

.list-group-item {
    border: 1px solid #ddd;
    border-radius: 0.5rem;
    margin-top: 1rem;
}

.accordion-button:not(.collapsed) {
    color: #16C7AA;
    background-color: #E6FAF8;
}

.accordion-button::after {
    flex-shrink: 0;
    width: 1.25rem;
    height: 1.25rem;
    margin-left: auto;
    content: "";
    background: no-repeat center center;
    background-size: 1.25rem;
}

.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2316C7AA' viewBox='0 0 24 24' stroke='currentColor'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 4v16m8-8H4'/%3E%3C/svg%3E");
}

.accordion-button.collapsed::after {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 24 24' stroke='currentColor'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 12h16'/%3E%3C/svg%3E");
}

p {
    font-size: 1.25rem;
}
</style>
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Wszystkie wysłane wiadomości</h2>
    <div class="row">
        <div class="col-md-12">
            @if ($sent_messages->count() > 0)
                <div class="accordion" id="messagesAccordion">
                    @foreach ($sent_messages as $message)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $message->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $message->id }}" aria-expanded="false" aria-controls="collapse{{ $message->id }}">
                                    <div>
                                        <strong>Temat:</strong> {{ $message->subject }}<br>
                                        <strong>Odbiorca:</strong> 
                                        @php
                                            $receiver = \App\Models\User::find($message->id_user_receiver);
                                        @endphp
                                        @if ($receiver)
                                            {{ $receiver->first_name }} {{ $receiver->last_name }}
                                        @endif
                                        <br>
                                        <strong>Data wysłania:</strong> {{ $message->date_send }}
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse{{ $message->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $message->id }}" data-bs-parent="#messagesAccordion">
                                <div class="accordion-body">
                                    <div>
                                        <strong>Temat:</strong> {{ $message->subject }}
                                    </div>
                                    <div>
                                        <strong>Treść:</strong> {{ $message->text }}
                                    </div>
                                    <div>
                                        <strong>Data wysłania:</strong> {{ $message->date_send }}
                                    </div>
                                    <div>
                                        <strong>Odbiorca:</strong> 
                                        @if ($message->id_user_receiver)
                                            {{ $receiver->first_name }} {{ $receiver->last_name }}
                                        @endif
                                    </div>
                                    <div>
                                        <strong>Status:</strong> {{ $message->status }}
                                    </div>
                                    <h4 class="mt-3">Wątek</h4>
                                    <ul class="list-group list-group-flush">
                                        @php
                                            $threadMessages = \App\Models\Message::where('id_thread', $message->id_thread)
                                                ->orderBy('date_send', 'asc')
                                                ->get();
                                        @endphp
                                        @foreach ($threadMessages as $threadMessage)
                                            <li class="list-group-item">
                                                @php
                                                    $sender = \App\Models\User::find($threadMessage->id_user_sender);
                                                @endphp
                                                @if ($sender)
                                                    {{ $sender->first_name }} {{ $sender->last_name }}
                                                @endif
                                                <div>
                                                    <strong>Data wysłania:</strong> {{ $threadMessage->date_send }}
                                                </div>
                                                <div>
                                                    <strong>Treść:</strong> {{ $threadMessage->text }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Brak wysłanych wiadomości.</p>
            @endif
        </div>
    </div>
</div>
@endsection