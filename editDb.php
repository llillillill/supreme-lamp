<html>
<body>

<h3> edit the info of an existing book</h3>
<?php session_start();
    if(!empty($_SESSION['restore_sucess']))
    {
        echo $_SESSION['restore_success'];
        unset($_SESSION['restore_success']);
    }
?>
<form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method="POST">
    book id:<input type="text" name="b_id"><br>
    <input type="submit" value="look up">
    </form>

<?php

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $b_id=$_REQUEST["b_id"];

        //set connection and run query
        $conn= new mysqli("localhost", "newuser","password", "library");
        if($conn->connect_error) die("connection to db failed");
    
        $sql="SELECT title,author,isbn,category,entry_time,is_deleted FROM book WHERE b_id='$b_id'";
        $result=$conn->query($sql);

        //first check if the book exists
        if($result->num_rows==0) die("the book doesn't exist");

        //then check if the book has been deleted
        $row=$result->fetch_assoc();
        //here the result will be printed
        //echo "<"
        if($row['is_deleted']==1) {
            echo "the book has been deleted<br>";
            echo "restore the book?<br>";
            //now restoring the books
            //logout needs to be added
            $_SESSION['b_id']=$b_id;
            echo("<form action='delete.php' method='post' ><input type='submit'  value='restore' name='restore'></form>");             
           
        }


    }

?>

<!-- here will be two boxes, edit and delete the actions will be then passed to edit_db or delete_db-->