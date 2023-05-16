<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chatbot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the delete button is clicked, delete the command from the database
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $delete_query = "DELETE FROM chatbot WHERE id=?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// If the edit button is clicked, redirect to the edit page with the command ID as a parameter
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    header("Location: edit_command.php?id=$id");
    exit();
}

// Get all commands from the database
$commands_query = "SELECT * FROM chatbot";
$commands_result = $conn->query($commands_query);

?>

<!-- Display commands in a table with delete and edit buttons -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Query</th>
            <th>Reply</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($command = $commands_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $command['id']; ?></td>
            <td><?php echo $command['queries']; ?></td>
            <td><?php echo $command['replies']; ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $command['id']; ?>">
                    <button type="submit" name="delete">Delete</button>
                    <button type="submit" name="edit">Edit</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
// Close the database connection
$conn->close();
?>
