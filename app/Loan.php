<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
    protected $guarded = [];

	public function loanSetting(){
		return $this->hasOne(LoanSetting::class);
	}

	public function paymentSchedule(){
		return $this->hasMany(PaymentSchedule::class);
	}

	public function borrower(){
		return $this->belongsTo(Borrower::class);
	}

	public function payments(){
		return $this->hasMany(Payment::class);
	}
}
