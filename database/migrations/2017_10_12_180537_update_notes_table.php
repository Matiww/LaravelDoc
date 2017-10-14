<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->text('content')->nullable()->change();
            $table->dateTime('date')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->tinyInteger('important')->default(0);
            $table->tinyInteger('private')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes', function($table) {
            $table->dropColumn('active');
            $table->dropColumn('important');
            $table->dropColumn('private');
            $table->dropColumn('date');
        });
    }
}
