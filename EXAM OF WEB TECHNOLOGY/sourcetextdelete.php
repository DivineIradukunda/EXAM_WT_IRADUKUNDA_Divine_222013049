<?php
// Connection details
include('databaseconnection.php');


// Check if therapist_id is set and is not empty
if(isset($_REQUEST['SourceText_id']) && !empty($_REQUEST['SourceText_id'])) {
    // Sanitize the input to prevent SQL injection
    $sourcetid = $connection->real_escape_string($_REQUEST['SourceText_id']);
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM sourcetext WHERE SourceText_id=?");
    $stmt->bind_param("s", $sourcetid);
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
            <input type="hidden" name="SourceText_id" value="<?php echo $SourceText_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        
        header('Location:sourcetext.php');
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
    echo "SourceText_id is not set or is empty.";
}

$connection->close();
?>
