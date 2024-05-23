<?php
// Connection details
include('databaseconnection.php');


// Check if therapist_id is set and is not empty
if(isset($_REQUEST['Term_id']) && !empty($_REQUEST['Term_id'])) {
    // Sanitize the input to prevent SQL injection
    $termid = $connection->real_escape_string($_REQUEST['Term_id']);
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM glossary WHERE Term_id=?");
    $stmt->bind_param("s", $termid);
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
            <input type="hidden" name="Term_id" value="<?php echo $Term_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        
        header('Location:glossary.php');
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
    echo "Term_id is not set or is empty.";
}

$connection->close();
?>
