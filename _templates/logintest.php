<?php

require_once $_SERVER['DOCUMENT_ROOT']."/libs/includes/User.class.php";

if (isset($_POST['email']) and isset($_POST['password'])){

    $email = $_POST['email'];
    $password = $_POST["password"];

    $login = User::login($email,$password);

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