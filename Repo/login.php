<?php
 session_start();
	$db= mysqli_connect("localhost","root","","cloud");
	if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 
	if (isset($_POST['log_btn'])) {
		$username= mysql_real_escape_string($_POST['username']);
		$password= mysql_real_escape_string($_POST['password']);
		$mdpassword= md5($password);
		$sql="SELECT * FROM admin WHERE username='$username' AND password='$mdpassword'";
		$result= mysqli_query($db,$sql);
		if (mysqli_num_rows($result) == 1)
		{	
			$_SESSION['message'] = "You are now logged in";
			$_SESSION['username'] = $username;
			$sql3="SELECT bucket FROM admin WHERE username='$username'";
			$result3= mysqli_query($db,$sql3);
			if (mysqli_num_rows($result3) == 1)
				{
			while ($row=$result3->fetch_assoc())
			{
					$_SESSION['bucket']=$row["bucket"];
			}
		}
			//$_SESSION['bucket']=$op_bucket;
			//echo $op_bucket;
			header("location: ../vendor/front.php");
		}
		else 
		{
			$_SESSION['message']="Username/Password incorrect";
		}
		$_SESSION['stat']=0;
	}
	
?>



<!DOCTYPE html>
<html>
<head>
	<title class="title">Login User</title>
</head
<body>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css"> 
<div class="header">
<header class="w3-container w3-teal">
	<h1>Login User</h1>
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
		<td></td>
		<td><input type="submit" name="log_btn" class="Login"></td>
	</tr>
</table>
<br>
<a href="Register.php"> Not a member? Register here </a>
</form>
</div>
</body>
</html>