<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockageCrossectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blockage_crossections', function (Blueprint $table) {
            $table->char('blk_xsection_id',15)->primary();
            $table->char('blk_id', 15);
            $table->char('culvert_id', 15);
            $table->text('blk_xsection_type');
            $table->text('blk_xsection_width');
            $table->text('blk_xsection_depth');
            $table->text('blk_xsection_slope');
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
        Schema::dropIfExists('blockage_crossections');
    }
}
