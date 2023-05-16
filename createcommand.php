<!DOCTYPE html>
<html>
<head>
	<title>Create Chatbot Command</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<h2>Create Chatbot Command</h2>
	<form method="post" action="">
		<div class="form-group">
			<label for="query">User Query:</label>
			<input type="text" class="form-control" id="query" name="query">
		</div>
		<div class="form-group">
			<label for="reply">Bot Reply:</label>
			<input type="text" class="form-control" id="reply" name="reply">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

<?php
// Check if form is submitted
if($_SERVER['REQUEST_METHOD'] == "POST") {
	// connecting to database
	$conn = mysqli_connect("localhost", "root", "", "chatbot") or die("Database Error");            // Please Change your Database connection here

	// getting user query and reply from form
	$query = mysqli_real_escape_string($conn, $_POST['query']);
	$reply = mysqli_real_escape_string($conn, $_POST['reply']);

	// insert new record into database
	$insert_query = "INSERT INTO chatbot (queries, replies) VALUES ('$query', '$reply')";
	$insert_result = mysqli_query($conn, $insert_query) or die("Error inserting record");

	// display success message
	echo '<div class="container"><div class="alert alert-success">New chatbot command added successfully!</div></div>';
}
?>

</body>
</html>
