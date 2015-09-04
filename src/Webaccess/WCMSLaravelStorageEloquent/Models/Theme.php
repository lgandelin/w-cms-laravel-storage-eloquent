<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models;

class Theme extends \Eloquent {

    protected $table = 'w_cms_themes';
    protected $fillable = array('identifier', 'is_selected');
}