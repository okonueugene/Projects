<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('site_id')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('id_number');
            $table->string('password');
            $table->boolean('is_active')->default(false);
            $table->datetime('last_login_at')->nullable();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('site_id')->references('id')->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guards');
    }
}
