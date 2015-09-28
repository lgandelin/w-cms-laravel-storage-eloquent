<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models\Blocks;

class ArticleListBlock extends \Eloquent
{
    protected $table = 'w_cms_blocks_article_list';
    protected $fillable = array('article_list_category_id', 'article_list_order', 'article_list_number');

    public function block() {
        return $this->morphOne('\Webaccess\WCMSLaravelStorageEloquent\Models\Block', 'blockable');
    }
}