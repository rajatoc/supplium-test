<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function company()
    {
        return $this->belongsToMany('App\Company');
    }
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withPivot('category_id');
    }
}
