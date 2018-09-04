<html>
<body>

<a href="userHome.php"> your library </a>

<h3> edit the info of an existing book</h3>
<?php 
    //in order to prevent confirm form resubmission
    header("Cache-Control: no cache");
    session_cache_limiter("private_no_expire");
    session_start();
    //messages upon completion
    if(!empty($_SESSION['restore_sucess']))
    {
        echo $_SESSION['restore_success'];
        unset($_SESSION['restore_success']);
    }
    if(!empty($_SESSION['delete_success'])){
        echo $_SESSION['delete_success'];
        unset($_SESSION['delete_success']);
    }
    if(!empty($_SESSION['edit_success'])){
        echo $_SESSION['edit_success'];
        unset ($_SESSION['edit_success']);
    }
?>
<form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method="POST">
    book id:<input type="text" name="b_id"><br>
    <input type="submit" value="look up">
    </form>

<?php

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $b_id=$_REQUEST["b_id"];
        //$u_id for checking if the book belongs to current user
        $u_id=$_SESSION['u_id'];
        //set connection and run query
        $conn= new mysqli("localhost", "newuser","password", "library");
        if($conn->connect_error) die("connection to db failed");
    
        $sql="SELECT title,author,isbn,category,entry_time,is_deleted FROM book WHERE b_id='$b_id' AND u_id='$u_id'";
        $result=$conn->query($sql);

        //first check if the book exists
        if($result->num_rows==0) die("the book does not exist or maybe the book is not yours");

        //then check if the book has been deleted
        $row=$result->fetch_assoc();
        //here the result will be printed
        echo "title: ".$row['title']."<br>";
        echo "author: ".$row['author']."<br>";
        echo "category: ".$row['category']."<br>";
        echo "isbn: ".$row['isbn']."<br>";
        echo "entry time: ".$row['entry_time']."<br>";
            
        //session variable to pass b_id in edit_db.php
        $_SESSION['b_id']=$b_id;

        if($row['is_deleted']==1) {
            echo "the book has been deleted<br>";
            echo "restore the book?<br>";
            //now restoring the books
            //logout needs to be added
            echo("<form action='edit_db.php' method='post' ><input type='submit'  value='restore' name='restore'></form>");             
           
        }
        else {
            //for edit
            echo 'submit the new values below<br>';
            echo '<form action="edit_db.php" method="post"><br>';
            echo 'title: <input type="text" name="title"><br>';
            echo 'author: <input type="text" name="author"><br>';
            echo 'category: <input type="text" name="category"><br>';
            echo 'isbn: <input type="text" name="isbn"><br>';
            echo '<input type="submit" value="edit" name="edit"><br>';
            echo '</form>';
            //for delete
            echo 'or delete this book<br>';
            echo("<form action='edit_db.php' method='post' ><input type='submit'  value='delete' name='delete'></form>");             


        }


    }

?>

