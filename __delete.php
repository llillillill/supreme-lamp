<?php 
    session_start();
    
    $conn= new mysqli("localhost", "root","amarsql", "library");
    if($conn->connect_error) die("connection to db failed");

    echo "aise";
    if(isset($_POST['restore'])){
        echo "heneo aise";
        $b_id=$_SESSION['b_id'];
        echo $b_id."<br>";
        $sql="UPDATE book SET is_deleted = '0' WHERE book.b_id = '$b_id' ";
        $conn->query($sql);
        echo "restored!";
        unset($_SESSION[$b_id]);
        unset($_POST['restore']);
        $_SESSION['retore_success']="restored!";
        echo "<script> location.href='editDb.php'; </script>"; 
        exit;

    }
?>