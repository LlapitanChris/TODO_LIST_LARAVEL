<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	function user(){
		return $this->belongsTo('App\User');
	}

   function items(){
   	return $this->belongsToMany('\App\Item')->withPivot('quantity')->withTimestamps();
   }
}
