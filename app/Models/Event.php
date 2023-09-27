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
        'responsible_id',
        'corresponsible_id',
        'department_id',
        'event_type_id',
        'title',
        'summary',
        'program',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'cover_image',
        'user_id',
        'number_of_attendees',
        'registration_required',
        'registration_url',
        'space_required',
        'transmission_required',
        'recording_required',
        'status',
        'published',
        'cancelled',
        'register_id',
    ];

    protected $dates = ['start_date', 'end_date'];

    // Relación con el modelo User (un evento pertenece a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function canceledEvent()
    {
        return $this->hasOne(CanceledEvent::class, 'event_id');
    }

    public function isAvailable()
    {
        return $this->status === 'Aceptado' && $this->space->events()->where(function ($query) {
            $query->whereBetween('start_date', [$this->start_date_time, $this->end_date_time])
                  ->orWhereBetween('end_date', [$this->start_date_time, $this->end_date_time])
                  ->orWhere(function ($query) {
                      $query->where('start_date', '<=', $this->start_date_time)
                            ->where('end_date', '>=', $this->end_date_time);
                  });
        })->count() === 0;
    }

    public function getStartDateAndTimeAttribute()
    {
        return $this->start_date . ' ' . $this->start_time;
    }

    public function getEndDateAndTimeAttribute()
    {
        return $this->end_date . ' ' . $this->end_time;
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function eventspace()
    {
        return $this->hasOne(EventSpace::class);
    }

    public function eventRecordings()
    {
        return $this->hasMany(EventRecording::class);
    }

    public function eventStreamings()
    {
        return $this->hasMany(EventStreaming::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_participants');
    }
}
