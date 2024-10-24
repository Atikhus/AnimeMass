<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description']; // Otros campos relevantes

    // Relación con los comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
