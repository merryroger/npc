<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirewallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firewalls', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ip')->unsigned()->unique()->default(0);
            $table->integer('mask')->unsigned()->default(0);
            $table->integer('bitmask')->unsigned()->default(0);
            $table->set('authtype', ['login', 'email'])->default('email');
            $table->boolean('off')->default(false);
            $table->timestamps();
        });

        (new \Database\Seeders\FirewallSeeder())->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firewalls');
    }
}
