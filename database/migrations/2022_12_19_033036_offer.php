<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Offer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer', function (Blueprint $table) {
            $table->increments('id_offer');
            $table->integer('id_volunteer');
            $table->integer('id_request');
            $table->text('offer_remarks');
            $table->integer('offer_amount');
            $table->dateTime('offer_date');
            $table->enum('offer_status',['pending','accepted']);
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
        Schema::dropIfExists('resource_request');
    }
}
