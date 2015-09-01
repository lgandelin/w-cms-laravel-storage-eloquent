<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models\Blocks;

class MediaBlock extends \Eloquent
{
    protected $table = 'w_cms_blocks_media';
    protected $fillable = array('media_id', 'media_link', 'media_format_id');

    public function block() {
        return $this->morphOne('\Webaccess\WCMSLaravelStorageEloquent\Models\Block', 'blockable');
    }
}