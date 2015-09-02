<?php

namespace Webaccess\WCMSLaravelStorageEloquent;

use CMS\Context;
use Illuminate\Support\ServiceProvider;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\Blocks\EloquentBlockArticleListRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\Blocks\EloquentBlockArticleRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\Blocks\EloquentBlockHTMLRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\Blocks\EloquentBlockMediaRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\Blocks\EloquentBlockMenuRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\Blocks\EloquentBlockViewRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentAreaRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentArticleCategoryRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentArticleRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentBlockRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentBlockTypeRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentLangRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentMediaFormatRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentMediaRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentMenuItemRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentMenuRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentPageRepository;
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentUserRepository;

class WCMSLaravelStorageEloquentServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../database/' => base_path('/database')
        ], 'database');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //Init repositories
        Context::add('block_html', new EloquentBlockHTMLRepository());
        Context::add('block_menu', new EloquentBlockMenuRepository());
        Context::add('block_article', new EloquentBlockArticleRepository());
        Context::add('block_article_list', new EloquentBlockArticleListRepository());
        Context::add('block_media', new EloquentBlockMediaRepository());
        Context::add('block_view', new EloquentBlockViewRepository());

        Context::add('page', new EloquentPageRepository());
        Context::add('area', new EloquentAreaRepository());
        Context::add('block', new EloquentBlockRepository());
        Context::add('lang', new EloquentLangRepository());
        Context::add('menu', new EloquentMenuRepository());
        Context::add('menu_item', new EloquentMenuItemRepository());
        Context::add('media', new EloquentMediaRepository());
        Context::add('media_format', new EloquentMediaFormatRepository());
        Context::add('article', new EloquentArticleRepository());
        Context::add('user', new EloquentUserRepository());
        Context::add('article_category', new EloquentArticleCategoryRepository());
        Context::add('block_type', new EloquentBlockTypeRepository());
    }
} 