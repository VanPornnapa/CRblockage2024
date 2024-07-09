<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBlockageCrossectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blockage_crossections', function (Blueprint $table) {
            $table->dropColumn(['blk_xsection_type', 'blk_xsection_width', 'blk_xsection_depth', 'blk_xsection_slope']);
            $table->json('past');
            $table->json('current_start');
            $table->json('current_narrow');
            $table->json('current_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blockage_crossections', function (Blueprint $table) {
            //
        });
    }
}
