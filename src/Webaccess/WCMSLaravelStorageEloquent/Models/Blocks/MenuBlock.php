<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models\Blocks;

class MenuBlock extends \Eloquent
{
    protected $table = 'w_cms_blocks_menu';
    protected $fillable = array('menu_id');

    public function block() {
        return $this->morphOne('\Webaccess\WCMSLaravelStorageEloquent\Models\Block', 'blockable');
    }
}