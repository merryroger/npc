<?php

namespace App\Providers;

use ehwas\documents\collections\PhotoCollectionProvider;
use ehwas\documents\collections\PhotoCollector;
use ehwas\documents\tyrion\TyrionDocumentProvider;
use ehwas\documents\tyrion\TyrionReader;
use ehwas\news\NewslineProvider;
use ehwas\news\NewslineReader;
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

        app()->bind('newsline', NewslineProvider::class);
        app()->bind(NewslineProvider::class, function($api) {
            return new NewslineProvider(new NewslineReader());
        });

        app()->bind('photocollector', PhotoCollectionProvider::class);
        app()->bind(PhotoCollectionProvider::class, function($api) {
            return new PhotoCollectionProvider(new PhotoCollector());
        });
    }
}
