<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->char('ID_instagram' , 255)->unique();
            $table->char('thumbnail_url', 255);
            $table->string('source_url',540);
            $table->text('captions', 255);
            $table->unsignedBigInteger('view');
            $table->unsignedBigInteger('like');
            $table->unsignedBigInteger('comment');
            $table->char('owner' , 255);
            $table->char('tag' , 255);
            $table->enum('type_media' , ['image' ,'video', 'sidecar']);
            $table->char('date' , 255);
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
        Schema::dropIfExists('posts');
    }
}
