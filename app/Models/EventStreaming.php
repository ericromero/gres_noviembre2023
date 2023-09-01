<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventStreaming extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'status', 'channel_id', 'validate_by', 'observation'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validate_by');
    }
}
