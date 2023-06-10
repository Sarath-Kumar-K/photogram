<?
require_once $_SERVER['DOCUMENT_ROOT']."/libs/load.php";

class User{
  
    private $conn;
    public $id;
    public $username;
    public $table;

    public function __construct($username)
    {
        $this->conn = Database::getConnection();
        $this->username = $username;
        $this->id = null;
        $this->table = 'auth';
        $sql = "SELECT `id` FROM `auth` WHERE `username`= '$username' or `id` = '$username' or `email` = '$username' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $this->id = $row['id']; //Updating this from database
        } else {
            throw new Exception("Username does't exist");
        }
    }

    public static function signup($username, $email, $phone, $password){

        $options = ['cost'=> 7,];
        $conn = Database::getConnection();
        $password = password_hash($password,PASSWORD_BCRYPT,$options);
        $sql = "INSERT INTO `photogram`.`auth` (`username`, `password`, `email`, `phone`) VALUES ('$username', '$password', '$email', '$phone')";
        try{
            return $conn->query($sql);
        } catch(Exception $e){
            return false;
        }       
    }

    public static function login($email, $pass){
        $conn = Database::getConnection();
        $sql = "select * from `auth` where `email` = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1){
            $row = $result->fetch_assoc();
            if(password_verify($pass,$row['password'])){
                return $row['username'];
            }else{
                return false;
            }
        }else{
            return false;
        }

    }

    public function __call($name,$arguments){
        if (substr($name,0,3) == "get"){
            return $this->get_data($name);
        }elseif(substr($name,0,3) == "set"){
            return $this->set_data($name,$arguments[0]);
        }else{
            throw new Exception(" User Doesn't exsist");
        }
    }
    
    private function get_data($key){
        if(!$this->conn){
             $this->conn = Database::getConnection();
        }
        $sql = "select * from `users` where `id` = $this->id";
        $result = $this->conn->query($sql);
        if ($result and $result->num_rows == 1){
            return $result->fetch_assoc()["$key"];
        }else{
            return null;
        }

    }
   
    private function set_data($key,$value){
        if (!$this->conn){
            $this->conn = Database::getConnection();
        }
        $sql = "update `users` set '$key'='$value' where `id`=$this->id";
        $result = $this->conn->query($sql);
        if ($result){
            return true;
        }else{
            return false;
        }
    }

    public function set_dob($year,$month,$day){
        if (checkdate($month,$day,$year)){
            return $this->set_data('dob',"$year.$month.$day");
        }else{
            return false;
        }
    }
}


?>