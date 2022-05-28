<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dobs', function (Blueprint $table) {
            $table->id();
            $table->string('dob_no')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('guard')->nullable();
            $table->string('time_duty_start')->nullable();
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
        Schema::dropIfExists('dobs');
    }
}
