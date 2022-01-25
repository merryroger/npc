<?php

namespace App\Providers;

use ehwas\documents\collections\ImageCollectionProvider;
use ehwas\documents\collections\ImageCollector;
use ehwas\documents\collections\ImageGalleryCollector;
use ehwas\documents\collections\ImageGalleryProvider;
use ehwas\documents\references\ResourceLocationProvider;
use ehwas\documents\references\ResourceLocatior;
use ehwas\documents\references\TagLibrary;
use ehwas\documents\references\TagLibraryProvider;
use ehwas\documents\tyrion\TyrionDocumentProvider;
use ehwas\documents\tyrion\TyrionReader;
use ehwas\news\NewslineProvider;
use ehwas\news\NewslineReader;
use ehwas\root\HomepageBuilder;
use ehwas\root\HomepageProvider;
use ehwas\videos\VideosProvider;
use ehwas\videos\VideoPageCollector;
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

        app()->bind('newsmessage', NewslineProvider::class);
        app()->bind('newslist', NewslineProvider::class);
        app()->bind('newsline', NewslineProvider::class);
        app()->bind(NewslineProvider::class, function($api) {
            return new NewslineProvider(new NewslineReader());
        });

        app()->bind('rootpage', HomepageProvider::class);
        app()->bind(HomepageProvider::class, function($api) {
            return new HomepageProvider(new HomepageBuilder());
        });

        app()->bind('photogallery', ImageGalleryProvider::class);
        app()->bind(ImageGalleryProvider::class, function($api) {
            return new ImageGalleryProvider(new ImageGalleryCollector());
        });

        app()->bind('videos', VideosProvider::class);
        app()->bind(VideosProvider::class, function($api) {
            return new VideosProvider(new VideoPageCollector());
        });

        app()->bind('imagecollector', ImageCollectionProvider::class);
        app()->bind(ImageCollectionProvider::class, function($api) {
            return new ImageCollectionProvider(new ImageCollector());
        });

        app()->bind('resourcelocator', ResourceLocationProvider::class);
        app()->bind(ResourceLocationProvider::class, function($api) {
            return new ResourceLocationProvider(new ResourceLocatior());
        });

        app()->bind('taglibrary', TagLibraryProvider::class);
        app()->bind(TagLibraryProvider::class, function($api) {
            return new TagLibraryProvider(new TagLibrary());
        });
    }
}
