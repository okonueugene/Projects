<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('portal_access')->default(false);
            $table->string('location')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
