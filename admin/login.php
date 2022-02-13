<!DOCTYPE html>
<?php include('../config/constants.php')  ?>
<html>
<head>
	<title>Login Page For Food Order System</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
	<div class="login">
		<h1 class="text-center">Login</h1><br><br>

		<?php 
		if (isset($_SESSION['login']))
		 {
			echo $_SESSION['login'];
			unset($_SESSION['login']);
		}

		if (isset($_SESSION['no-login-message'])) 
		{
			echo $_SESSION['no-login-message'];
			unset($_SESSION['no-login-message']);
		}
		 ?>
		<!-- login form starts here -->
		<form action="" method="POST" class="text-center">
			Username:<br>
			<input type="text" name="username" placeholder="Enter username"><br><br>
			Password:<br>
			<input type="password" name="password" placeholder="Enter password"><br><br>
			<input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
		</form>
		<!-- end of login form -->
		<p class="text-center">Created By <a href="#">AAA</a></p>
	</div>

</body>
</html>

<?php 
// check whether submit button is clicked or not//
if (isset($_POST['submit']))
 {
	//process for login//
	// get the data from login form
	 $username=mysqli_real_escape_string($conn,$_POST['username']);
	 $rawpassword=md5($_POST['password']);
	 $password=mysqli_real_escape_string($conn,$rawpassword);


	// sql query tto check whether the username and password exist or not

	$sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
	// execute the query

	$res=mysqli_query($conn,$sql);

	// count rows to check whether the user exist or not

	$count=mysqli_num_rows($res);
	if ($count==1) 
	{
		# User Available and Login Success
		$_SESSION['login']= "<div class='success text-center'>Login Successful.</div>";

		$_SESSION['user'] = $username; //to check whether the user s logged in or not and logout will unset it

		// redirect to admin home Page
		header('location:'.SITEURL.'admin/');


	}

	else
	{
		// user not available and Login Fail

		$_SESSION['login']= "<div class='error text-center'> Login Failed.</div>";
		header('location:'.SITEURL.'admin/login.php');
	}
}
 ?>