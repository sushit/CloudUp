<?php
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>NMIT Cloud</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../Theme/mytheme.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="../vendor/front.php">NMIT Cloud Storage Manager</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="../vendor/about.php ?>">About us</a></li>
      <li class=""><a href="../Repo/Logout.php">Logout</a></li>
      <li><a href="#">Page 2</a></li>	
      <li><a href="#">Page 3</a></li>
    </ul>
  </div>

</nav>
<div class="container-fluid">
<h1> WELCOME <?php echo $_SESSION['username']; ?></h1>
</div>
</body>
</html>
