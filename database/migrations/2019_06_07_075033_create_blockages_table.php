<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blockages', function (Blueprint $table) {
            $table->char('blk_id', 15)->primary();
            $table->char('blk_location_id',15);
            $table->char('river_id',15);
            $table->char('blk_crossection_id',15);
            $table->char('sol_id',15);
            $table->float('blk_length',15);
            $table->text('damage_type');
            $table->text('damage_level');
            $table->integer('damage_frequency');
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
        Schema::table('blockages', function (Blueprint $table) {
            //
        });
    }
}
