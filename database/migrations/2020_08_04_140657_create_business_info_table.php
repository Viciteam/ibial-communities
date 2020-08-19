<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_info', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('business_id');
            $table->string('logo')->nullable();
            $table->string('description');
            $table->string('hashtag');
            $table->string('location');
            $table->string('skills');
            $table->string('language');
            $table->string('attributes')->nullable();
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
        Schema::dropIfExists('business_info');
    }
}
