<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('update_id');
            $table->integer('message_id');
            $table->integer('chat_id');
            $table->string('username');
            $table->string('picture_name');
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
        Schema::dropIfExists('sses');
    }
}
