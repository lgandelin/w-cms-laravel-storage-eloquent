<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models;

class Menu extends \Eloquent {

    protected $table = 'w_cms_menus';
    protected $fillable = array('name', 'identifier', 'lang_id');

    public function items()
    {
        return $this->hasMany('Webaccess\WCMSLaravelStorageEloquent\Models\MenuItem');
    }
    
}