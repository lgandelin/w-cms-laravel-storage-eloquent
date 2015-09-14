<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models\Blocks;

class ControllerBlock extends \Eloquent
{
    protected $table = 'w_cms_blocks_controller';
    protected $fillable = array('class_path', 'method');

    public function block() {
        return $this->morphOne('\Webaccess\WCMSLaravelStorageEloquent\Models\Block', 'blockable');
    }
}