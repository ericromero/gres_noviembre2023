<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'description','institution_id', 'responsible_id'];

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function responsible()
    {
        return $this->hasOne(User::class, 'responsible_id');
    }
}
