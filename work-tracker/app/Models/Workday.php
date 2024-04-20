<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workday extends Model
{
    use HasFactory;

    protected $table = 'workday'; // Nazwa tabeli w bazie danych

    protected $fillable = [
        'id_user',
        'date',
        'attendance',
        'hours',
        'id_absence_type',
        'notes',
        'month',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function absenceType()
    {
        return $this->belongsTo(AbsenceType::class, 'id_absence_type');
    }
}
