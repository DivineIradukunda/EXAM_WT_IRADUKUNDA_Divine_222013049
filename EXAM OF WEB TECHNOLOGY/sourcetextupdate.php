<?php
// Connection details
include('databaseconnection.php');

// Check if SourceText_id is set
if(isset($_REQUEST['SourceText_id'])) {
    $sourcetid = $_REQUEST['SourceText_id'];
    
    $stmt = $connection->prepare("SELECT * FROM sourcetext WHERE SourceText_id=?");
    $stmt->bind_param("i", $sourcetid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['SourceText_id'];
        $b = $row['Text'];
        $c = $row['Author'];
        $d = $row['Creation_date'];
        $e = $row['LastModifiedDate'];
        $f = $row['Category'];
        $g = $row['Status'];
    } else {
        echo "sourcetext not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="sourcetid">SourceText id:</label>
        <input type="number" name="sourcetid" value="<?php echo isset($a) ? $a : ''; ?>" readonly>
        <br><br>
        <label for="text">Text:</label>
        <input type="text" name="text" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="author">Author:</label>
        <input type="text" name="author" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="creadate">Creation Date:</label>
        <input type="Date" name="creadate" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="lmdate">LastModified Date:</label>
        <input type="Date" name="lmdate" value="<?php echo isset($e) ? $e : ''; ?>">
         <br><br>
          <label for="category">Category:</label>
        <input type="text" name="category" value="<?php echo isset($e) ? $e : ''; ?>">
         <br><br>
          <label for="status">Status:</label>
        <input type="text" name="status" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $sourcetid = $_POST['sourcetid'];
    $text = $_POST['text'];
    $author = $_POST['author'];
    $creadate = $_POST['creadate'];
    $lmdate= $_POST['lmdate'];
    $category= $_POST['category'];
    $status= $_POST['status'];
    
    // Update the sourcetext in the database
    $stmt = $connection->prepare("UPDATE sourcetext SET Text=?, Author=?, Creation_date=?, LastModifiedDate=? , Category=?, Status=? WHERE SourceText_id=?");
    $stmt->bind_param("ssssssi", $text, $author, $creadate, $lmdate, $category, $status, $sourcetid);
    $stmt->execute();
    
    // Redirect to sourcetext.php
    header('Location: sourcetext.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>
