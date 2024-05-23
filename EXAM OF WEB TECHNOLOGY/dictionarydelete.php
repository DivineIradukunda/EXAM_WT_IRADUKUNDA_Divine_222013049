<?php
// Connection details
include('databaseconnection.php');


// Check if therapist_id is set and is not empty
if(isset($_REQUEST['Word_id']) && !empty($_REQUEST['Word_id'])) {
    // Sanitize the input to prevent SQL injection
    $wid = $connection->real_escape_string($_REQUEST['Word_id']);
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM dictionary WHERE Word_id=?");
    $stmt->bind_param("s", $wid);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="Word_id" value="<?php echo $Word_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        
        header('Location:dictionary.php');
        
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
  ?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Word_id is not set or is empty.";
}

$connection->close();
?>
