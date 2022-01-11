<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropagendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propagend', function (Blueprint $table) {
            $table->id();
            $table->char('ID_instagram' , 255)->unique();
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
        Schema::dropIfExists('propagend');
    }
}
