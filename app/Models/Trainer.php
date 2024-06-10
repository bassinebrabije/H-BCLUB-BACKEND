<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'fname',
        'lastname',
        'phone',
        'email',
        'ville',
        'sexe',
        'about',
        'img',
    ];
    public function coaching()
    {
        return $this->hasMany(Coaching::class);
    }
}
