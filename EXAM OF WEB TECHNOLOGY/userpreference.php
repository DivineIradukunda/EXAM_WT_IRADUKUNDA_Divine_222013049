<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  
  <title> Userpreference Table</title>

  <style>
  .dropdown {
    position: relative;
    display: inline;
    margin-right: 10px;
  }
  .dropdown-contents {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0; 
  }
  .dropdown:hover .dropdown-contents {
    display: block;
  }
  .dropdown-contents a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  .dropdown-contents a:hover {
    background-color: #f1f1f1;
  }
</style> 
</head>
<body>

  <ul style="list-style-type: none; padding: 0;">
     <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./userof.php">USEROF</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./translation.php">TRANSLATION</a> </li>
    <li style="display: inline; margin-right: 10px;"><a href="./sourcetext.php">SOURCETEXT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./language.php">LANGUAGE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">FEEDBACK</a> </li>
    <li style="display: inline; margin-right: 10px;"><a href="./dictionary.php">DICTIONARY</a> </li>
    <li style="display: inline; margin-right: 10px;"><a href="./translationmemory.php">TRANSLATION MEMORY</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./translationhistory.php">TRANSLATION HISTORY</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./userpreference.php">USER PREFERENCE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./glossary.php">GLOSSARY</a>  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: darkblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        
        <a href="login.html">Login</a>
       <a href="register.html">Register</a>
       <a href="logout.php">Logout</a>
      </div>
    </li>
   
  </ul>
  
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
     
   <h1>Userpreference Form</h1>
<form method="post" action="userpreference.php">

<label for="pid">Preference Id:</label>
<input type="number" id="pid" name="pid" required><br><br>

<label for="theme">Theme:</label>
<input type="text" id="theme" name="theme" required><br><br>

<label for="fontsize">Font Size:</label>
<input type="text" id="fontsize" name="fontsize" required><br><br>

<label for="nsetting">Notification Setting:</label>
<input type="text" id="nsetting" name="nsetting" required><br><br>

  <label for="uid">User Id:</label>
<input type="number" id="uid" name="uid" required><br><br>

  <label for="lid">Language Id:</label>
<input type="number" id="lid" name="lid" required><br><br>

 <input type="submit" name="add" value="Insert"><br><br>
 <a href="./home.html">Go Back to Home</a><br><br>
</form>
<?php
// Connection details
include('databaseconnection.php');

  // Handling POST request
// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $theme = mysqli_real_escape_string($connection, $_POST['theme']);
    $fontsize = mysqli_real_escape_string($connection, $_POST['fontsize']);
    $nsetting = mysqli_real_escape_string($connection, $_POST['nsetting']);
    $uid = intval($_POST['uid']);
    $lid = intval($_POST['lid']);
    
    // Preparing SQL query
    $sql = "INSERT INTO userpreference (Theme, FontSize, NotificationSetting, User_id, Language_id) 
            VALUES ('$theme', '$fontsize', '$nsetting', '$uid', '$lid')";

    // Execute SQL query
    if ($connection->query($sql) === TRUE) {
        header("Location: userpreference.php");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}


  // Retrieve and display data for Command
  $sql = "SELECT * FROM userpreference";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
      // Output data for all table
      echo "<h2>User Preference</h2>";
      echo "<table border='5'>";
      echo "<tr>
                <th>Preference_id</th>
                <th>Theme</th>
                <th>FontSize</th>
                <th>NotificationSetting</th>
                <th>User_id</th>
                <th>Language_id</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>";
            // Fetch the command_id
      while ($row = $result->fetch_assoc()) {
          $pid = $row['Preference_id'];
          echo "<tr>
                <td>" . $row['Preference_id'] . "</td>
                <td>" . $row['Theme'] . "</td>
                <td>" . $row['FontSize'] . "</td>
                <td>" . $row['NotificationSetting'] . "</td>
                <td>" . $row['User_id'] . "</td>
                <td>" . $row['Language_id'] . "</td>
                <td><a style='padding:4px' href='deleteuserpreference.php?Preference_id=$pid'>Delete</a></td> 
                <td><a style='padding:4px' href='updateuserpreference.php?Preference_id=$pid'>Update</a></td> 
            </tr>";
      }
      echo "</table>";
  } else {
      echo "<p>No data found</p>";
  }
  // Close the database connection
  $connection->close();
  ?>

  <footer>
    <center> 
      <b><h2>UR CBE BIT &copy, 2024 &reg, Designed by: @Divine IRADUKUNDA</h2></b>
    </center>
  </footer>
</body>
</html>
