<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models;

class Media extends \Eloquent {

    protected $table = 'w_cms_medias';
    protected $fillable = array('name', 'alt', 'title', 'file_name');
}