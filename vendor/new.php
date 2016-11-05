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

			unlink($temp_file_name);
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
<head>
	<title>Upload</title>
</head>
<body>
<form action="new.php" method="post" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type="submit" value="Upload">
</form>
</body>
</html>