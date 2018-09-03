<?php 
    session_start();

    $conn= new mysqli("localhost", "newuser","password", "library");
    if($conn->connect_error) die("connection to db failed");

    $b_id=$_SESSION['b_id'];

    echo "aise";
    //for restoration
    if(isset($_POST['restore'])){
        $sql="UPDATE book SET is_deleted = '0' WHERE book.b_id = '$b_id' ";
        $conn->query($sql);
        unset($_SESSION[$b_id]);
        unset($_POST['restore']);
        $_SESSION['retore_success']="restored!";
    }
    else if(isset($_POST['edit'])){
        
    }
    else if(isset($_POST['delete'])){
        $sql="UPDATE book SET is_deleted = '1' WHERE book.b_id = '$b_id' ";
        $conn->query($sql);
        unset($_SESSION[$b_id]);
        unset($_POST['delete']);
        $_SESSION['delete_success']="delted!";
    }

    echo "<script> location.href='editDb.php'; </script>"; 
    exit;
?>