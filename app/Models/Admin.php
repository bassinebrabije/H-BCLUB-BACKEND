<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'ville',
        'sexe',
        'username',
        'email',
        'password',
        'imgadmin',
    ];

    protected $hidden = [
        'password',
    ];
}
