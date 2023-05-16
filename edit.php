<?php
// connecting to database
$conn = mysqli_connect("localhost", "root", "", "chatbot") or die("Database Error");

// retrieve the command details from the database based on the id parameter
$id = mysqli_real_escape_string($conn, $_GET['id']);
$command_query = "SELECT * FROM chatbot WHERE id = '$id'";
$run_query = mysqli_query($conn, $command_query) or die("Error");
$command = mysqli_fetch_assoc($run_query);

// handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // retrieve the updated command and reply from the form
    $updated_command = mysqli_real_escape_string($conn, $_POST['command']);
    $updated_reply = mysqli_real_escape_string($conn, $_POST['reply']);

    // update the command in the database
    $update_query = "UPDATE chatbot SET queries = '$updated_command', replies = '$updated_reply' WHERE id = '$id'";
    mysqli_query($conn, $update_query) or die("Error");

    // redirect to view commands page
    header("Location: view_commands.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Command</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
	<div class="container mt-5">
		<h2>Edit Command</h2>
		<form method="post">
			<div class="form-group">
				<label for="command">Command:</label>
				<input type="text" class="form-control" id="command" name="command" value="<?php echo $command['queries']; ?>" required>
			</div>
			<div class="form-group">
				<label for="reply">Reply:</label>
				<textarea class="form-control" id="reply" name="reply" rows="5" required><?php echo $command['replies']; ?></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Update Command</button>
		</form>
	</div>
</body>
</html>
