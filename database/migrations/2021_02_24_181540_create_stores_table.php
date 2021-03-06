<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable(false);
            $table->text('address', 100);
            $table->text('address_formatted', 100);
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('fixed_no', 10);
            $table->string('mobile_no', 10);
            $table->string('fax_no', 10);
            $table->string('email', 60);
            $table->unsignedBigInteger('admin_id')->nullable(true);
            $table->string('br_no', 60);
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
        Schema::dropIfExists('stores');
    }
}
