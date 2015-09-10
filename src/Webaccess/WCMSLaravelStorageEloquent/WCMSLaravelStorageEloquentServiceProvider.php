<?php

namespace Webaccess\WCMSLaravelStorageEloquent;

use Webaccess\WCMSCore\Context;
use Illuminate\Support\ServiceProvider;
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
use Webaccess\WCMSLaravelStorageEloquent\Repositories\EloquentThemeRepository;
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
        Context::add('page_repository', new EloquentPageRepository());
        Context::add('area_repository', new EloquentAreaRepository());
        Context::add('block_repository', new EloquentBlockRepository());
        Context::add('lang_repository', new EloquentLangRepository());
        Context::add('menu_repository', new EloquentMenuRepository());
        Context::add('menu_item_repository', new EloquentMenuItemRepository());
        Context::add('media_repository', new EloquentMediaRepository());
        Context::add('media_format_repository', new EloquentMediaFormatRepository());
        Context::add('article_repository', new EloquentArticleRepository());
        Context::add('user_repository', new EloquentUserRepository());
        Context::add('article_category_repository', new EloquentArticleCategoryRepository());
        Context::add('block_type_repository', new EloquentBlockTypeRepository());
        Context::add('theme_repository', new EloquentThemeRepository());
    }
} 