<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanSetting extends Model
{
    //
	protected $guarded = [];

	protected $attributes = [
	   'status' => false,
	];	

	public function loan(){
		return $this->belongsTo(Loan::class);
	}

}
