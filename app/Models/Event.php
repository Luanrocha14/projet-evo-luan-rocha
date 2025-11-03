<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array',
        'date'  => 'datetime',
    ];

    // Campos permitidos para mass assignment
    protected $fillable = [
        'title',
        'date',
        'city',
        'private',
        'description',
        'items',
        'image',
    ];

    // Dono do evento
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // Usuários que participam do evento (many-to-many)
    public function users()
    {
        return $this->belongsToMany(
            \App\Models\User::class,   // Modelo relacionado
            'event_user',              // Nome da tabela pivot
            'event_id',                // Foreign key deste modelo na tabela pivot
            'user_id'                  // Foreign key do modelo relacionado na tabela pivot
        )->withTimestamps();
    }
}
