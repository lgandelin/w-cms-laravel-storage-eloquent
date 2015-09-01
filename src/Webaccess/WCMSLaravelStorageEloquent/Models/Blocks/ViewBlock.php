<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models\Blocks;

class ViewBlock extends \Eloquent
{
    protected $table = 'w_cms_blocks_view';
    protected $fillable = array('view_path');

    public function block() {
        return $this->morphOne('\Webaccess\WCMSLaravelStorageEloquent\Models\Block', 'blockable');
    }
}