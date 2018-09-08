<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST" ){
        //collect name and Password

        $username=$_REQUEST["userName"];
        $password=$_REQUEST["password"];
        //check if empty
        if(empty($username)||empty($password)){
            $_SESSION['empty_info']="submit the form with data";
            echo "<script> location.href='index.php'; </script>";
            exit;
        }

        else {

        //create connection with db
        $conn=new mysqli('localhost','root','amarsql','library');
        //check connection
        if ($conn->connect_error) die("connection failed ".$conn->connect_error);

        //sql for validating
        //first checking if the user name exists
        $sql="SELECT l_id FROM login WHERE username='$username'";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();

        if($result->num_rows==0) {
           $_SESSION['wrong_login_info']="wrong username / password"."<br>"."login failed";
              echo "<script> location.href='index.php'; </script>";
              exit;
        }
        //now password
        $sql="SELECT password FROM login WHERE username='$username'";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        //matching the password with hash in db
        if(password_verify($password,$row['password'])){
            //getting the u_id for further use
                $sql="SELECT u_id FROM user WHERE username='$username'";
                $result=$conn->query($sql);
                $u_id=$result->fetch_assoc();
                $_SESSION["u_id"]=$u_id['u_id'];
	         echo "<script> location.href='home.php'; </script>";
            //then the list will start here
            }
        else $_SESSION['wrong_login_info']="wrong username / password"."<br>"."login failed";
        echo "<script> location.href='index.php'; </script>";
        exit;
    }
    }


 ?>
