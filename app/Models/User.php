<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'degree',
        'name',
        'email',
        'password',
        'doi',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function adscriptions()
    {
        return $this->hasMany(Adscription::class);
    }

    // public function events()
    // {
    //     return $this->hasMany(Event::class, 'user_id');
    // }
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_participants');
    }
    

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'adscriptions');
    }

    public function coordinatedDepartment()
    {
        return $this->hasOne(Department::class, 'responsible_id');
    }

    public function team()
    {
        return $this->hasOne(Team::class);
    }

    public function participationTypes()
    {
        return $this->hasMany(EventParticipant::class, 'user_id');
    }

}
