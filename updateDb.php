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

  <header class="w3-container w3-theme w3-padding" id="myHeader">
    <div class="w3-center">
    <h4>LIBRARY WITHOUT SOMETHING</h4>
    <h1 class="w3-xxxlarge w3-animate-bottom">Library De-Central</h1>
      <div class="w3-padding-32">
        <a href="userHome.php" class="w3-btn w3-xlarge w3-dark-grey w3-hover-light-grey" onclick="document.getElementById('id01').style.display='block'" style="font-weight:900;">Your Library</a>
      </div>
    </div>
  </header>

<?php session_start()?>
<h1> update the db </h1>

<h3> please give info the way it is written on the book</h3>



  <form class="w3-container w3-card-4" style = "padding-bottom: 20px" method="post" action="update_db.php">
    <h2>Update your database</h2>
    <div class="w3-section">
      <input class="w3-input" type="text" name="title" required>
      <label>Title</label>
    </div>
    <div class="w3-section">
      <input class="w3-input" type="text" name="author" required>
      <label>Author</label>
    </div>
    <div class="w3-section">
      <input class="w3-input" type="text" name="category">
      <label>Category</label>
    </div>
    <div class="w3-section">
      <input class="w3-input" type="text" name="isbn">
      <label>isbn</label>
    </div>
   

     <input type="submit" class="w3-button w3-black" value="Submit">
  </form>

</body>
</html