<?php
require_once $_SERVER['DOCUMENT_ROOT']."/libs/load.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <meta name="theme-color" content="#7952b3">
    
  </head>
  <body>
<?php

// $signup = false;
if (isset($_POST['username']) and isset($_POST['phone']) and isset($_POST['email']) and isset($_POST['password'])){
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $signup = User::signup($username,$password,$email,$phone);

}
if($signup){
    ?>
    <main class="container">
	<div class="bg-light p-5 rounded mt-3">
		<h1>Signup Success</h1>
		<p class="lead">Now you can login from <a
				href="/_templates/signin.php">here</a>
		</p>

	</div>
</main>
<?
}else{
    ?>
    <main class="container">
	<div class="bg-light p-5 rounded mt-3">
		<h1>Signup Fail</h1>
		<p class="lead">Something went wrong, <? echo "Error : ".$sql."<br>".$conn->error;?>
		</p>
        <p>Please <a class="lead" href="/_templates/signup.php"> Try Again</a>.
		</p>
	</div>
</main>
<?
}
?>
  </body>
</html>

