<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

	public $guarded = [];

    public function paymentSchedule(){
    	return $this->hasOne(paymentSchedule::class);
    }
    public function loan(){
    	return $this->belongsTo(Loan::class);
    }
}
