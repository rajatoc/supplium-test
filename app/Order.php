<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }
    // public function users()
    // {
    //     return $this->belongsToMany('App\User')->withPivot('role_id');
    // }

}