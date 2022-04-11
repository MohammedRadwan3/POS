<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'address'];

    protected $casts = [
        'phone' => 'array'
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);

    }//end of get name attribute
}
