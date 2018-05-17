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
  <!-- custom css style -- >
</head>

<body>

        <?php if (!isset($_SESSION['username'])) : ?>
        <?php endif ?>
        <?php if(isset($_SESSION['username'])) :?>
        <?php endif ?>
 
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
      <h1 style="text-align:center"><a></a>Details</h1><hr>
    <?php
        
        $db = mysqli_connect('localhost', 'root', '', 'finalproject');

        $id = $_GET['id'];
        $sql="SELECT * FROM post WHERE id = '$id'";
        $result = mysqli_query($db, $sql);
        
        if($row = mysqli_fetch_array($result)){ 
            $uid=$row['user_id'];   
            $sql2="SELECT * FROM users WHERE id='$uid'";
            $result2=mysqli_query($db,$sql2);   
            if($row2=mysqli_fetch_array($result2)){
              echo "<div class='white-panel' style='position: fixed;top:18%; width:60%;height:60%;left:20%;'>";
            echo "<div style=''>";                
                  echo "<article class='white-panel' style='position:absolute; top:5%; left: 5%;width:400px;'>";
                  echo " <img  src='post/".$row['image']." '>";
                  echo "</article>";
                  echo "</div>";
                  echo "<div style='position: absolute; top: 5%;left: 50%;'>";
                    echo "<h4><p>Title: ".$row['title']."</p></h4><hr>";

                    echo "<h3><p>$".$row['price']."</p></h3>"; 
                    echo "<h3><p>Item name: ".$row['item_name']."</p></h3>";
                    echo "<p>Description: ".$row['description']."</p>";
                    
                    echo "<h4><p>From user: ".$row2['username']."</p></h4>";
                    echo "<h4><p>Post at: ".$row['created_at']."</p></h4>";
                    echo "<h3>Contact info:  <a class='glyphicon glyphicon-envelope' href='mailto:".$row2['email']."'></h3></a>";             
            echo "</divs>";
            echo "</divs>";
            }
          }
    ?>
    </div>
    </div>


</body>
</html>
