<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';

    protected $fillable = [
        'subject', 'id_thread', 'id_user_sender', 'id_user_receiver', 'text', 'date_send', 'status'
    ];

    protected $dates = [
        'date_send'
    ];
    public $timestamps = false;

    public function sender()
    {
        return $this->belongsTo(User::class, 'id_user_sender');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'id_user_receiver');
    }
}
