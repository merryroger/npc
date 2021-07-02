<?php

namespace App\Providers;

use ehwas\documents\tyrion\TyrionDocumentProvider;
use ehwas\documents\tyrion\TyrionReader;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        app()->bind('tyrion', TyrionDocumentProvider::class);
        app()->bind(TyrionDocumentProvider::class, function($api) {
            return new TyrionDocumentProvider(new TyrionReader());
        });
    }
}
