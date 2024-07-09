<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropParamNameProjectOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function($table) {
            $table->dropColumn('proj_char');
            $table->dropColumn('proj_name');
            $table->dropColumn('proj_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function($table) {
            $table->char('proj_char');
            $table->char('proj_name');
            $table->char('proj_type');
        });
    }
}
