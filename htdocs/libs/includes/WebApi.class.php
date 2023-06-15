<?
class WebApi
{

    public function __construct()
    {
            global $_site_config;
            $_site_config_path = __DIR__."/../../../project/photogram_db_config.json";
            $_site_config = file_get_contents($_site_config_path);
        
        Database::getConnection();

    }

    public function initiateSession()
    {
        Session::start();
    }
}