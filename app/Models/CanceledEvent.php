<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanceledEvent extends Model
{
    use HasFactory;

    protected $table = 'canceled_events'; 

    // Asegúrate de definir los campos asignables en masa
    protected $fillable = [
        'event_id',
        'cancellation_reason',
        'canceled_by_user_id',
    ];
}
