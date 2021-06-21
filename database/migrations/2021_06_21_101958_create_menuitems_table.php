<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuitems', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('access_group_id')->default(0);
            $table->unsignedInteger('node')->default(0);
            $table->unsignedInteger('mode')->default(1);
            $table->unsignedInteger('level')->default(0);
            $table->unsignedInteger('parent')->default(0);
            $table->unsignedInteger('order')->default(0);
            $table->string('purpose')->default('');
            $table->string('mnemo')->default('');
            $table->string('url')->default('');
            $table->unsignedInteger('section_id')->nullable()->default(null);
            $table->boolean('hidden')->default(false);
            $table->boolean('off')->default(false);
            $table->unique(['access_group_id', 'node', 'mode', 'level', 'parent']);
            $table->timestamps();
        });

        (new \Database\Seeders\MenuitemSeeder())->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menuitems');
    }
}
