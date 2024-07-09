<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHumanCausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('human_causes', function (Blueprint $table) {
            $table->char('hum_cause_id', 15)->primary();
            $table->text('human_cause_type');
            $table->text('bld_type');
            $table->text('bld_amount');
            $table->text('road_detail');
            $table->text('road_percent');
            $table->text('culvert_detail');
            $table->text('culvert_percent');
            $table->text('bridge_detail');
            $table->text('trash_detail');
            $table->text('other_detail');
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
        Schema::dropIfExists('human_causes');
    }
}
