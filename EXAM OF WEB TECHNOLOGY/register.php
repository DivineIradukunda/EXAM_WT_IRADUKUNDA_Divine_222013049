<?php
// Connection details
include('databaseconnection.php');
// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
     $fname  = $_POST['fname'];
     $lname = $_POST['lname'];
     $gender = $_POST['gend'];
   
    
    // Preparing SQL query
    $sql = "INSERT INTO user ( Username, Email, Password, Firstname, Lastname, Gender ) 
    VALUES ('$username','$email','$password','$fname','$lname','$gender')";

    // Executing SQL query
    if ($connection->query($sql) === TRUE) {
        // Redirecting to login page on successful registration
        header("Location:login.html");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Closing database connection
$connection->close();
?>
