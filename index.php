<html>
<body>
 
 <!-- The page will start with logo -->

 <!-- login is going to land on books.php-->

 <h1> Library de-central</h1>

 <h2> LOGIN </h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">

    User Name:<input type="text" name="userName"><br>
    Password: <input type="password" name="password"><br>
    <input type="submit" value ="login">
</form>
<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST" ){
        //collect name and Password
        //empty() will be added here
        $username=$_REQUEST["userName"];
        $password=$_REQUEST["password"];

        if(empty($username)||empty($_password)){
            die("enter your info again");
        }

        echo $username;
        echo $password;
        //password will be hashed now
        
        //create connection with db
        $conn=new mysqli('localhost','newuser','password','library');
        //check connection
        if ($conn->connect_error) die("connection failed ".$conn->connect_error);

        //sql for validating
        $sql="SELECT l-id from login WHERE username='$username' AND password='$password'";
        $result=$conn->query($sql);

        //password/username not valid, so die!
        if($result->num_rows==0) {
            echo ("wrong username / password"."<br>"."login failed");
        }
        //password matched, redirect to groups
        else {
                echo "succeded!";
                //now there will be a redirection to groups.php
                $_SESSION["user"]=$username;
               echo "<script> location.href='index.php'; </script>"; 
                exit;
            }
        }
    
 ?>

<br>
<h1> Or <a href="signup.php"> SIGNUP </a></h1>
</body>
</html>
