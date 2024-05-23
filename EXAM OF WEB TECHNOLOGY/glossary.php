<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  
  <title> Glossary Table</title>

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
     <li style="display: inline; margin-right: 10px;"><a href="./Home.html">HOME</a>
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
  <form method="post" action="glossary.php">
    <h1>Glossary Form</h1>
    <label for="termid">Term Id:</label>
    <input type="number" id="termid" name="termid" required><br><br>
    <label for="term">Term:</label>
    <input type="text" id="term" name="term" required><br><br>
    <label for="def">Definition:</label>
    <input type="text" id="def" name="def" required><br><br>
    <label for="createdDate">Created Date:</label>
    <input type="Date" id="createdDate" name="createdDate" required><br><br>
    <label for="lid">Language Id:</label>
    <input type="number" id="lid" name="lid" required><br><br>
    <input type="submit" name="add" value="Insert"><br><br>
    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
// Connection details
include('databaseconnection.php');
  // Handling POST request
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
      $term = mysqli_real_escape_string($connection, $_POST['term']);
      $def = mysqli_real_escape_string($connection, $_POST['def']);
      $createddate = intval($_POST['createddate']);
      $lid = intval($_POST['lid']);
      
      // Preparing SQL query
      $sql = "INSERT INTO glossary (Term, Definition, CreatedDate, Language_id) 
      VALUES ('$term', '$def', '$createddate', '$lid')";

      // Execute SQL query
      if ($connection->query($sql) === TRUE) {
          header("Location: glossary.php");
          exit();
      } else {
          // Displaying error message if query execution fails
          echo "Error: " . $sql . "<br>" . $connection->error;
      }
  }

  // Retrieve and display data for Command
  $sql = "SELECT * FROM glossary";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
      // Output data for all table
      echo "<h2>Records of Glossary</h2>";
      echo "<table border='5'>";
      echo "<tr>
                <th>Term_id</th>
                <th>Term</th>
                <th>Definition</th>
                <th>CreateDate</th>
                <th>Language_id</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>";
            // Fetch the term_id
      while ($row = $result->fetch_assoc()) {
          $termid = $row['Term_id'];
          echo "<tr>
                <td>" . $row['Term_id'] . "</td>
                <td>" . $row['Term'] . "</td>
                <td>" . $row['Definition'] . "</td>
                <td>" . $row['CreatedDate'] . "</td>
                <td>" . $row['Language_id'] . "</td>
                <td><a style='padding:4px' href='glossarydelete.php?Term_id=$termid'>Delete</a></td> 
                <td><a style='padding:4px' href='updateglossary.php?Term_id=$termid'>Update</a></td> 
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
