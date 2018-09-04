<html>
<body>

<?php session_start() ?>
<a href="userHome.php"> your library </a>

<form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' method="POST">
    book id:<input type="text" name="b_id"><br>
    <input type="submit" value="look up">
    </form>

<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    $b_id=$_REQUEST["b_id"];

    if(empty($b_id)) die("enter the book id<br>");
    //$u_id for checking if the book belongs to current user
    $u_id=$_SESSION['u_id'];
    echo $u_id."<br>";
    //set connection and run query
    $conn= new mysqli("localhost", "newuser","password", "library");
    if($conn->connect_error) die("connection to db failed");

    $sql="SELECT title,author,isbn,category,entry_time,is_deleted FROM book WHERE b_id='$b_id' AND u_id='$u_id'";
    $result=$conn->query($sql);

    //first check if the book exists
    if($result->num_rows==0) die("the book does not exist or maybe the book is not yours");

    $row=$result->fetch_assoc();
    //here the result will be printed
    echo "title: ".$row['title']."<br>";
    echo "author: ".$row['author']."<br>";
    echo "category: ".$row['category']."<br>";
    echo "isbn: ".$row['isbn']."<br>";
    echo "entry time: ".$row['entry_time']."<br>";
        
    //session variable to pass b_id in issue_return.php
    $_SESSION['b_id']=$b_id;

    //then check if the book has been deleted
    if($row['is_deleted']==1) {
        echo "the book has been deleted<br>";
       
    }
    //if the book is issued already
    
     else{
         //not exists/ exists
        $sql="SELECT i.i_id, i.borrower from issue i  where i.b_id='$b_id' and exists(select i_id from return_info r where r.i_id=i.i_id)";
        $result=$conn->query($sql);

        if($result->num_rows!=0){
            $row=$result->fetch_assoc();
            
            $borrower=$row['borrower'];
            $sql="SELECT username FROM user WHERE u_id='$borrower'";

            $result2=$conn->query($sql);
            $b=$result2->fetch_assoc();


            echo "the book is issued to ".$b['username']."<br>";
        
            //get i_id for return_info 
            $_SESSION['i_id']=$row['i_id'];
            echo("<form action='issue_return.php' method='post' ><input type='submit'  value='returned' name='returned'></form>");
        }


        else {
            echo "the book is available for issuing<br>";
            echo "enter the name of the user: <br>";
            echo '<form action="issue_return.php" method="post">';
            echo 'username: <input type="text" name="name"><br>';
            echo '<input type="submit" value="issue" name="issue"><br>';
            echo '</form>';
            
        




        /*
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
        */
     }


  }
}



?>

</body>
</html>
