<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class MangaProgress extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = 'manga_progress';

    // Los campos que se pueden llenar masivamente
    protected $fillable = [
        'user_id',   // El ID del usuario que guarda el progreso
        'manga_id',
        'url',  // El ID del manga
        
    ];

    // Relación con el modelo User (Un usuario puede tener muchos progresos)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
