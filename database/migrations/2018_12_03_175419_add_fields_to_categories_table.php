<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->tinyInteger("lft")->nullable();
            $table->tinyInteger("rgt")->nullable();
            $table->tinyInteger("parent_id")->nullable();
            $table->tinyInteger("depth")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn("lft");
            $table->dropColumn("rgt");
            $table->dropColumn("parent_id");
            $table->dropColumn("depth");
        });
    }
}
