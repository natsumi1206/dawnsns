<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('follows', function (Blueprint $table) {
        $table->increments('id')->autoIncrement();
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->default(DB::raw('current_timestamp on update current_timestamp'));
        $table->unsignedInteger('user_id');
        $table->unsignedInteger('follow_id');

        //外部キー
        $table->foreign('user_id')
          ->references('id')
          ->on('users')
          // ->onDelete('cascade')
          ->onUpdate('cascade');

        $table->foreign('follow_id')
          ->references('id')
          ->on('users')
          // ->onDelete('cascade')
          ->onUpdate('cascade');

        // 組み合わせのダブりを禁止（二重フォローにならないように）
        $table->unique(['user_id', 'follow_id']);
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
