<?php 
	session_start();

    // variable declaration
	$first_name = $last_name = $username = $email = $password = "";
	$item_name = $title = $description = $price = $category ="";
	$errors = array(); 
	$msg= "";
	$_SESSION['success'] = "";
	

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'finalproject');

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
        // receive all input values from the form
        $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
		$_SESSION['username'] = $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$target = "images/".basename($_FILES['picture']['name']);
		$picture = $_FILES['picture']['name'];
		// $image = file_get_contents($_FILES['picture']['tmp_name']);
		debug_to_console($picture);

        // form validation: ensure that the form is correctly filled
        if(empty($first_name)) { array_push($errors, "First Name is required");}
        if(empty($last_name)) { array_push($errors, "Last Name is required");}
		if(empty($username)) { array_push($errors, "Username is required"); }
		if(empty($email)) { array_push($errors, "Email is required"); }
		if(empty($password)) { array_push($errors, "Password is required"); }
		if(empty($picture)){ array_push($errors, "Picture is required");}
		// register user if there are no errors in the form
		if(count($errors) == 0) {

			$query = "INSERT INTO users (first_name, last_name, email, username, password, picture, created_at) 
					  VALUES('$first_name', '$last_name', '$email', '$username', '$password', '$picture', NOW())";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now signed up";
			header('location: index.php');
		}
		if(move_uploaded_file($_FILES['picture']['tmp_name'], $target)){
			$_SESSION['pic'] = "Your picture is uploaded";
		}
		else{
			
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	// POST ITEM
	if(isset($_POST['post_item'])){
		$title = mysqli_real_escape_string($db, $_POST['title']);
        $item_name = mysqli_real_escape_string($db, $_POST['item_name']);
		$description = mysqli_real_escape_string($db, $_POST['description']);
		$price = mysqli_real_escape_string($db, $_POST['price']);
		$category = mysqli_real_escape_string($db, $_POST['category']);
		// $picture =mysqli_real_escape_string($db,$_POST['picture']);
		// debug_to_console($picture);
		$user = $_SESSION['username'];
		$tar = "post/".basename($_FILES['picture']['name']);
		$picture = $_FILES['picture']['name'];

        // form validation: ensure that the form is correctly filled
        if(empty($title)) { array_push($errors, "Title is required");}
        if(empty($item_name)) { array_push($errors, "Item name is required");}
		if (empty($description)) { array_push($errors, "Description is required"); }
		if (empty($price)) { array_push($errors, "Price is required"); }
		if($category==""){ array_push($errors, "Category is required");}
		else if($category=="Cars"){ $category = '1';}
		else if($category=="Books"){ $category = '2';}
		else if($category == "Free Stuff"){$category = '3';}
		else if($category == "Electronics"){$category = '4';}
		else if($category == "Home"){$category = '5';}
		else if($category == "Garden"){$category = '6';}
		else if($category == "Fashion"){$category = '7';}
		else if($category == "Tickets"){$category = '8';}
		else if($category == "Baby and Child"){$category = '9';}
		else if($category == "Furniture"){$category = '10';}
		else if($category == "Carpool"){$category = '11';}
		else if($category == "Arts"){$category = '12';}
		else if($category == "Clothes"){$category = '13';}
		else{$category = '14';}
		if (empty($price)) { array_push($errors, "Price is required"); }
		if (empty($picture)) { array_push($errors, "Picture is required");}
		if($price < 0){ array_push($errors, "Price only allow positive number");}
		
		if (count($errors) == 0) {  
			
			
			$query = "INSERT INTO post (title, item_name, description, price, user_id, category_id, image, created_at) 
			VALUES('$title', '$item_name', '$description', '$price', (SELECT id FROM users WHERE username='$user'), '$category', '$picture', NOW())";
			// mysqli_query($db, $query);
			debug_to_console( mysqli_query($db, $query));
			// $id = "SELECT id FROM users WHERE username='$user'";
			
			// $query2 = "INSERT INTO picture (post_id, picture)
			// VALUE((SELECT id FROM post WHERE user_id=(SELECT id FROM users WHERE username='$user') order by created_at DESC limit 1),'$picture')";

			// debug_to_console(mysqli_query($db,$query2));
			header('location: manage.php');
		}
		if(move_uploaded_file($_FILES['picture']['tmp_name'], $tar)){
			$_SESSION['pic'] = "Your picture is uploaded";
		}
		else{
			array_push( $errors, "Picture is not uploaded");
		}

	}
	// Update Item
	if(isset($_POST['update_item'])){
		$title = mysqli_real_escape_string($db, $_POST['title']);
        $item_name = mysqli_real_escape_string($db, $_POST['item_name']);
		$description = mysqli_real_escape_string($db, $_POST['description']);
		$price = mysqli_real_escape_string($db, $_POST['price']);
		$category = mysqli_real_escape_string($db, $_POST['category']);
		$user = $_SESSION['username'];
		$tar = "post/".basename($_FILES['picture']['name']);
		$picture = $_FILES['picture']['name'];
		$id = $_POST['id'];
		debug_to_console($id);
        // form validation: ensure that the form is correctly filled
        if(empty($title)) { array_push($errors, "Title is required");}
        if(empty($item_name)) { array_push($errors, "Item name is required");}
		if (empty($description)) { array_push($errors, "Description is required"); }
		if (empty($price)) { array_push($errors, "Price is required"); }
		if($category==""){ array_push($errors, "Category is required");}
		else if($category=="Cars"){ $category = '1';}
		else if($category=="Books"){ $category ='2';}
		else if($category == "Free Stuff"){$category = '3';}
		else if($category == "Electronics"){$category = '4';}
		else if($category == "Home"){$category = '5';}
		else if($category == "Garden"){$category = '6';}
		else if($category == "Fashion"){$category = '7';}
		else if($category == "Tickets"){$category = '8';}
		else if($category == "Baby and Child"){$category = '9';}
		else if($category == "Furniture"){$category = '10';}
		else if($category == "Carpools"){$category = '11';}
		else if($category == "Arts"){$category = '12';}
		else if($category == "Clothes"){$category = '13';}
		else{$category = '14';}
		if (empty($price)) { array_push($errors, "Price is required"); }
		if (empty($picture)) { array_push($errors, "Picture is required");}
		if($price < 0){ array_push($errors, "Price only allow positive number");}
		if (count($errors) == 0) { 
			$query = "UPDATE post SET title='$title', item_name='$item_name', description='$description', price='$price', category_id='$category', image='$picture' WHERE id='$id'";
			debug_to_console( mysqli_query($db, $query));
			header('location:manage.php');
		}
		if(move_uploaded_file($_FILES['picture']['tmp_name'], $tar)){
			$_SESSION['pic'] = "Your picture is uploaded";
		}
		else{
			// array_push( $errors, "Picture is not uploaded");
		}

	}

	//Update profile

	if(isset($_POST['update_profile'])){
		$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$tag = "images/".basename($_FILES['picture']['name']);
		$picture = $_FILES['picture']['name'];
				

		// $tar = "images/".basename($_FILES['picture']['name']);
		// $picture = $_FILES['picture']['name'];
		$user = $_SESSION['username'];

		// form validation: ensure that the form is correctly filled
		if(empty($first_name)) { array_push($errors, "First Name is required");}
		if(empty($last_name)) { array_push($errors, "Last Name is required");}
		if(empty($username)) { array_push($errors, "Username is required"); }
		if(empty($email)) { array_push($errors, "Email is required"); }
		if(empty($password)) { array_push($errors, "Password is required"); }
		if(empty($picture)){ array_push($errors, "Picture is required");}
		// Update user if there are no errors in the form
		if(count($errors) == 0) {
			
			$query = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', username='$username', password='$password', picture='$picture' WHERE username='$user'"; 
			debug_to_console(mysqli_query($db, $query));

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You profile is updated";
			header('location: profile.php');
		}
		if(move_uploaded_file($_FILES['picture']['tmp_name'], $tag)){
			$_SESSION['pic'] = "Your picture is uploaded";
		}
		else{
			// array_push( $errors, "Picture is not uploaded");
		}
	}
	function debug_to_console( $data ) {
		$output = $data;
		if ( is_array( $output ) )
			$output = implode( ',', $output);
	
		echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	}
?>