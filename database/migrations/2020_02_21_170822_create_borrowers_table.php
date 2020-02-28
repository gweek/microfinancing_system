<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('mi')->nullable();
            $table->string('cnumber')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('job_title')->nullable();
            $table->string('company')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowers');
    }
}
