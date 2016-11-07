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
  <link rel="stylesheet" href="../Theme/mytheme.css">
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
<div>
	<h1>Upload</h1>

<form action="new.php" method="post" enctype="multipart/form-data">
	<input type="file" name="file"><br>
	<input type="submit" value="Upload">
</form>
</div>
</body>
</html>
