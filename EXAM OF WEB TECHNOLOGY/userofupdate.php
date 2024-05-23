<?php
// Connection details
include('databaseconnection.php');

// Check if Customer_id is set
if(isset($_REQUEST['User_id'])) {
    $uid = $_REQUEST['User_id'];
    
    $stmt = $connection->prepare("SELECT * FROM userof WHERE User_id=?");
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $a = $row['User_id'];
        $b = $row['Username'];
        $c = $row['Email'];
        $d = $row['Password'];
        $e = $row['Role'];
        $f = $row['RegistrationDate'];
        $g = $row['Lastlogin'];
    } else {
        echo "User not found.";
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
        <label for="uid">User id:</label>
        <input type="number" name="uid" value="<?php echo isset($a) ? $a : ''; ?>" readonly>
        <br><br>
        <label for="uname">Username:</label>
        <input type="text" name="uname" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>

        <label for="pword">Password:</label>
        <input type="password" name="pword" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

        <label for="role">Role:</label>
        <input type="text" name="role" value="<?php echo isset($e) ? $e : ''; ?>">
         <br><br>
          <label for="regdate">Registration Date:</label>
        <input type="Date" name="regdate" value="<?php echo isset($e) ? $e : ''; ?>">
         <br><br>
          <label for="lastlo">Last Login:</label>
        <input type="Date" name="lastlo" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $uid = $_POST['uid'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pword = $_POST['pword'];
    $role= $_POST['role'];
    $regdate= $_POST['regdate'];
    $lastlo= $_POST['lastlo'];
    
    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE userof SET Username=?, Email=?, Password=?, Role=? , RegistrationDate=?, Lastlogin=? WHERE User_id=?");
    $stmt->bind_param("ssssssi", $uname, $email, $pword, $role, $regdate, $lastlo, $uid);
    $stmt->execute();
    
    // Redirect to customer.php
    header('Location: userof.php');
    exit(); // Ensure that no other content is sent after the header redirection
}

// Close the database connection
$connection->close();
?>
