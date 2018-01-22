<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->boolean('isActive')->default(false);
            $table->boolean('isAdmin')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
            [ 'username' => 'Admin', 'email'=>'admin@admin.com', 'password'=> bcrypt('admin'), 'isAdmin'=>'1', 'isActive'=>'1'],
            [ 'username'=> 'Regular', 'email'=>'regular@regular.com', 'password'=> bcrypt('regular'), 'isAdmin'=>'0', 'isActive'=>'1']

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
