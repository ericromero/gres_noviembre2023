<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipationType extends Model
{
    protected $fillable = ['name'];

    public function participants()
    {
        return $this->hasMany(EventParticipant::class, 'participation_type_id');
    }
}
