<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models;

class Website extends \Eloquent {

	protected $table = 'w_cms_websites';
	protected $fillable = array('name', 'url', 'theme');
	
}