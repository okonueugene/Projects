<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('site_id')->nullable();
            $table->unsignedInteger('guard_id')->nullable();
            $table->string('incident_no')->nullable();
            $table->string('police_ref')->nullable();
            $table->string('title')->nullable();
            $table->string('date')->nullable();
            $table->string('reported_by')->nullable();
            $table->string('status')->nullable();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->foreign('guard_id')->references('id')->on('guards');
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
        Schema::dropIfExists('incidents');
    }
}
