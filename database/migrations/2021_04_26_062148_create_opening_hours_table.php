<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpeningHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opening_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id')->nullable(false);
            $table->string('day', 10)->nullable(false);
            $table->time('open_at')->nullable(true);
            $table->time('close_at')->nullable(true);
            $table->boolean('full_day_open')->nullable(false)->default(0)->comment('Is full day open flag');
            $table->boolean('full_day_close')->nullable(false)->default(0)->comment('Is full day close flag');
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
        Schema::dropIfExists('opening_hours');
    }
}
