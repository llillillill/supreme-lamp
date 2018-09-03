<?php
    session_start();
    $conn=new mysqli("localhost","newuser","password","library");
    if($conn->connect_error) die("connection to db failed");

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $title=$_REQUEST['title'];
        $author=$_REQUEST['author'];
        $isbn=$_REQUEST['isbn'];
        $category=$_REQUEST['category'];
        $u_id=$_SESSION['u_id'];
        //check if empty
        if(empty($title)||empty($author)){
            $_SESSION['empty_book_info']="title and author name must not be empty";
        }
        //else update the db
        else {
            $conn=new mysqli("localhost","newuser","password","library");
            if($conn->connect_error) die("connection to db failed");
            $sql="INSERT INTO books VALUES(NULL,'$title','$author','$isbn','$u_id,'$category'";

        }



    }