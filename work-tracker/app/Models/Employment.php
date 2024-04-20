<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;

    protected $table = 'employment'; // Nazwa tabeli w bazie danych

    protected $fillable = [
        'id_user',
        'contract_type',
        'position',
        'period_month',
        'start_date',
        'end_date',
        'rate',
        'job_description',
        'active',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
