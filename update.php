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
				<?php if (!isset($_SESSION['username'])) : ?>
					<li><a href="post.php"><span class="glyphicon glyphicon-upload"></span> Post </a></li>
					<li><a href="register.php" ><span class="glyphicon glyphicon-plus"></span> Sign Up </a></li>
					<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log in </a></li>
				<?php endif ?>
				<?php if(isset($_SESSION['username'])) :?>
					<li><a href="profile.php"><span class="glyphicon glyphicon-user"> </span> Welcome <?php echo $_SESSION['username']; ?></a></li>
					<li><a href="manage.php"><span class="glyphicon glyphicon-th"></span> Manage </a></li>
					<li><a href="post.php"><span class="glyphicon glyphicon-upload"></span> Post </a></li>
					<li><a href="index.php?logout='1'" ><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
				<?php endif ?>
			</ul>
		</div>
	</div>
</nav>
	<?php
	if($_GET)
		$id = $_GET['id'];	
	debug_to_console($id);
	$sql="SELECT * FROM post WHERE id ='$id'";
	$result = mysqli_query($db, $sql);
	if($row = mysqli_fetch_array($result)):
	?>

	<div class="header">
		<h2>Update</h2>
	</div>
 	<form method="post" action="update.php" enctype="multipart/form-data">
	 <?php include('errors.php'); ?>
        <input type="hidden" name='id' value="<?php echo $row['id']; ?>">
		<div class="input-group">
			<label>Title</label>
            <input type="text" name="title"  value="<?php echo $row['title'] ?>">
		</div>
        <div class="input-group">
			<label>Item name</label>
			<input type="text" name="item_name" value="<?php echo $row['item_name'] ?>">
		</div>
		
		<div class="input-group">
			<label>Description</label>
			<input type="text" name="description"  value="<?php echo $row['description'] ?>">
		</div>
		<div class="input-group">
			<label>Category</label>
			<select name="category"  style="width:390px">
                <option value=""><?php 
                    if($row['category_id'] == 1){echo 'Cars';}
                    else if($row['category_id'] == 2){ echo 'Books';} 
                    else if($row['category_id'] == 3){ echo 'Free Stuff';} 
                    else if($row['category_id'] == 4){ echo 'Electronics';}
                    else if($row['category_id'] == 5){ echo 'Home';}
                    else if($row['category_id'] == 6){ echo 'Garden';}
                    else if($row['category_id'] == 7){ echo 'Fashion';}
                    else if($row['category_id'] == 8){ echo 'Tickets';}
                    else if($row['category_id'] == 9){ echo 'Baby and Child';}
                    else if($row['category_id'] == 10){ echo 'Furniture';}
                    else if($row['category_id'] == 11){ echo 'Carpools';}
					else if($row['category_id'] == 12){ echo 'Arts';}
					else if($row['category_id'] == 13){ echo 'Clothes';	}
                    else { echo 'Others';}?></option>
				<option value="Cars">Cars</option>
                <option value="Books">Books</option>
				<option value="Free Stuff">Free Stuff</option>
				<option value="Electronics">Electronics</option>
				<option value="Home">Home</option>
				<option value="Garden">Garden</option>
				<option value="Fashion">Fashion</option>
				<option value="Tickets">Tickets</option>
				<option value="Baby and Child">Baby and Child</option>
				<option value="Furniture">Furniture</option>
				<option value="Carpool">Carpools</option>
				<option value="Arts">Arts</option>
				<option value="Clothes">Clothes</option>
				<option value="Others">Others</option>
			</select>
		</div>
		<div class="input-group">
			<label>Price</label>
			<input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>">
		</div>
		<article class="white-panel" style="width:350px;position:relative"> <img src='post/<?php echo $row['image'];?> '></article>

		<div class="input-group">
				<label>Picture</label>
				<input type="file" name="picture" accept="image/*" style="width:390px">
		<div class="input-group">
			<button type="submit" class="btn" name="update_item">Update</button>
		</div>
	</form>
    <?php endif?>
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
