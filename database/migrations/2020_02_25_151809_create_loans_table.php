<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('borrower_id')->index();
            $table->string('loan_name', 100);
            $table->float('interest', 8, 2);
            $table->string('terms', 45);
            $table->string('frequency', 45);
            $table->integer('late_fee')->nullable();
            $table->date('release_date')->nullable();
            $table->float('amount',8,2);
            $table->timestamps();

            $table->foreign('borrower_id')->references('id')->on('borrowers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
