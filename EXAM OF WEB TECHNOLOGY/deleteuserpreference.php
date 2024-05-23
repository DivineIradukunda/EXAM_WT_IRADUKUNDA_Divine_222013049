<?php
// Connection details
include('databaseconnection.php');


// Check if therapist_id is set and is not empty
if(isset($_REQUEST['Preference_id']) && !empty($_REQUEST['Preference_id'])) {
    // Sanitize the input to prevent SQL injection
    $pid = $connection->real_escape_string($_REQUEST['Preference_id']);
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM userpreference WHERE Preference_id=?");
    $stmt->bind_param("s", $pid);
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
            <input type="hidden" name="Preference_id" value="<?php echo $Preference_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        
        header('Location:userpreference.php');
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
    echo "Preference_id is not set or is empty.";
}

$connection->close();
?>
