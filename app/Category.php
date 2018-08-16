<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    function items(){
    	return $this->hasMany('\App\Item');
    }
}
































