<?php
// Connection details
include('databaseconnection.php');
// Check if Language_id is set
if(isset($_REQUEST['Language_id'])) {
    $lid = $_REQUEST['Language_id'];
    
    $stmt = $connection->prepare("SELECT * FROM language WHERE Language_id=?");
    $stmt->bind_param("i", $lid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['Language_id'];
        $b = $row['Language_name'];
        $c = $row['ISO_Code'];
        $d = $row['Native_name'];
        $e = $row['Country'];
        $f = $row['Description'];
    } else {
        echo "Language not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Language</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="lid">Language id:</label>
        <input type="number" name="lid" value="<?php echo isset($a) ? $a : ''; ?>" readonly>
        <br><br>
        <label for="lname">Language name:</label>
        <input type="text" name="lname" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="ISOcode">ISO Code:</label>
        <input type="text" name="ISOcode" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="nativename">Native name:</label>
        <input type="password" name="nativename" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="country">Country:</label>
        <input type="text" name="country" value="<?php echo isset($e) ? $e : ''; ?>">
         <br><br>
          <label for="descr">Description:</label>
        <input type="text" name="descr" value="<?php echo isset($e) ? $e : ''; ?>">
         <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $lid = $_POST['lid'];
    $lname = $_POST['lname'];
    $ISOcode = $_POST['ISOcode'];
    $nativename = $_POST['nativename'];
    $country= $_POST['country'];
    $descr= $_POST['descr'];

    
    // Update the language in the database
    $stmt = $connection->prepare("UPDATE language SET Language_name=?, ISO_Code=?, Native_name=?, Country=? , Description=? WHERE Language_id=?");
    $stmt->bind_param("sssssi", $lname, $ISOcode, $nativename, $country, $descr, $lid);
    $stmt->execute();
    
    // Redirect to language.php
    header('Location: language.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>
