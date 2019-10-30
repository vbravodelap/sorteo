<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'address', 'user_id'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
