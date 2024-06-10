<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'ville',
        'subscription',
        'imagemembers',
        'sexe',
        'email',
    ];

    public function coaching()
    {
        return $this->hasMany(Coaching::class);
    }

}
