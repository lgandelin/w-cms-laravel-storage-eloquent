<?php

namespace Webaccess\WCMSLaravelStorageEloquent\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends \Eloquent implements AuthenticatableContract {

    use Authenticatable;

    protected $table = 'w_cms_users';
    protected $fillable = array('login', 'password', 'last_name', 'first_name', 'email');
}