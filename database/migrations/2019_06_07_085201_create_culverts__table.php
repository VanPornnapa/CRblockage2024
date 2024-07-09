<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCulvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('culverts', function (Blueprint $table) {
            $table->char('culvert_id', 15)->primary();
            $table->text('culvert_type');
            $table->float('diameter');
            $table->float('culvert_width');
            $table->float('culvert_hight');
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
        Schema::dropIfExists('culverts');
    }
}
