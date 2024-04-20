<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Nazwa tabeli w bazie danych

    protected $fillable = [
        'role',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
