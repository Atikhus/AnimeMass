<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLink extends Model
{
    use HasFactory;

    // Especifica los atributos que se pueden llenar
    protected $fillable = ['user_id', 'url'];

    // Define la relación con el modelo User (si es necesario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
