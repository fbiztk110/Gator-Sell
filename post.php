<?php include('server.php') ?>
<?php 
	if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
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
					<li><a><span class="glyphicon glyphicon-user"> </span> Welcome <?php echo $_SESSION['username']; ?></a></li>
					<li><a href="manage.php"><span class="glyphicon glyphicon-th"></span> Manage </a></li>
					<li><a href="post.php"><span class="glyphicon glyphicon-upload"></span> Post </a></li>
					<li><a href="index.php?logout='1'" ><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
				<?php endif ?>
			</ul>
		</div>
	</div>
</nav>


	<div class="header">
		<h2>Post</h2>
	</div>
 <form method="post" action="post.php" enctype="multipart/form-data">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Title</label>
			<input type="text" name="title" value="<?php echo $title; ?>">
		</div>
    <div class="input-group">
			<label>Item name</label>
			<input type="text" name="item_name" value="<?php echo $item_name; ?>">
		</div>
		
		<div class="input-group">
			<label>Description</label>
			<input type="text" name="description" value="<?php echo $description; ?>">
		</div>
		<div class="input-group">
			<label>Category</label>
			<select name="category"  style="width:390px">
				<option value="">Select Category</option>
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
				<option value="Carpool">Carpool</option>
				<option value="Arts">Arts</option>
				<option value="Clothes">Clothes</option>
				<option value="Others">Others</option>
			</select>
		</div>
		<div class="input-group">
			<label>Price</label>
			<input type="number" step="0.01" name="price" value="<?php echo $price; ?>">
		</div>
		<div class="input-group">
				<label>Picture</label>
				<input type="file" name="picture" accept="image/*" style="width:390px">
		<div class="input-group">
			<button type="submit" class="btn" name="post_item">Post</button>
		</div>
	</form>
</body>
</html>
