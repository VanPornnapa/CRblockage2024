<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignBlockages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blockages', function (Blueprint $table) {
            $table->foreign('blk_location_id')->references('blk_location_id')->on('blockage_locations')->onDelete('cascade');
            $table->foreign('blk_crossection_id')->references('blk_xsection_id')->on('blockage_crossections')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blockages', function (Blueprint $table) {
            //
        });
    }
}
