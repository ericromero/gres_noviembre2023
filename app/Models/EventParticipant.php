<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'participation_type_id',
        'event_id',
        'user_id',
    ];

    // Relación con el tipo de participante
    public function participationType()
    {
        return $this->belongsTo(ParticipationType::class);
    }

    // Relación con el evento
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Relación con el usuario si es un usuario existente
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
