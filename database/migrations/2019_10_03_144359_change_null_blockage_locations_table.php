<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNullBlockageLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blockage_locations', function (Blueprint $table) {
            $table->point('blk_start_location')->nullable()->change();
            $table->point('blk_end_location')->nullable()->change();
            $table->text('blk_village')->nullable()->change();
            $table->text('blk_tumbol')->nullable()->change();
            $table->text('blk_district')->nullable()->change();
            $table->text('blk_province')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
