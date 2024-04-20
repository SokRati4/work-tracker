<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceType extends Model
{
    use HasFactory;

    protected $table = 'absence_type'; // Nazwa tabeli w bazie danych

    protected $fillable = [
        'name',
    ];

    public function workday()
    {
        return $this->hasOne(Workday::class);
    }
}
