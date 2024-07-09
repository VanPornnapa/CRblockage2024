<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoVillageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_village', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('vill_code');
            $table->text('vill_name');
            $table->text('vill_tunbol');
            $table->text('vill_district');
            $table->text('vill_province');
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
        Schema::dropIfExists('info_village');
    }
}
