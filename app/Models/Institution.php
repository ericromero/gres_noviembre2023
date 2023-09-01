<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = ['name'];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
