<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('samples', function (Blueprint $table) {
            $table->integer('x_intervals')->nullable()->change();
            $table->integer('y_intervals')->nullable()->change();
            $table->boolean('auto_x_intervals');
            $table->boolean('auto_y_intervals');
            $table->boolean('is_public');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('samples', function (Blueprint $table) {
            $table->integer('x_intervals')->nullable(false)->change();
            $table->integer('y_intervals')->nullable(false)->change();
            $table->dropColumn('auto_x_intervals');
            $table->dropColumn('auto_y_intervals');
            $table->dropColumn('is_public');
        });
    }
};
