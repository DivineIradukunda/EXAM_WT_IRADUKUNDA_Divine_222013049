<?php
session_start(); // Starting the session

include('databaseconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    // Prepare and execute SQL statement to prevent SQL injection
    $sql = "SELECT Username, Password FROM userof WHERE Email=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($password, $row['Password'])) {
            $_SESSION['Username'] = $row['Username']; // Store username in session
            $_SESSION['Email'] = $email; // Store email in session
            header("Location: home.html"); // Redirect to home page after successful login
            exit();
        } else {
            $error = "Invalid email or password"; // Set error message if password is incorrect
        }
    } else {
        $error = "User not found"; // Set error message if user does not exist
    }
}

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
<center>
    <h2 style="background-color:yellow; width: 500px; height: 50px;">Login Form</h2>
    <form action="home.html" method="post" style="background-color: pink; width: 500px; height: 200px;">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <p style="font-size: 20px;"><a href="resetpassword.php">Forgot Password</a></p>
        <input type="submit" value="Login">
        <input type="reset" value="Cancel">
        <p style="font-size: 20px;"><i>Don't have an account?</i> <a href="register.html">Create New Account</a></p>
    </form>
    <?php
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>
</center>
</body>
</html>
