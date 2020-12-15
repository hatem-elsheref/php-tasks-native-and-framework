<?php

define('MAIN','uploads');

define('PHONE_PATTERN','regex:/(05)[0-9]*/');
define('PHONE_DIGITS',10);
define('PAGINATION',10);
define('DEFAULT_AVATAR','default-user.png');
define('AVATAR_MAX_SIZE',20000);
define('ADMIN_ROLE','admin');
define('USER_ROLE','student');




// return the full path or url of system assets
if (!function_exists('myAssets')){
    function myAssets($asset){
        return asset('assets/'.$asset);
    }
}

// return the full path or url of uploaded files
if (!function_exists('uploads')){
    function uploads($file){
        return asset($file);
    }
}
