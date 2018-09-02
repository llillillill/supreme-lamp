<?php
    session_start();
 //establish connection
	 $conn= new mysqli("localhost", "newuser","password", "library");
	if($conn->connect_error) die("connection to db failed");

	if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_REQUEST["username"];
   
    //empty will be added here
	
	

	$sql="SELECT u_id FROM user WHERE username='$username'";
	$result=($conn->query($sql));
//checking if the name is unique
	if($result->num_rows!=0) $_SESSION['same_username_error']="someone else has thought that name before you. sorry!.<br>";
//name is unique, then
	else{
		$password=$_REQUEST['password'];
        $confirm_pass=$_REQUEST['confirm_pass'];
       
		$email=$_REQUEST['email'];
		$phone=$_REQUEST['phone'];

		//checking if two passwords are same
		if($password==$confirm_pass){
			//now update db
			echo 'done!';
			$sql="INSERT INTO user (username, email, phone) VALUES ('$username', '$email', '$phone')";
			$conn->query($sql);
            $hashed_password=password_hash($password,PASSWORD_DEFAULT);
            //now store the hashed password in the login page
            $sql="SELECT u_id FROM user WHERE username='$username'";
            $result=conn->query($sql);
            $sql="INSERT INTO login ("
            var_dump($hashed_password);
            
			 echo "<script> location.href='index.php'; </script>";
			 exit;

		}
		//or else 
		else $_SESSION['password_error']="password didn't match, fill the form again<br>";
    }
     echo "<script> location.href='signup.php'; </script>"; 
     exit;
}
?>