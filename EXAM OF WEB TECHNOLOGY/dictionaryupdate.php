<?php
// Connection details
include('databaseconnection.php');

// Check if Word_id is set
if(isset($_REQUEST['Word_id'])) {
    $wid = $_REQUEST['Word_id'];
    
    $stmt = $connection->prepare("SELECT * FROM dictionary WHERE Word_id=?");
    $stmt->bind_param("i", $wid); // Use "i" for integer parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $word = $row['word']; // Corrected variable name
        $definition = $row['Definition']; // Corrected variable name
        $exampleSentence = $row['ExampleSetence']; // Corrected variable name
        $languageId = $row['Language_id']; // Corrected variable name
        
    } else {
        echo "Dictionary entry not found.";
    }
}
?>

<html>
<head>
    <title>Update Dictionary</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();"> <!-- Call confirmUpdate() function when form is submitted -->
        <label for="wid">Word Id:</label>
        <input type="number" name="wid" value="<?php echo isset($wid) ? $wid : ''; ?>" readonly>
        <br><br>

        <label for="word">Word:</label>
        <input type="text" name="word" value="<?php echo isset($word) ? $word : ''; ?>">
        <br><br>

        <label for="def">Definition:</label>
        <input type="text" name="def" value="<?php echo isset($definition) ? $definition : ''; ?>">
        <br><br>

        <label for="examplesentence">Example Sentence:</label>
        <input type="text" name="examplesentence" value="<?php echo isset($exampleSentence) ? $exampleSentence : ''; ?>">
        <br><br>

        <label for="lid">Language id:</label>
        <input type="number" name="lid" value="<?php echo isset($languageId) ? $languageId : ''; ?>">
        <br><br>

        <input type="hidden" name="Word_id" value="<?php echo isset($wid) ? $wid : ''; ?>">
        
        <input type="submit" name="up" value="Update">
    </form>

    <?php
    if(isset($_POST['up'])) {
        // Retrieve updated values from form
        $word = $_POST['word'];
        $def = $_POST['def'];
        $exampleSentence = $_POST['examplesentence'];
        $lid = $_POST['lid']; 
        $wid = $_POST['Word_id']; // Retrieve Word_id from POST data
        
        // Update the command in the database
        $stmt = $connection->prepare("UPDATE dictionary SET word=?, Definition=?, ExampleSetence=?, Language_id=? WHERE Word_id=?");
        $stmt->bind_param("sssii", $word, $def, $exampleSentence, $lid, $wid); // Corrected data types and parameter order
        $stmt->execute();
        
        // Redirect to dictionary.php
        header('Location: dictionary.php');
        exit(); 
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
