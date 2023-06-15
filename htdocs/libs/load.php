<?php

include_once 'includes/Session.class.php';
include_once 'includes/User.class.php';
include_once 'includes/Database.class.php';
include_once 'includes/Usersession.class.php';
include_once 'includes/WebApi.class.php';

$wapi = new WebApi();
$wapi->initiateSession();


function get_config($key, $default = null){ 
    global $_site_config;
    $array = json_decode($_site_config, true);
    if(isset($array[$key])){
        return $array[$key];
    }else{
        return $default;
    }
}

function load_template($name){

    include $_SERVER['DOCUMENT_ROOT'].get_config('base_path')."/_templates/$name";
}

?>