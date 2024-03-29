<?php

 require_once $_SERVER['DOCUMENT_ROOT']."/libs/load.php";

class UserSession
{

    private $conn;
    public $token;
    public $data;
    public $uid;

    public function __construct($token)
    {
        $this->conn = Database::getConnection();
        $this->token = $token;
        $this->data = null;
        $sql = "SELECT * FROM `session` WHERE `token`='$token' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['uid']; //Updating this from database
        } else {
            throw new Exception("Session is invalid.");
        }
    }

    public static function authenticate($email, $pass, $fingerprint)
    {
        //login fuction returns username
        $username = User::login($email, $pass);
        if ($username) {
            $user = new User($username);
            $conn = Database::getConnection();
            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $fpjs = $fingerprint;
            $token = md5(rand(0, 9999999) . $ip . $agent .$fingerprint. time());
            $sql = "INSERT INTO `photogram`.`session` (`uid`, `token`, `login_time`, `ip`, `user_agent`, `active`, `fingerprint`)
            VALUES ('$user->id', '$token', now(), '$ip', '$agent', '1', '$fpjs')";
            if ($conn->query($sql)) {
                Session::set('session_token', $token);
                Session::set('fingerprint', $fpjs);
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function Authorize($token){

    }

    public function getUser()
    {
        return new User($this->uid);
    }

    /**
     * Check if the validity of the session is within one hour, else it inactive.
     *
     * @return boolean
     */
    public function isValid()
    {
        if (isset($this->data['login_time'])) {
            $login_time = DateTime::createFromFormat('Y-m-d H:i:s', $this->data['login_time']);
            if (3600 > time() - $login_time->getTimestamp()) {
                return true;
            } else {
                return false;
            }
        } else {
            throw new Exception("login time is null");
        }
    }

    public function getIP()
    {
        return isset($this->data["ip"]) ? $this->data["ip"] : false;
    }

    public function getUserAgent()
    {
        return isset($this->data["user_agent"]) ? $this->data["user_agent"] : false;
    }

    public function deactivate()
    {
        if (!$this->conn) {
            $this->conn = Database::getConnection();
        }
        $sql = "UPDATE `session` SET `active` = 0 WHERE `uid`=$this->uid";

        return $this->conn->query($sql) ? true : false;
    }

    public function isActive()
    {
        if (isset($this->data['active'])) {
            return $this->data['active'] ? true : false;
        }
    }

    public function getFingerprint()
    {
        if (isset($this->data['fingerprint'])) {
            return $this->data['fingerprint'] ? true : false;
        }
    }

    //This function remove current session
    public function removeSession()
    {
        if (isset($this->data['id'])) {
            $id = $this->data['id'];
            if (!$this->conn) {
                $this->conn = Database::getConnection();
            }
            $sql = "DELETE FROM `session` WHERE `id` = $id;";
            if ($this->conn->query($sql)) {
                return true;
            } else {
                return false;
            }
        }
    }
}



?>