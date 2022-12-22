<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RequestOffer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->increments('id_request');
            $table->integer('id_school');
            $table->integer('id_resource_request')->nullable();
            $table->integer('id_tutorial_request')->nullable();
            $table->text('req_description');
            $table->dateTime('req_request_date');
            $table->enum('req_request_status',['new','offered','closed']);
            $table->enum('req_type',['tutorial','resource']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request');
    }
}
