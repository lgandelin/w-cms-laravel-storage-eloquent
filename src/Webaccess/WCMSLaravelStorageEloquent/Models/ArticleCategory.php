<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models;

class ArticleCategory extends \Eloquent {

    protected $table = 'w_cms_article_categories';
    protected $fillable = array('name', 'description', 'lang_id');

}