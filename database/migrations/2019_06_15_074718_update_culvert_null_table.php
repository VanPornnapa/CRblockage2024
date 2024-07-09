<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCulvertNullTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //  // drop culvert FK
        //  Schema::table('blockage_crossections', function (Blueprint $table) {
        //     $table->dropColumn(['culvert_id']);
        // });
        Schema::table('blockage_crossections', function (Blueprint $table) {
            $table->dropForeign('blockage_crossections_culvert_id_foreign');
            $table->dropColumn('culvert_id');
        });
    }
}
