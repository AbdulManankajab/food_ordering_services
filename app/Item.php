<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function categories(){
        return $this->hasMany('App\Categories');
    }
    public function menus(){
        return $this->belongsTo('App\Menu');
    }
}
