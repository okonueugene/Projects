<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('site_id')->nullable();
            $table->string('name')->nullable();
            $table->enum('type', ['qr','nfc','virtual'])->nullable();
            $table->string('code');
            $table->string('location')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
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
        Schema::dropIfExists('tags');
    }
}
