<?php

include('server.php') ;
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		// header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		// header("location: login.php");
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

  <!-- Nav Bar -->
    <nav class="navbar navbar-inverse navbar-fixed-top navbar-header">
      <div class="container-fluid">
        <div class="navbar-header navbar-left nav">
          <a href="index.php" class="navbar-brand">Gator Sell</a>
        </div>
        
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <?php if (!isset($_SESSION['username'])) : ?>
              <li><a href="post.php"><span class="glyphicon glyphicon-plus"></span> Post </a></li>
              <li><a href="register.php" ><span class="glyphicon glyphicon-plus"></span> Sign Up </a></li>
              <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log in </a></li>
            <?php endif ?>
            <?php if(isset($_SESSION['username'])) :?>
              <li><a href="profile.php"><span class="glyphicon glyphicon-user"> </span> Welcome <?php echo $_SESSION['username']; ?></a></li>
              <li><a href="manage.php"><span class="glyphicon glyphicon-th"></span> Manage </a></li>
              <li><a href="post.php"><span class="glyphicon glyphicon-plus"></span> Post </a></li>
              <li><a href="index.php?logout='1'" ><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </nav>
    <?php
  //     $user = $_SESSION['username'];
  //   $user_result= $db->query("SELECT * FROM users WHERE username='$user'");
  //  $user_row = $user_result->fetch_assoc();
  
  //   $user_id = $user_row["id"];

  //   // if(isset($_POST['post'])){
  //   $sql = "SELECT * FROM users WHERE user_id= $user_id";
  //   $post_result = $db->query($sql);
  //   $post_row = $post_result ->fetch_assoc();
  //   $image = $post_row['image'];
  //   debug_to_console($image);?>
  <div class=“row” >
    <div class="container-fluid col-lg-9"style="position:absolute;width:100%">
      <h1><p id="manage" style="text-align: center">Manage your post</p></h1><hr>
    <section id="pinBoot">
  <?php
  
    $db = mysqli_connect("localhost", "root", "", "finalproject");
    $user = $_SESSION['username'];
    $user_result= $db->query("SELECT * FROM users WHERE username='$user'");
    $user_row = $user_result->fetch_assoc();
  
    $user_id = $user_row["id"];
    $sql="SELECT * FROM post WHERE user_id = '$user_id' order by id desc";
    $result = mysqli_query($db, $sql);
    // debug_to_console($sql);
    // echo "<div class='row'>";
    // echo "<div class='container-fluid col-lg-9'>";
    //   echo "<h1><a id='manage'></a>Manage your post</h1>";
    //   echo "<section id='pinBoot'>";
    while($row = mysqli_fetch_array($result)):
    ?>
    <article class="white-panel" style="width:350px;text-align: center;position:absolute;"> <img src="post/<?php echo $row['image'] ?>">
              <h2>Title: <p><?php echo $row['title']?></p></h2>
             <h3>Item name: <p><?php echo $row['item_name']?></p></h3>
              <h3>Description: <p><?php echo $row['description']?></p></h3>
              <h4>Price: <p>$<?php echo $row['price']?></p></h4>
             <br>
             <a href="delete.php?id=<?php echo $row['id'];?>">Delete</a> <a href="update.php?id=<?php echo $row['id'];?>">Update</a>
             <?php $id= $row['id'];
             debug_to_console($id);?>
           </article>
      <!-- // echo "<div id='img_div' style='width=10px'>";
      //   echo "<img src='post/".$row['image']."'>";
      // echo "</div>";
      
            echo "<article class='white-panel' style='width:350px;text-align: center;position:absolute;'> <img src='post/".$row['image']." '>";
              echo "<h2>Title: <p>".$row['title']."</p></h2>";
              echo "<h3>Item name: <p>".$row['item_name']."</p></h3>";
              echo "<h3>Description: <p>".$row['description']."</p></h3>";
              echo "<h4>Price: <p>$".$row['price']."</p></h4>";
              echo "<br>";
              echo "<a href='delete.php?id= ".$row['id']."'>Delete</a> <a href='update.php?id= ".$row['id']."'>Update</a>";
            echo "</article>";
         
          
       
    }
    // echo "</section>";
    // echo "</div>";
    // echo "</div>"; -->
  <?php endwhile?>
  </section>
  </div>
  </div>
  <script type="text/javascript" src="main.js"></script>
  <?php 
	// function 
	// 	debug_to_console( $data ) {
	// 	$output = $data;
	// 	if ( is_array( $output ) )
	// 		$output = implode( ',', $output);
	
	// 	echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	// 	}
	// ?>

</body>
</html>