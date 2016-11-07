<?php

	function random_num($size) 
	{
	$alpha_key = '';
	$keys = range('A', 'Z');

	for ($i = 0; $i < 2; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}

	$length = $size - 2;

	$key = '';
	$keys = range(0, 9);

	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}

	return $alpha_key . $key;
	}

		
	$db= mysqli_connect("localhost","root","","cloud");
	if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 
	if (isset($_POST['reg_btn'])) {
		session_start();
		$username= mysql_real_escape_string($_POST['username']);
		$password=mysql_real_escape_string($_POST['password']);
		$password2=mysql_real_escape_string($_POST['password2']);	
		if ($password == $password2) {
			$password=md5($password);
			$bucket= random_num(9);
			$sql= "INSERT INTO admin(username,password,bucket) VALUES ('$username','$password','$bucket')";
			mysqli_query($db, $sql);
			$_SESSION['message']="You are now logged in";
			$_SESSION['username']=$username;
			
			$sql2= "SELECT bucket from admin where username='$username'";
			$result2= mysqli_query($db,$sql2);
			while ($row=$result2->fetch_assoc()){
				$op_bucket=$row["bucket"];
			}
			$_SESSION['bucket']=$op_bucket;
			$_SESSION['stat']=1;

			header("location: ../vendor/front.php");
		}

		else {
				$_SESSION['message']="Two passwords do not match";
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Register User</title>
</head>
<body>
<div class="header">
	<h1>Register User</h1>
</div>
<form method="post" action=""><table>
	<tr>
		<td>Username:</td>
		<td><input type="text" name="username" class="textInput"></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="password" class="textInput"></td>
	</tr>
	<tr>
		<td>Password Again:</td>
		<td><input type="password" name="password2" class="textInput"></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="reg_btn" class="Register"></td>
	</tr>
</table>
</form>
</body>
</html>