<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    // Aquí puedes definir los atributos que sean "fillable" o asignables en masa.
    protected $fillable = [
        'title',
        'summary',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'cover_image',
        'space_id',
        'user_id',
        'number_of_attendees',
        'registration_required',
        'registration_url',
        'status',
        'published',
    ];

    protected $dates = ['start_date', 'end_date'];

    // Relación con el modelo Space (un evento pertenece a un espacio)
    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    // Relación con el modelo User (un evento pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function canceledEvent()
    {
        return $this->hasOne(CanceledEvent::class, 'event_id');
    }
}
