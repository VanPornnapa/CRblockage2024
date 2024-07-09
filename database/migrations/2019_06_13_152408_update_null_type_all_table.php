<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNullTypeAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blockage_crossections', function ($table) {
            $table->longText('past')->nullable()->change();
            $table->longText('current_start')->nullable()->change();
            $table->longText('current_end')->nullable()->change();
        });
        Schema::table('projects', function ($table) {
            $table->text('proj_name')->nullable()->change();
            $table->text('proj_type')->nullable()->change();
            $table->text('proj_status')->nullable()->change();
            $table->float('proj_budget',8,2)->nullable()->change();
            $table->integer('proj_year')->nullable()->change();
        });

        Schema::table('rivers', function ($table) {
            $table->text('river_name')->nullable()->change();
            $table->text('river_type')->nullable()->change();
            $table->text('river_main')->nullable()->change();
        });

        Schema::table('solutions', function ($table) {
            $table->text('responsed_dept')->nullable()->change();
            $table->text('sol_how')->nullable()->change();
            $table->text('result')->nullable()->change();
            
        });

        Schema::table('blockages', function ($table) {
            $table->float('blk_length',8,2)->nullable()->change();
            $table->text('damage_type')->nullable()->change();
            $table->text('damage_level')->nullable()->change();
            $table->text('damage_frequency')->nullable()->change();
            $table->text('blk_surface')->nullable()->change();
            $table->text('blk_surface_detail')->nullable()->change();
            
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
