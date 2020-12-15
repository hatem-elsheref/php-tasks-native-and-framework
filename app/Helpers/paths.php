<?php

// return the full path or url of backend assets
if (!function_exists('backendAssets')){
    function backendAssets($asset){
        return asset('assets/backend/'.$asset);
    }
}




// prepare the new full name of the uploaded file for user/admin/etc..
if(!function_exists('preparePathToUpload')){
    function preparePathToUpload($request,$folderName){
        $name=time().'-'.Str::slug($request->name).'-image.'.$request->file('image')->getClientOriginalExtension();
        return mainPath($folderName.'/'.$name);
    }
}

// return the full path or url of uploaded files
if (!function_exists('uploads')){
    function uploads($file){
        return asset($file);
    }
}

// return the name of the main folder of uploaded files
if (!function_exists('mainPath')){
    function mainPath($file){
        return 'uploads/'.$file;
    }
}

// return the full path of the given file
if (!function_exists('fullPath')){
    function fullPath($file){
        return base_path('public/'.$file);
    }
}
