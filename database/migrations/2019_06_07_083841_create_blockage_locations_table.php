<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockageLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blockage_locations', function (Blueprint $table) {
            $table->char('blk_location_id',15)->primary();
            $table->point('blk_start_location');
            $table->point('blk_end_location');
            $table->text('blk_village');
            $table->text('blk_tumbol');
            $table->text('blk_district');
            $table->text('blk_province');
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
        Schema::dropIfExists('blockage_locations');
    }
}
