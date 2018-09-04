<html>
<body>

<?php session_start() ?>
<a href="userHome.php"> your library </a>
<?php 
   // in order to prevent confirm form resubmission
    header("Cache-Control: no cache");
    session_cache_limiter("private_no_expire");
    session_start();
    //messages upon completion
    if(!empty($_SESSION['return_success']))
    {
        echo $_SESSION['return_success'];
        unset($_SESSION['return_success']);
    }
    if(!empty($_SESSION['issue_success'])){
        echo $_SESSION['issue_success'];
        unset($_SESSION['issue_success']);
    }
?>
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
    echo "book id: ".$b_id."<br>";
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
        $sql="SELECT i.i_id, i.borrower from issue i  where i.b_id='$b_id' and not exists(select i_id from return_info r where r.i_id=i.i_id)";
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
            echo("<form action='issue_return.php' method='post' ><input type='submit'  value='returned' name='return'></form>");
        }


        //or available for issuing
        else {
            echo "the book is available for issuing<br>";
            echo "enter the name of the user: <br>";
            echo '<form action="issue_return.php" method="post">';
            echo 'username: <input type="text" name="username"><br>';
            echo '<input type="submit" value="issue" name="issue"><br>';
            echo '</form>';
            
        }


  }
}



?>

</body>
</html>
