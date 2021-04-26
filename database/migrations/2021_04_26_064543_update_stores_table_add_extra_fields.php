<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStoresTableAddExtraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->text('description')->nullable(true)->after('name');
            $table->text('special_notes')->nullable(true)->after('district_id');
            $table->integer('status')->nullable(false)->default(0)->comment('Status 0 = pending, 1 = approved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('special_notes');
            $table->dropColumn('status');
        });
    }
}
