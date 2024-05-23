<?php
// Connection details
include('databaseconnection.php');
// Check if preference_id is set
if(isset($_REQUEST['Preference_id'])) {
    $pid = $_REQUEST['Preference_id'];
    
    $stmt = $connection->prepare("SELECT * FROM userpreference WHERE Preference_id=?");
    $stmt->bind_param("i", $pid); // Use "i" for integer parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['Theme']; // corrected variable name
        $z = $row['FontSize']; // corrected variable name
        $k = $row['NotificationSetting']; // corrected variable name
        $w = $row['User_id']; 
        $x = $row['Language_id'];// corrected variable name
    } else {
        echo "userpreference not found.";
    }
}
?>

<html>
<head>
    <title>Update Userpreference</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();"> <!-- Call confirmUpdate() function when form is submitted -->
        <label for="pid">Preference Id:</label>
        <input type="number" name="pid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="theme">Theme:</label>
        <input type="text" name="theme" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="fontsize">Font Size:</label>
        <input type="text" name="fontsize" value="<?php echo isset($k) ? $k : ''; ?>">
        <br><br>

        <label for="nsetting">Notification Setting:</label>
        <input type="text" name="nsetting" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="uid">User Id:</label>
        <input type="number" name="uid" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="lid">Language Id:</label>
        <input type="number" name="lid" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <!-- Corrected the hidden input name to match -->
        <input type="hidden" name="Preference_id" value="<?php echo isset($pid) ? $pid : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>

    <?php
    if(isset($_POST['up'])) {
        // Retrieve updated values from form
        $theme = $_POST['theme'];
        $fontsize = $_POST['fontsize'];
        $nsetting= $_POST['nsetting'];
        $uid= $_POST['uid'];
        $lid = $_POST['lid']; 
        
        // Update the userpreference in the database
        $stmt = $connection->prepare("UPDATE userpreference SET Theme=?, FontSize=?, NotificationSetting=?, User_id=?, Language_id=? WHERE Preference_id=?");
        $stmt->bind_param("sssiii", $theme, $fontsize, $nsetting, $uid, $lid, $pid); // corrected data types and parameter order
        $stmt->execute();
        
        // Redirect to userpreference.php
        header('Location: userpreference.php');
        exit(); 
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
