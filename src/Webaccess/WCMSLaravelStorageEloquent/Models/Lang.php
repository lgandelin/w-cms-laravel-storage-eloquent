<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models;

class Lang extends \Eloquent {

    protected $table = 'w_cms_langs';
    protected $fillable = array('name', 'prefix', 'is_default');
}