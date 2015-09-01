<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models;

class BlockType extends \Eloquent {

    protected $table = 'w_cms_block_types';
    protected $fillable = array('code', 'name', 'content_view', 'front_view', 'order');
}