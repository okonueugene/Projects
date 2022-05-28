<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patrols', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('site_id')->nullable();
            $table->unsignedInteger('guard_id')->nullable();
            $table->string('name');
            $table->time('start');
            $table->time('end');
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->foreign('guard_id')->references('id')->on('guards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patrols');
    }
}
