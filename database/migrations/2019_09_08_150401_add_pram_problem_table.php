<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPramProblemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('problem_details', function (Blueprint $table) {

            $table->boolean('hum_stc_bld_bu_num')->nullable();
            $table->boolean('hum_stc_fence_bu_num')->nullable();
            $table->text('hum_str_other_bu')->nullable();
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
