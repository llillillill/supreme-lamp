<html>
<body>

<?php session_start()?>
<h1> update the db </h1>

<h3> please give info the way it is written on the book</h3>

<form action="update_db.php" method="post">
Title:<input type="text" name="title"><br>
Author:<input type="text" name="author"><br>
isbn: <input type="text" name="isbn"><br>
Category: <input type="text" name="category">

<input type="submit" value="update">
</form>

<?php
//inorder to pass messages 
	//login_info wrong
	if(!empty($_SESSION['empty_book_info']))
	{
		//sadat, here will be html formatting
		echo $_SESSION['empty_book_info'];
		unset($_SESSION['empty_book_info']);
    }
    
 ?>
