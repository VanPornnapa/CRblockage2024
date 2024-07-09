<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBlockageTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('problem_details', function ($table) {
            $table->text('nat_weed_detail')->nullable()->change();
            $table->text('nat_other_detail')->nullable()->change();
            $table->boolean('nat_erosion')->nullable()->change();
            $table->boolean('nat_shoal')->nullable()->change();
            $table->boolean('nat_missing')->nullable()->change();
            $table->boolean('nat_winding')->nullable()->change();
            $table->boolean('nat_weed')->nullable()->change();
            $table->boolean('nat_other')->nullable()->change();
            $table->text('hum_structure')->nullable()->change();
            $table->text('hum_stc_bld_num')->nullable()->change();
            $table->text('hum_str_other')->nullable()->change();
            $table->boolean('hum_road')->nullable()->change();
            $table->boolean('hum_smallconvert')->nullable()->change();
            $table->boolean('hum_road_paralel')->nullable()->change();
            $table->boolean('hum_replaced_convert')->nullable()->change();
            $table->boolean('hum_bridge_pile')->nullable()->change();
            $table->boolean('hum_soil_cover')->nullable()->change();
            $table->boolean('hum_trash')->nullable()->change();
            $table->boolean('hum_other')->nullable()->change();


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
