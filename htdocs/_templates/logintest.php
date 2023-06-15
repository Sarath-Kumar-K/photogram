<?php

require_once $_SERVER['DOCUMENT_ROOT']."/libs/includes/Usersession.class.php";

if (isset($_POST['email']) and isset($_POST['password']) and isset($_POST['fingerprint'])){

    $email = $_POST['email'];
    $password = $_POST["password"];
    $fingerprint = $_POST['fingerprint'];

    $login = UserSession::authenticate($email,$password,$fingerprint);

    if($login){
        
        header("Location: /index.php");
        die();
    }else {
        header("Location: /_templates/signin.php");
        ?>
        <script>
            alert("Login Failed..   Try Again");
        </script>
        <?php
        die();
    }
    

}else{
    ?>
    <script>alert("Fill the form completely")</script>
    <?

}
?>