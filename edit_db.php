<?php 
    session_start();

    $conn= new mysqli("localhost", "newuser","password", "library");
    if($conn->connect_error) die("connection to db failed");

    $b_id=$_SESSION['b_id'];

    echo "aise";
    if(isset($_POST['restore'])){
        $sql="UPDATE book SET is_deleted = '0' WHERE book.b_id = '$b_id' ";
        $conn->query($sql);
        unset($_SESSION[$b_id]);
        unset($_POST['restore']);
        $_SESSION['retore_success']="restored!";
    }
    else if(isset($_POST['edit'])){
        $sql="UPDATE book SET is_deleted = '0' WHERE book.b_id = '$b_id' ";
        $conn->query($sql);
        echo "restored!";
        unset($_SESSION[$b_id]);
        unset($_POST['restore']);
        $_SESSION['retore_success']="restored!";
        echo "<script> location.href='editDb.php'; </script>"; 
        exit;
    }
    else if(isset($_POST['delete'])){
        $sql="UPDATE book SET is_deleted = '1' WHERE book.b_id = '$b_id' ";
        $conn->query($sql);
        unset($_SESSION[$b_id]);
        unset($_POST['delete_success']);
        $_SESSION['delete_success']="delted!";
    }

    echo "<script> location.href='editDb.php'; </script>"; 
    exit;
?>