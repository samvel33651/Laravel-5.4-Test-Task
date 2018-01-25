<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id');
            $table->string('item_name');
            $table->integer('vendor_id')->unsigned()->nullable();
            $table->string('serial_number');
            $table->integer('type_id')->unsigned()->nullable();
            $table->float('price', 8, 2);
            $table->float('weight', 8, 2);
            $table->string('color');
            $table->timestamp('release_date')->nullable();
            $table->string('photo');
            $table->string('tags');
            $table->timestamps();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
