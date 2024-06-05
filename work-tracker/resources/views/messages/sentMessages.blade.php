@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Wszystkie wysłane wiadomości</h2>
        <div class="row">
            <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
            @endif
                @if ($sent_messages->count() > 0) 
                    <ul>
                @foreach ($sent_messages as $message)
                    <li>
                        <strong>Temat:</strong> {{ $message->subject }}<br>
                        <strong>Treść:</strong> {{$message->text  }}<br>
                        <strong>Data wysłania:</strong> {{ $message->date_send }}<br>
                        <strong>Odbiorca:</strong>
                        @if ($message->id_user_receiver)
                            @php
                                $receiver = \App\Models\User::find($message->id_user_receiver);
                            @endphp
                        @if ($receiver)
                            {{ $receiver->first_name }} {{ $receiver->last_name }}<br>
                        @endif
                        @endif
                        <strong>Status:</strong> {{ $message->status }}<br>
                        <h4>Wątek</h4>
                            <ul>
                            @php
                            $threadMessages = \App\Models\Message::where('id_thread', $message->id_thread)
                                ->orderBy('date_send', 'asc')
                                ->get();
                             @endphp
                            @foreach ($threadMessages as $threadMessage)
                            <li>
                                @php
                                    $sender = \App\Models\User::find($threadMessage->id_user_sender);
                                @endphp
                                @if ($sender)
                                    {{ $sender->first_name }} {{ $sender->last_name }}<br>
                                @endif
                                <strong>Data wysłania:</strong> {{ $threadMessage->date_send }}<br>
                                <strong>Treść:</strong> {{ $threadMessage->text }}<br>
                            </li>
                            @endforeach
                            </ul>
                    </li>
                @endforeach

                    </ul>
                @else
                    <p>Brak wysłanych wiadomości.</p>
                @endif
            </div>
        </div>
    </div>
@endsection