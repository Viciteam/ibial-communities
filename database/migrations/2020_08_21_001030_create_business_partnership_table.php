<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPartnershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_partnership', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->integer('business_partner_id');
            $table->text('business_type')->nullable();
            $table->text('business_partnership_terms')->nullable();
            $table->text('location')->nullable();
            $table->text('business_name');
            $table->text('business_tag_line')->nullable();
            $table->integer('status_id');
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
        Schema::dropIfExists('business_partnership');
    }
}
