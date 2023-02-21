<?


class Database{

    public static $conn = null;

    public static function getConnection(){
        $servername = get_config('servername');
        $username = get_config('username');
        $password = get_config('password');
        $dbname = get_config('dbname');
        if (Database::$conn == null){



            // create connection oject
            $connection = new mysqli( $servername,$username,$password,$dbname);

            // check connection
            if($connection->connect_error){
                die("Connection failed : ".$connection->connect_error);
            }else{
                //new connection establishing 
                Database::$conn = $connection;  //replacing null value with  connection
                return Database::$conn; 
            }
        }else{
            //return exsisting connection 
            return Database::$conn;
        }
    }

}

?>