<?php
// Connection details
include('databaseconnection.php');

// Check if Translation_id is set
if(isset($_REQUEST['Translation_id'])) {
    $tid = $_REQUEST['Translation_id'];
    
    $stmt = $connection->prepare("SELECT * FROM translation WHERE Translation_id=?");
    $stmt->bind_param("i", $tid); // Use "i" for integer parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tdate = $row['tdate']; // Corrected variable name
        $ttext = $row['ttext']; // Corrected variable name
        $sourcetid = $row['sourcetid']; // Corrected variable name
        $lid = $row['lid']; // Corrected variable name
        
    } else {
        echo "translation not found.";
    }
}
?>

<html>
<head>
    <title>Update Translation</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();"> <!-- Call confirmUpdate() function when form is submitted -->
        <label for="tid">Translation Id:</label>
        <input type="number" name="tid" value="<?php echo isset($tid) ? $tid : ''; ?>" readonly>
        <br><br>

        <label for="tdate">Translated Date:</label>
        <input type="Date" name="tdate" value="<?php echo isset($tdate) ? $tdate: ''; ?>">
        <br><br>

        <label for="ttext">Translated Text:</label>
        <input type="text" name="ttext" value="<?php echo isset($ttext) ? $ttext : ''; ?>">
        <br><br>

        <label for="sourcetid">SourceText:</label>
        <input type="number" name="sourcetid" value="<?php echo isset($sourcetid) ? $sourcetid : ''; ?>">
        <br><br>

        <label for="lid">Language id:</label>
        <input type="number" name="lid" value="<?php echo isset($languageId) ? $languageId : ''; ?>">
        <br><br>

        <input type="hidden" name="Translation_id" value="<?php echo isset($tid) ? $tid : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>

    <?php
    if(isset($_POST['up'])) {
        // Retrieve updated values from form
        $tdate = $_POST['word'];
        $ttext = $_POST['def'];
        $sourcetid = $_POST['sourcetid'];
        $lid = $_POST['lid']; 
        $tid = $_POST['Translation_id']; // Retrieve Translation_id from POST data
        
        // Update the translation in the database
        $stmt = $connection->prepare("UPDATE translation SET Translated_date=?, TranslatedText=?, SourceText_id=?, Language_id=? WHERE Translated_id=?");
        $stmt->bind_param("sssii", $tdate, $ttext, $sourcetid, $lid, $tid); // Corrected data types and parameter order
        $stmt->execute();
        
        // Redirect to translation.php
        header('Location: translation.php');
        exit(); 
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
