<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    //
	protected $guarded = [];

	public function loans(){
		return $this->hasMany(Loan::class);
	}

}
