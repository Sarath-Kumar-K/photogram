<?php

require_once $_SERVER['DOCUMENT_ROOT']."/libs/includes/User.class.php";

// $signup = false;
if (isset($_POST['username']) and isset($_POST['phone']) and isset($_POST['email']) and isset($_POST['password'])){
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $signup = User::signup($username,$email,$phone,$password);

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

