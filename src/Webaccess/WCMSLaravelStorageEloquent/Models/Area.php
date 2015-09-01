<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models;

class Area extends \Eloquent {

    protected $table = 'w_cms_areas';
    protected $fillable = array('name', 'width', 'height', 'class', 'order', 'display', 'is_master', 'master_area_id');

    public function page()
    {
        return $this->hasOne('Webaccess\WCMSLaravelStorageEloquent\Models\Page');
    }
}