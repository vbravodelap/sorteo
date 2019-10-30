<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $fillable = [
        'inspection_id', 'box_number', 'good_pieces', 'bad_pieces', 'total'
    ];

    public function incidence(){
        return $this->belongsTo(Incidence::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
