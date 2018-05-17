<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Final Project Gator Sell</title>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- bootstrap css library -->
   <link rel="stylesheet" type="text/css" href="custom.css"/>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
 
</head>
<body>


<nav class="navbar navbar-inverse navbar-fixed-top navbar-header">
<div class="container-fluid">
  <div class="navbar-header navbar-left nav">
    <a href="index.php" class="navbar-brand">Gator Sell</a>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="post.php"><span class="glyphicon glyphicon-upload"></span> Post</a></li>
      <li><a href="register.php" ><span class="glyphicon glyphicon-plus"></span> Sign Up</a></li>
      <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log in</a></li>
    </ul>
  </div>
</div>
</nav>


<div class="header">
		<h2>Login</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>




  

  

<!-- <div class="footer">
    <div class="footer_contents">Copyright ©Tiankai Zhao</div>
</div> -->

</body>
</html>
