<?php
// Connection details
include('databaseconnection.php');

// Check if Term_id is set
if (isset($_REQUEST['Term_id'])) {
    $termid = $_REQUEST['Term_id'];

    $stmt = $connection->prepare("SELECT * FROM glossary WHERE Term_id=?");
    $stmt->bind_param("i", $termid); // Use "i" for integer parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['Term'];
        $z = $row['Definition'];
        $k = $row['CreatedDate'];
        $w = $row['Language_id'];
    } else {
        echo "Glossary term not found.";
    }
}
?>

<html>
<head>
    <title>Update Glossary</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();"> <!-- Call confirmUpdate() function when form is submitted -->
        <label for="termid">Term Id:</label>
        <input type="number" name="termid" value="<?php echo isset($termid) ? $termid : ''; ?>" readonly>
        <br><br>

        <label for="term">Term:</label>
        <input type="text" name="term" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="def">Definition:</label>
        <input type="text" name="def" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="createddate">Created Date:</label>
        <input type="date" name="createddate" value="<?php echo isset($k) ? $k : ''; ?>">
        <br><br>

        <label for="lid">Language id:</label>
        <input type="number" name="lid" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="hidden" name="Term_id" value="<?php echo isset($termid) ? $termid : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>

    <?php
    if (isset($_POST['up'])) {
        // Retrieve updated values from form
        $term = $_POST['term'];
        $def = $_POST['def'];
        $createddate = $_POST['createddate'];
        $lid = $_POST['lid'];
        $termid = $_POST['termid']; // Retrieve Term_id from hidden input

        // Update the command in the database
        $stmt = $connection->prepare("UPDATE glossary SET Term=?, Definition=?, CreatedDate=?, Language_id=? WHERE Term_id=?");
        $stmt->bind_param("sssii", $term, $def, $createddate, $lid, $termid); // Corrected data types and parameter order
        $stmt->execute();

        // Redirect to glossary.php
        header('Location: glossary.php');
        exit();
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
