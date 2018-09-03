<?php
    session_start();
    $conn=new mysqli("localhost","newuser","password","library");
    if($conn->connect_error) die("connection to db failed");

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $title=$_REQUEST['title'];
        $author=$_REQUEST['author'];
        $isbn=$_REQUEST['isbn'];
        $category=$_REQUEST['category'];
        //getting u_id of the current user to update book table
        $u_id=$_SESSION['u_id'];
        //check if empty
        if(empty($title)||empty($author)){
            $_SESSION['empty_book_info']="title and author name must not be empty";
            echo "<script> location.href='updateDb.php'; </script>"; 
        }
        //else update the db
        else {
            $conn=new mysqli("localhost","newuser","password","library");
            if($conn->connect_error) die("connection to db failed");
            $sql="INSERT INTO `book` (`b_id`, `title`, `author`, `isbn`, `u_id`, `category`) VALUES (NULL, '$title', '$author', '$isbn', '$u_id', '$category')";
            $conn->query($sql);
            echo "<script> location.href='userHome.php'; </script>"; 
        }



    }