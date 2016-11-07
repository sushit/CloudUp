<?php
@session_start();
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cloud Storage Console</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-3.3.7/dist/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="../vendor/front.php">Cloud Storage Console</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="../vendor/about.php ?>">About us</a></li>
      <li><a href="../vendor/new.php">Manage Storage</a></li>	
      <li><a href="../vendor/listobjects.php">See all your files here</a></li>
      <li><a href="../Repo/Logout.php">Logout</a></li>
    </ul>
  </div>

</nav>
<div class="container-fluid">
<h3>WELCOME <?php echo $_SESSION['username']; ?> </h3>
</div>
</body>
</html>
