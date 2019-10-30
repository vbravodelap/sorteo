<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    protected $fillable = [
        'area_trabajo', 'company_id', 'user_id', 'product_id'
    ];

    public function revisions(){
        return $this->hasMany(Revision::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
