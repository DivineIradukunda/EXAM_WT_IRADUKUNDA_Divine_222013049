<?php
// Connection details
include('databaseconnection.php');

// Initialize variables to avoid undefined variable notices
$hid = $action = $actiondate = $comments = $tid = "";

// Check if History_id is set
if(isset($_REQUEST['History_id'])) {
    $hid = intval($_REQUEST['History_id']);
    
    $stmt = $connection->prepare("SELECT * FROM translationhistory WHERE History_id=?");
    $stmt->bind_param("i", $hid); // Use "i" for integer parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $action = $row['Action']; // Assign the value to the correct variable
        $actiondate = $row['Action_date']; // Assign the value to the correct variable
        $comments = $row['Comments']; // Assign the value to the correct variable
        $tid = $row['Translation_id']; 
    } else {
        echo "Translation history not found.";
    }
}
?>

<html>
<head>
    <title>Update Translation History</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();"> <!-- Call confirmUpdate() function when form is submitted -->
        <label for="hid">History Id:</label>
        <input type="number" name="hid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="action">Action:</label>
        <input type="text" name="action" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="actiondate">Action Date:</label>
        <input type="Date" name="actiondate" value="<?php echo isset($k) ? $k : ''; ?>">
        <br><br>

        <label for="comments">Comments:</label>
        <input type="text" name="comments" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="tid">Translation Id:</label>
        <input type="number" name="tid" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <!-- Corrected the hidden input name to match -->
        <input type="hidden" name="History_id" value="<?php echo isset($hid) ? $hid : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>

    <?php
    if(isset($_POST['up'])) {
        // Retrieve updated values from form
        $action = $_POST['action'];
        $actiondate = $_POST['actiondate'];
        $comments= $_POST['comments'];
        $tid= $_POST['tid'];
        
        // Update the translationhistory in the database
        $stmt = $connection->prepare("UPDATE translationhistory SET Action=?, Action_date=?, Comments=?, Translation_id=? WHERE History_id=?");
        $stmt->bind_param("sssii", $action, $actiondate, $comments, $tid, $hid); // corrected data types and parameter order
        $stmt->execute();
        
        // Redirect to translationhistory.php
        header('Location: translationhistory.php');
        exit(); 
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
