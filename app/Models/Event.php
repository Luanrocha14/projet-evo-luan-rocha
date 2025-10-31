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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}

