<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSpace extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'space_id',
        'status',
        // Otros atributos...
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
