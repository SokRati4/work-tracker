<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_absence_type',
        'date_from',
        'date_to',
    ];

    public $timestamps = false;

    protected $table = 'vacation';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function absenceType()
    {
        return $this->belongsTo(AbsenceType::class, 'id_absence_type');
    }
}