<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    //
    public function books(){
        return $this->belongsTo('App\books');
    }
}
