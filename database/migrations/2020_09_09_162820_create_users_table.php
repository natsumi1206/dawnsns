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
          $table->increments('id')->autoIncrement();
          $table->string('username',255);
          $table->string('mail',255);
          $table->string('password',255);
          $table->string('remember_token',255)->nullable();
          $table->string('bio',400)->nullable();
          $table->string('images', 1000)->default('dawn.png')->nullable();
          $table->timestamp('created_at')->useCurrent();
          $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'));
      });
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
