<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  
  <title> Dictionary Table</title>

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
  <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>

  <ul style="list-style-type: none; padding: 0;">
     <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./userof.php">USEROF</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./translation.php">TRANSLATION</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./sourcetext.php">SOURCETEXT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./language.php">LANGUAGE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">FEEDBACK</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./dictionary.php">DICTIONARY</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./translationmemory.php">TRANSLATION MEMORY</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./translationhistory.php">TRANSLATION HISTORY</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./userpreference.php">USER PREFERENCE</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./glossary.php">GLOSSARY</a>
  </li>
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
     
   <h1>Dictionary Form</h1>
<form method="post" action="dictionary.php">

<label for="wid">Word Id:</label>
<input type="number" id="wid" name="wid" required><br><br>

<label for="word">Word:</label>
<input type="text" id="word" name="word" required><br><br>

<label for="def">definition:</label>
<input type="text" id="def" name="def" required><br><br>

<label for="examplesetence">Example Setence:</label>
<input type="text" id="examplesetence" name="examplesetence" required><br><br>

  <label for="lid">Language Id:</label>
<input type="number" id="lid" name="lid" required><br><br>

 <input type="submit" name="add" value="Insert"><br><br>
 <a href="./home.html">Go Back to Home</a><br><br>
</form>
<?php

include('databaseconnection.php');

  // Handling POST request
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
      $word = mysqli_real_escape_string($connection, $_POST['word']);
      $def = mysqli_real_escape_string($connection, $_POST['def']);
      $examplesetence = intval($_POST['examplesetence']);
      $lid = intval($_POST['lid']);
      
      
      // Preparing SQL query
      $sql = "INSERT INTO dictionary (Word, Definition, ExampleSetence, Language_id) 
      VALUES ('$word', '$def', '$examplesetence', '$lid')";

      // Execute SQL query
      if ($connection->query($sql) === TRUE) {
          header("Location: dictionary.php");
          exit();
      } else {
          // Displaying error message if query execution fails
          echo "Error: " . $sql . "<br>" . $connection->error;
      }
  }

  // Retrieve and display data for Dictionary
  $sql = "SELECT * FROM dictionary";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
      // Output data for all table
      echo "<h2>Dictionary </h2>";
      echo "<table border='5'>";
      echo "<tr>
                <th>Word_id</th>
                <th>Word</th>
                <th>Definition</th>
                <th>ExampleSetence</th>
                <th>Language_id</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>";
            // Fetch the word_id
      while ($row = $result->fetch_assoc()) {
          $wid = $row['Word_id'];
          echo "<tr>
                <td>" . $row['Word_id'] . "</td>
                <td>" . $row['Word'] . "</td>
                <td>" . $row['Definition'] . "</td>
                <td>" . $row['ExampleSetence'] . "</td>
                <td>" . $row['Language_id'] . "</td>
                <td><a style='padding:4px' href='dictionarydelete.php?Word_id=$wid'>Delete</a></td> 
                <td><a style='padding:4px' href='dictionaryupdate.php?Word_id=$wid'>Update</a></td> 
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
      <b><h2>UR CBE BIT &copy, 2024 &reg, Designed by: @Divine</h2></b>
    </center>
  </footer>
</body>
</html>
