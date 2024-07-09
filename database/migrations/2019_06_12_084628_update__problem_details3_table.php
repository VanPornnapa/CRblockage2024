<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProblemDetails3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('problem_details', function (Blueprint $table) {
            $table->boolean('nat_erosion');
            $table->boolean('nat_shoal');
            $table->boolean('nat_missing');
            $table->boolean('nat_winding');
            $table->boolean('nat_weed');
            $table->boolean('nat_weed_detail');
            $table->boolean('nat_other');
            $table->boolean('nat_other_detail');

            $table->boolean('hum_structure');
            $table->text('hum_str_owner_type');
            $table->boolean('hum_stc_bld_num');
            $table->boolean('hum_stc_fence_num');
            $table->text('hum_str_other');

            $table->boolean('hum_road');
            $table->boolean('hum_smallconvert');
            $table->boolean('hum_road_paralel');
            $table->boolean('hum_replaced_convert');
            $table->boolean('hum_bridge_pile');
            $table->boolean('hum_soil_cover');
            $table->boolean('hum_trash');
            $table->boolean('hum_other');
            $table->text('hum_other_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('problem_details', function (Blueprint $table) {
            //
        });
    }
}
