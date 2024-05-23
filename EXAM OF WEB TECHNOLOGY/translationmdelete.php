<?php
// Connection details
include('databaseconnection.php');


// Check if therapist_id is set and is not empty
if(isset($_REQUEST['Memory_id']) && !empty($_REQUEST['Memory_id'])) {
    // Sanitize the input to prevent SQL injection
    $mid = $connection->real_escape_string($_REQUEST['Memory_id']);
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM translationmemory WHERE Memory_id=?");
    $stmt->bind_param("s", $mid);
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
            <input type="hidden" name="Memory_id" value="<?php echo $Memory_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        
        header('Location:translationmemory.php');
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
    echo "Memory_id is not set or is empty.";
}

$connection->close();
?>
