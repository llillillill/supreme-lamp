<?php 
    session_start();

    $conn= new mysqli("localhost", "newuser","password", "library");
    if($conn->connect_error) die("connection to db failed");


    //for return
    if(isset($_POST['return'])){
        $i_id=$_SESSION['i_id'];
        $sql="INSERT INTO return_info(i_id) VALUES('$i_id')";
        $conn->query($sql);
        unset($_SESSION[$b_id]);
        unset($_POST['return']);
        $_SESSION['return_success']="returned!";
        echo "<script> location.href='issueReturn.php'; </script>"; 

    }
    if(isset($_POST['issue'])){
        $username=$_POST['username'];
        $sql="SELECT u_id  FROM user WHERE username='$username'";
        //if there is no user in that name
        $result=$conn->query($sql);
        if($result->num_rows==0){
            die("username doesn't exist, go back and submit again");
        }

        $row=$result->fetch_assoc();

        if($_SESSION['u_id']==$row['u_id']){
            die("you want to issue the book to yourself?! go back and submit again");
        }

        //oke now update the issue table

        
    }
?>