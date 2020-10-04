<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'id',  'title', 'price', 'description',
    ];

    protected $hidden = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
