<?php

	function random_num($size) 
	{
	$alpha_key = '';
	$keys = range('a', 'z');

	for ($i = 0; $i < 11; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}
	return $alpha_key;
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
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css"> 
<body>
<div class="header">
<header class="w3-container w3-teal">
	<h1>Register User</h1>
	</header>
</div>
<div class="w3-container w3-half w3-margin-top">
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
<br>
<a href="login.php"> Already a member? Login here </a>
</form>
</body>
</html>