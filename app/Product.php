<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'company_id'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
