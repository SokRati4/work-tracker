<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MessageController extends Controller
{
    public function index()
    {

        return view('messages.index');
    }
    public function create($receiver_id = null, $subject = null, $id_thread = null)
{
    \Log::info('Receiver ID: ' . $receiver_id);
    \Log::info('Subject: ' . $subject);

    $users = User::all(); // Pobieramy wszystkich użytkowników oprócz administratorów
    $admins = User::whereIn('role', [2, 3])->get(); // Pobieramy wszystkich administratorów
    
    $receiver_name = null;
    if ($receiver_id !== null) {
        $receiver = User::find($receiver_id);
        if ($receiver) {
            $receiver_name = $receiver->first_name . ' ' . $receiver->last_name;
        }
    }

    return view('messages.create', [
        'admins' => $admins,
        'users' => $users,
        'receiver_id' => $receiver_id,
        'receiver_name' => $receiver_name,
        'subject' => $subject,
        'id_thread' => $id_thread
    ]);
}
    
    // Utworzenie nowej wiadomości
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'id_user_receiver' => 'required|exists:users,id',
            'text' => 'required'
        ]);
        $senderId = Auth::id();
        $receiverId = $request->id_user_receiver;
        $message = new Message();
        $message->subject = $request->subject;
        if ($request->has('id_thread')) {
            $message->id_thread = $request->input('id_thread');
        } else {
            $message->id_thread = md5($senderId . '_' . $receiverId . '_' . $request->input('subject'));
        }    
        $message->id_user_receiver = $receiverId;
        $message->id_user_sender = $senderId;
        $message->text = $request->text;
        $message->date_send = now();
        $message->status = 'sent';
        $message->save();

        return redirect()->route('messages.sentMessages')->with('success', 'Wiadomość została wysłana');
    }

    // Lista wysłanych wiadomości
    public function sentMessages()
    {
        $user_id = Auth::id();
        $sent_messages = Message::where('id_user_sender', $user_id)->get();
        return view('messages.sentMessages', ['sent_messages' => $sent_messages]);
    }

    // Lista odebranych wiadomości
    public function receivedMessages()
    {
        $user_id = Auth::id();
        $received_messages = Message::where('id_user_receiver', $user_id)->get();
        return view('messages.receivedMessages', ['received_messages' => $received_messages]);
    }
}