<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experts', function (Blueprint $table) {
            $table->char('blk_id', 15)->primary();
            $table->char('blk_code', 15);
            $table->text('exp_problem');
            $table->float('exp_area');
            $table->float('exp_L0');
            $table->float('exp_H');
            $table->float('exp_C');
            $table->float('exp_tc');
            $table->float('exp_returnPeriod');
            $table->float('exp_I');
            $table->float('exp_maxflow');
            $table->text('exp_solution');
            $table->float('exp_slope');
            $table->text('exp_pixmap');
            $table->text('exp_pix1');
            $table->text('exp_pix2');
           
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
        Schema::dropIfExists('experts');
    }
}
