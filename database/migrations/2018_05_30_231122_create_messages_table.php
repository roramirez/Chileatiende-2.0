<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('page_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('page_id')->references('id')->on('pages');
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
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('messages_page_id_foreign');
            $table->dropForeign('messages_user_id_foreign');
        });
        Schema::dropIfExists('messages');
    }
}
