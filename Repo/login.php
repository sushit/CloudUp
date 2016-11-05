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
		$sql="SELECT * FROM admin WHERE username='$username'";	
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
			echo $_SESSION['bucket'];
		}
			//$_SESSION['bucket']=$op_bucket;
			//echo $op_bucket;
			//header("location: ../vendor/front.php");
		}
		else 
		{
			$_SESSION['message']="Username/Password incorrect";
		}

		
	}
	
?>



<!DOCTYPE html>
<html>
<head>
	<title>Login User</title>
</head>
<body>
<div class="header">
	<h1>Login User</h1>
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
		<td></td>
		<td><input type="submit" name="log_btn" class="Register"></td>
	</tr>
</table>
</form>
</body>
</html>