<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    protected $fillable = ['name','address'];

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('price')
                    ->withTimestamps();
    }
}
