<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRecording extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'status', 'validate_by', 'observation'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validate_by');
    }
}
