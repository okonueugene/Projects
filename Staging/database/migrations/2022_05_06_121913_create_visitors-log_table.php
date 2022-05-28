<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors-log', function (Blueprint $table) {
            $table->id();
            $table->string('visitor')->nullable();
            $table->string('time-in')->nullable();
            $table->string('time-out')->nullable();
            $table->string('checked_in_by')->nullable();
            $table->string('checked_out_by')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('visitors-log');
    }
}
