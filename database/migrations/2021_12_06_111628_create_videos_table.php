<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('width')->default(560);
            $table->unsignedSmallInteger('height')->default(315);
            $table->string('source')->unique()->default('');
            $table->string('preview')->nullable();
            $table->string('comment', 128)->nullable();
            $table->dateTime('official_video_date')->default('2000-01-01 00:00:00');
            $table->boolean('hidden')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
