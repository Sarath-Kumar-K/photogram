<?
require_once "Database.class.php";

class User{
  
    private $conn;
    public $id;

    public function __call($name,$arguments){

        if (substr($name,0,3) == "get"){
            return $this->get_data($name);
        }elseif(substr($name,0,3) == "set"){
            return $this->set_data($name,$arguments[0]);
        }else{
            throw new Exception("function unavailable");
        }
    }

    public static function signup($username, $email, $phone, $password){

        $options = ['cost'=> 10,];
        $conn = Database::getConnection();
        $pass = password_hash($password,PASSWORD_BCRYPT,$options);
        $sql = "insert into `auth` (username,password,email,phone) values (`$username`,`$pass`,`$email`,`$phone`)";

        if($conn->query($sql)==true){
            $error = false;
        }else{
            $error = $conn->error;
        }
        return $error; 
    }

    public static function login($username, $pass){
        $conn = Database::getConnection();
        $sql = "select * from `auth` where `username` = '$username'";
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

    

    public function __construct($username)
    {
        $this->conn = Database::getConnection();
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