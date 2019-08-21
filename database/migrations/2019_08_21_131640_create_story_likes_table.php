<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_likes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('reaction_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('story_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('story_id')
                ->references('id')
                ->on('stories');

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
        Schema::dropIfExists('story_likes');
    }
}
