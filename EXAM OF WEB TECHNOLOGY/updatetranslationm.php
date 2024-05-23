<?php
// Connection details
include('databaseconnection.php');

// Initialize variables to avoid undefined variable notices
$mid = $targett = $lused = $sourcetid = $lid = "";

// Check if Memory_id is set
if(isset($_REQUEST['Memory_id'])) {
    $mid = intval($_REQUEST['Memory_id']);
    
    $stmt = $connection->prepare("SELECT * FROM translationmemory WHERE Memory_id=?");
    $stmt->bind_param("i", $mid); // Use "i" for integer parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $targett = $row['TargetText']; // Assign the value to the correct variable
        $lused = $row['LastUsed']; // Assign the value to the correct variable
        $sourcetid = $row['SourceText_id']; // Assign the value to the correct variable
        $lid = $row['Language_id']; 
    } else {
        echo "Translation memory not found.";
    }
}
?>

<html>
<head>
    <title>Update Translation Memory</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();"> <!-- Call confirmUpdate() function when form is submitted -->
        <label for="mid">Memory Id:</label>
        <input type="number" name="mid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="targett">Target Text:</label>
        <input type="text" name="targett" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="lused">Last used:</label>
        <input type="Date" name="lused" value="<?php echo isset($k) ? $k : ''; ?>">
        <br><br>

        <label for="sourcetid">SourceText:</label>
        <input type="number" name="sourcetid" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="lid">Language Id:</label>
        <input type="number" name="lid" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <!-- Corrected the hidden input name to match -->
        <input type="hidden" name="Memory_id" value="<?php echo isset($mid) ? $mid : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>

    <?php
    if(isset($_POST['up'])) {
        // Retrieve updated values from form
        $targett = $_POST['targett'];
        $lused = $_POST['lused'];
        $sourcetid= $_POST['sourcetid'];
        $lid= $_POST['lid'];
        
        // Update the translationmemory in the database
        $stmt = $connection->prepare("UPDATE translationmemory SET TargetText=?, LastUsed=?, SourceText_id=?, Language_id=? WHERE Memory_id=?");
        $stmt->bind_param("sssii", $targett, $lused, $sourcetid, $lid, $mid); // corrected data types and parameter order
        $stmt->execute();
        
        // Redirect to translationmemory.php
        header('Location: translationmemory.php');
        exit(); 
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
