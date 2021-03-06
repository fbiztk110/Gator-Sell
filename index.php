<?php 
	session_start(); 

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
  <!-- custom css style -- >
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

 
    <div class=“row” style="padding-left:14%;">
    <div class="container-fluid col-lg-9" style="width:100%">
      <h1 style="text-align:center" ><a></a>All items</h1><hr>
      <section id="pinBoot">
        <?php
          $db = mysqli_connect("localhost", "root", "", "finalproject");
         
          $sql="SELECT * FROM post order by id desc";
          $result = mysqli_query($db, $sql);
          
          while($row = mysqli_fetch_array($result)){
              echo "<article class='white-panel' style='width:350px;text-align: center;position:absolute;'><a href='info.php?id= ".$row['id']."'> <img src='post/".$row['image']." '> </a>";
                echo "<h2><p>".$row['title']."</p></h2>";
                echo "<h4><p>$".$row['price']."</p></h4>";
              echo "</article>";  
          }    
        ?>
        </section>
      </div>
    </div>
    <div style="padding-top:10px;height:100%;position:fixed;">
    <nav class="navbar navbar-inverse sidebar" role="navigation" >
        <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand">Categories</a>  
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1" >
          <ul class="nav navbar-nav" >
            <li><a href="category.php?id=1">Car<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plane"></span></a></li>
            <li><a href="category.php?id=2">Books<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span></a></li>
            <li><a href="category.php?id=3">Free Stuff<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-gift"></span></a></li>
            <li><a href="category.php?id=4">Electronics<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-headphones"></span></a></li>
            <li><a href="category.php?id=5">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
            <li><a href="category.php?id=6">Garden<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon glyphicon-leaf"></span></a></li>
            <li><a href="category.php?id=7">Fashion<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon glyphicon-globe"></span></a></li>
            <li><a href="category.php?id=8">Tickets<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon glyphicon-bookmark"></span></a></li>
            <li><a href="category.php?id=9">Baby and Child<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-heart"></span></a></li>
            <li><a href="category.php?id=10">Furniture<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-bed"></span></a></li>
            <li><a href="category.php?id=11">Carpools<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plane"></span></a></li>
            <li><a href="category.php?id=12">Arts<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-scissors"></span></a></li>
            <li><a href="category.php?id=13">Clothes<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-education"></span></a></li>
            <li><a href="category.php?id=14">Others<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-bullhorn"></span></a></li>
          </ul>
        </div>
      </div>
    </nav> 
    </div>

<script type="text/javascript" src="main.js"></script>
</body>
</html>
