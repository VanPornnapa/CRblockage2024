<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngineerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineer', function (Blueprint $table) {
            $table->increments('id');
            $table->text('eng_id');
            $table->text('eng_Fname');
            $table->text('eng_Lname');
            $table->text('eng_position');
            $table->char('eng_conact_no', 10);
            $table->text('dep_id');
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
        Schema::dropIfExists('engineer');
    }
}
