<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('qty', 'price');
    }
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('role_id');
    }

}
