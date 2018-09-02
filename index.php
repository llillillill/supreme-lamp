<html>
<body>
<?php session_start() ?> 
 <!-- The page will start with logo -->

 <!-- login is going to land on books.php-->

 <h1> Library de-central</h1>

 <h2> LOGIN </h2>

<form method="post" action="log_in.php">

    User Name:<input type="text" name="userName"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value ="login">
</form>
<?php
//inorder to pass messages 
	//login_info wrong
	if(!empty($_SESSION['wrong_login_info']))
	{
		//sadat, here will be html formatting
		echo $_SESSION['wrong_login_info'];
		unset($_SESSION['wrong_login_info']);
	}
	//empty info
	if(!empty($_SESSION['empty_info'])){
		echo $_SESSION['empty_info'];
		unset($_SESSION['empty_info']);
	}
 ?>


<br>
<h1> Or <a href="signup.php"> SIGNUP </a></h1>
</body>
</html>
