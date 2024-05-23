<?php
// Connection details
include('databaseconnection.php');

// Check if Feedback_id is set
if (isset($_REQUEST['Feedback_id'])) {
    $fid = $_REQUEST['Feedback_id'];

    $stmt = $connection->prepare("SELECT * FROM feedback WHERE Feedback_id=?");
    $stmt->bind_param("i", $fid); // Use "i" for integer parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['Rating'];
        $z = $row['Comment'];
        $k = $row['Feedback_date'];
        $w = $row['User_id'];
        $v = $row['Translation_id'];
    } else {
        echo "Feedback not found.";
    }
}
?>

<html>
<head>
    <title>Update Feedback</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();"> <!-- Call confirmUpdate() function when form is submitted -->
        <label for="fid">Feedback Id:</label>
        <input type="number" name="fid" value="<?php echo isset($fid) ? $fid : ''; ?>" readonly>
        <br><br>

        <label for="rating">Rating:</label>
        <input type="text" name="rating" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="comment">Comment:</label>
        <input type="text" name="comment" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="feedbdate">Feedback Date:</label>
        <input type="date" name="feedbdate" value="<?php echo isset($k) ? $k : ''; ?>">
        <br><br>

        <label for="uid">User id:</label>
        <input type="number" name="uid" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="tid">Translation id:</label>
        <input type="number" name="tid" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <input type="hidden" name="Feedback_id" value="<?php echo isset($fid) ? $fid : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>

    <?php
    if (isset($_POST['up'])) {
        // Retrieve updated values from form
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
        $feedbdate = $_POST['feedbdate'];
        $uid = $_POST['uid'];
        $tid = $_POST['tid'];
        $fid = $_POST['Feedback_id']; // Retrieve Feedback_id from POST data

        // Update the command in the database
        $stmt = $connection->prepare("UPDATE feedback SET Rating=?, Comment=?, Feedback_date=?, User_id=?, Translation_id=? WHERE Feedback_id=?");
        $stmt->bind_param("sssiii", $rating, $comment, $feedbdate, $uid, $tid, $fid); // Corrected data types and parameter order
        $stmt->execute();

        // Redirect to feedback.php
        header('Location: feedback.php');
        exit();
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
