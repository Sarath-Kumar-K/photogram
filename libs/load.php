<?php

include_once 'includes/Session.class.php';
include_once 'includes/User.class.php';
include_once 'includes/Database.class.php';
include_once 'includes/Usersession.class.php';

global $_site_config;

$_site_config = file_get_contents('/var/www/photogram_db_config.json');
// echo $_site_config;

Session::start();

function get_config($key, $default = null){ 
    global $_site_config;
    $array = json_decode($_site_config, true);
    if(isset($array[$key])){
        return $array[$key];
    }else{
        return $default;
    }
}

?>