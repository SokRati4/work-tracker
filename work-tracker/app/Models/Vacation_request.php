<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacationRequest extends Model
{
    use HasFactory;

    protected $table = 'vacation_request'; // Nazwa tabeli w bazie danych

    protected $fillable = [
        'id_user',
        'id_absence_type',
        'date_from',
        'date_to',
        'text',
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