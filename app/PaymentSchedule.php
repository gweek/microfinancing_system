<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSchedule extends Model
{
    //

    public function loan(){
    	return $this->belongsTo(Loan::class);
    }

    public function payment(){
    	return $this->belongsTo(Payment::class);
    }
}
