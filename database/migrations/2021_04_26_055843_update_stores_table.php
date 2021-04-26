<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('code', 40)->nullable(true)->after('id');
            $table->unsignedBigInteger('district_id')->nullable(true)->after('br_no');
            $table->unsignedBigInteger('area_id')->nullable(true)->after('br_no');
            $table->unsignedBigInteger('created_by')->nullable(true)->after('created_at');
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
            $table->dropColumn('code');
            $table->dropColumn('district_id');
            $table->dropColumn('area_id');
        });
    }
}
