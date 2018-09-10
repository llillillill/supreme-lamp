<html>
<head>
  <title>Library de-central </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>

<?php session_start() ?>

<h1> your library </h1>

<!-- user's issues and returns-->
<!-- options are update db, issue, return, edit db-->
<!-- user will be shown the number of books, the number of times he issed and returned -->

<!-- update db is unfinished and needs testing -->
<h3> <a href="updateDb.php"> update db </a></h3>
<h3> <a href="editDb.php"> edit db </a></h3>
<!-- there will be a delete option in edit db -->
<h3> <a href="issueReturn.php"> issue_return </a>></h3>
<h3> <a href="edit_user.php"> edit your info </a> </h3>
<!-- Footer -->

<?php 
    echo "books available for issuing <br>";
    $conn = new mysqli("localhost","root","amarsql","library");
    //user id for the query
    $u_id=$_SESSION['u_id'];

    $sql="SELECT b_id,title,author,category,entry_time FROM book WHERE u_id='$u_id' AND is_deleted='0' AND is_issued='0'";
    $result=$conn->query($sql);
    //html code goes here for table
    echo '<div class="w3-container">';
    echo '<hr>';
    echo '<div class="w3-center">';
    echo '<h2>Books available for issuing</h2>';
    echo '</div>';
    echo '<div class="w3-responsive w3-card-4">';
    echo '<table class="w3-table w3-striped w3-bordered">';
    echo '<thead>';
    echo '<tr class="w3-theme">';
    echo '<th>Book Id</th>';
    echo '<th>Title</th>';
    echo '<th>Author</th>';
    echo '<th>Category</th>';
    echo '<th>Entry time</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while($row=$result->fetch_assoc()){
    echo '<tr class="w3-white">';
    echo '<td>'.$row["b_id"].'</td>';
    echo '<td>'.$row["title"].'</td>';
    echo '<td>'.$row["author"].'</td>';
    echo '<td>'.$row["category"].'</td>';
    echo '<td>'.$row["entry_time"].'</td>';
    echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';




    echo "issued book<br>";


    echo "recent returns<br>";


?>



