<?php

namespace App\Providers;

use ehwas\documents\collections\ImageCollectionProvider;
use ehwas\documents\collections\ImageCollector;
use ehwas\documents\references\ResourceLocationProvider;
use ehwas\documents\references\ResourceLocatior;
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

        app()->bind('imagecollector', ImageCollectionProvider::class);
        app()->bind(ImageCollectionProvider::class, function($api) {
            return new ImageCollectionProvider(new ImageCollector());
        });

        app()->bind('resourcelocator', ResourceLocationProvider::class);
        app()->bind(ResourceLocationProvider::class, function($api) {
            return new ResourceLocationProvider(new ResourceLocatior());
        });
    }
}
