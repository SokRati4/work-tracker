@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Wszystkie wysłane wiadomości</h2>
        <div class="row">
            <div class="col-md-12">
                @if ($sent_messages->count() > 0) 
                    <ul>
                @foreach ($sent_messages as $message)
                    <li>
                        <strong>Temat:</strong> {{ $message->subject }}<br>
                        <strong>Data wysłania:</strong> {{ $message->date_send }}<br>
                        <strong>Status:</strong> {{ $message->status }}<br>
                        <button class="btn btn-link" data-toggle="collapse" data-target="#thread_{{ $message->id }}">Pokaż wątek</button>
                        <div id="thread_{{ $message->id }}" class="collapse">
                            <ul>
                            @php
                                $threadMessages = \App\Models\Message::where('id_thread', $message->id_thread)->get();
                            @endphp
                            @foreach ($threadMessages as $threadMessage)
                                <li>
                                    <strong>Data wysłania:</strong> {{ $threadMessage->date_send }}<br>
                                    <strong>Treść:</strong> {{ $threadMessage->text }}<br>
                                </li>
                            @endforeach
                            </ul>
                        </div>
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