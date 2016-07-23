<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{

 public function order_detail(){
        return $this->belongsTo('App\books');
    }
}
