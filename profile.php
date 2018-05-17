<?php 
	require_once('server.php');

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		// header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: index.php");
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Final Project Gator Sell</title>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- bootstrap css library -->
  <link rel="stylesheet" type="text/css" href="custom.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <!-- <div class="navbar navbar-fixed-top">
    <div class="navbar-header navbar-left">
      <a href="index.php" class="navbar-brand">Gator Sell</a>
    </div>
    <div class="navbar-right">
        <?php if (!isset($_SESSION['username'])) : ?>
          <a href="post.php"><span class="glyphicon glyphicon-upload"></span> Post</a>
          <a href="register.php" ><span class="glyphicon glyphicon-plus"></span> Sign Up</a>
          <a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log in</a>
        <?php endif ?>
        <?php if(isset($_SESSION['username'])) :?>
          <div class="dropdown">
              <button class="dropbtn">Welcome <span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['username'];?>
              <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-content">
                <a href="update.php">Update profile</a>
                <a href="manage.php">Manage item</a>
              </div>
          </div>
          <a href="post.php"><span class="glyphicon glyphicon-upload"></span> Post</a>
          <a href="index.php?logout='1'" ><span class="glyphicon glyphicon-log-out"></span> Log Out</a>
        <?php endif ?>
    </div>
  </div> -->
  <!-- Nav Bar -->
    <nav class="navbar navbar-inverse navbar-fixed-top navbar-header">
      <div class="container-fluid">
        <div class="navbar-header navbar-left nav">
          <a href="index.php" class="navbar-brand">Gator Sell</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <?php if (!isset($_SESSION['username'])) : ?>
              <li><a href="post.php"><span class="glyphicon glyphicon-upload"></span> Post</a></li>
              <li><a href="register.php" ><span class="glyphicon glyphicon-plus"></span> Sign Up</a></li>
              <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log in</a></li>
            <?php endif ?>
            <?php if(isset($_SESSION['username'])) :?>
              <li><a href="profile.php"><span class="glyphicon glyphicon-user"> </span> Welcome <?php echo $_SESSION['username']; ?></a></li>
              <li><a href="manage.php"><span class="glyphicon glyphicon-th"></span> Manage</a></li>
              <li><a href="post.php"><span class="glyphicon glyphicon-upload"></span> Post </a></li>
              <li><a href="index.php?logout='1'" ><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </nav> 

    <div class=“row”>
    <div class="container-fluid col-lg-9" style="position:absolute;width:100%;">
    <?php
        
      $db = mysqli_connect('localhost', 'root', '', 'finalproject');
      $username = $_SESSION['username'];
      $sql="SELECT * FROM users WHERE username = '$username'";
      $result = mysqli_query($db, $sql);
      
      // echo "<div class='row'>";
      // echo "<div class='container-fluid col-lg-9'>";
      // echo "<h1><a id='manage'></a>Details</h1>";
      if($row = mysqli_fetch_array($result)):
    ?>

        <div class="header">
          <h2>Profile</h2>
        </div>

        <form method="post" action="profile.php" enctype="multipart/form-data">
        <?php include('errors.php'); ?>
              
          <!-- <input type="hidden" name="id" value="<?php echo $row['id']; ?>"> -->
          <div class="input-group">
                <label>First name</label>
                <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>">
          </div>
          <div class="input-group">
                <label>Last name</label>
                <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>">
          </div>
          <div class="input-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $row['email']; ?>">
          </div>
          <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $row['username']; ?>">
          </div>
          <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" value="<?php echo $row['password']; ?>">
          </div>
          <article class="white-panel" style="width:350px;position:relative"> <img src="images/<?php echo $row['picture'];?> "></article>
          <!-- <img style="width:50%; position:relative; left:100px;" src='images/'> -->
          <div class="picture"style="width:54%">
                <label>Change profile picture</label>
                <input style="width:390px" type="file" name="picture" accept="image/*" >
          </div>
          <div class="input-group">
                <button type="submit" class="btn" name="update_profile">Update</button>
          </div>
          </form>          
    <?php endif ?>
    </div>
    </div>


</body>
</html>
