<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models\Blocks;

class ArticleBlock extends \Eloquent
{
    protected $table = 'w_cms_blocks_article';
    protected $fillable = array('article_id');

    public function block() {
        return $this->morphOne('\Webaccess\WCMSLaravelStorageEloquent\Models\Block', 'blockable');
    }
}