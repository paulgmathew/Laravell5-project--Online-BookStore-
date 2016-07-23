<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    //
    public function items(){
        return $this->hasMany('App\Items');
    }
    
    public function categories(){
        return $this->belongsTo('App\Category');
    }
}
