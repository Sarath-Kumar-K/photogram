<?

class User{
  
    private $conn;
    public static function signup($username, $pass, $email, $phone){

        $conn = Database::getConnection();
        $pass = md5($pass);
        $sql = "insert into tablename(columns) values (vaues)";

        if($conn->query($sql)==true){
            $error = false;
        }else{
            $error = $conn->error;
        }
        return $error; 
    }

    public static function login($username, $pass){
        $conn = Database::getConnection();
        $pass = md5($pass);
        $sql = "sql query";
        $result = $conn->query($sql);
        if ($conn->num_rows == 1){
            $row = $conn->fetch_assoc();
            if($row['password'] == $pass){
                return $row;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function __construct($username)
    {
        $this->conn = Database::getConnection();
        $this->conn->query();
    }
}

?>