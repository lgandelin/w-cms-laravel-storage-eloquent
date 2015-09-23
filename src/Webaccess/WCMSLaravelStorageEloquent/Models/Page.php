<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models;

class Page extends \Eloquent {

	protected $table = 'w_cms_pages';
	protected $fillable = array('name', 'identifier', 'uri', 'lang_id', 'meta_title', 'meta_description', 'meta_keywords', 'is_indexed', 'is_master', 'master_page_id');
}