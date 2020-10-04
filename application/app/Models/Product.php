<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Product extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id',  'title', 'price', 'description',
    ];

    protected $hidden = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
