<?php
	use Aws\S3\Exception\S3Exception;
	require '..\app\start.php';
	$config = require '..\app\config.php';
	


if (isset($_FILES['file']))
{  
	$file = $_FILES['file'];
	$name = $file['name'];
	$tmp_name = $file['tmp_name']; 
	$extension = explode('.',$name);
	$extension = strtolower(end($extension));

	$key = md5(uniqid());
	$temp_file_name = "{$key}.{$extension}";
	$temp_file_path = "../files/{$temp_file_name}";
	move_uploaded_file($tmp_name, $temp_file_path);
	try
	{
			$s3->putObject([
			'Bucket' => $config['s3']['bucket'],
			'Key' => "uploads/{$name}",
			'Body' => fopen($temp_file_path, 'rb'),  //rb - reading 
			'ACL' => 'public-read'  //access control ob_get_level(oid)
			]);

			@unlink($temp_file_name);
	}
	catch(S3Exception $e)
	{
		echo $e->getMessage();
	}
	header("location: ../vendor/listobjects.php");
}	

?>

<!DOCTYPE html>
<link href="../bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen">
<html>

</body>
</html>


<?php
@session_start();
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>NMIT Cloud</title>
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
      <li class=""><a href="../Repo/Logout.php">Logout</a></li>
    </ul>
  </div>

</nav>
<body>
<style type="text/css">
	.button {
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    font-size: 20px;
}

.button:hover {
    background-color: green;
    color: white;
}
</style>
<div>
	<h1 style="margin-left: 150px;">Upload File </h1>
	<br>
	<br>

<form action="new.php" method="post" enctype="multipart/form-data">
	<input type="file" name="file" style="padding-left: 250px;"><br>
	<hr style="  display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;">
	<input type="submit" class="button" style="margin-left: 250px;" value="Upload">
</form>
</div>
</body>
</html>
