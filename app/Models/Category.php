<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;


class Category extends Model
{
    use HasFactory;
    use Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name'];


    public function products()
    {
        return $this->hasMany(Product::class);

    }//end of products
}
