<html>
<body>
<?php session_start() ?>
 <h1> SIGNUP </h1>
 <form action="sign_up.php" method="post">
 	<h3>due to lazy developer, no email validation is required (also feel free to spam)</h3>
 	<h3> just provide a unique username</h3>
    
 	User Name: <input type="text" name="username"><br>
 	Password: <input type="password" name="password"><br>
 	Confirm Password: <input type="password" name="confirm_pass"><br>
    email:<input type="text" name="email"><br>
    phone number:<input type="text" name="phone"><br>

 	<input type="submit" value="SIGNUP">
 </form>

<?php
//inorder to pass messages from sign_up.php
	//username error message
	if(!empty($_SESSION['same_username_error']))
	{
		//sadat, here will be html formatting
		echo $_SESSION['same_username_error'];
		unset($_SESSION['same_username_error']);
	}
	//not same passsword
	if(!empty($_SESSION['password_error'])){
		echo $_SESSION['password_error'];
		unset($_SESSION['password_error']);
	}
 ?>

<h3> already have an account? then why did you come here?<h3>
	<h3> <a href="login.php"> LOGIN </a></h3>


</body>
</html>




