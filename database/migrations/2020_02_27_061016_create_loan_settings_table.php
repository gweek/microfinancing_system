<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('loan_id')->index();
            $table->boolean('status')->default(0);
            $table->date('release_date');
            $table->float('loan_amount');
            $table->float('loan_interest_month');
            $table->float('loan_interest_term');
            $table->float('loan_interest_total');
            $table->float('gran_total');
            $table->float('payment_made_total')->nullable();
            $table->integer('next_payment_id')->default(1);
            $table->timestamps();

            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_settings');
    }
}
