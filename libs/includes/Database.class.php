<?

class Database{

    public static $conn = null;

    public static function getConnection(){

        if (Database::$conn == null){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "dbname";

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