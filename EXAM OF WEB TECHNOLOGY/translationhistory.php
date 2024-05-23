<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <title>Translation History Table</title>
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
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./userof.php">USEROF</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./translation.php">TRANSLATION</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./sourcetext.php">SOURCETEXT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./language.php">LANGUAGE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">FEEDBACK</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./dictionary.php">DICTIONARY</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./translationmemory.php">TRANSLATION MEMORY</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./translationhistory.php">TRANSLATION HISTORY</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./userpreference.php">USER PREFERENCE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./glossary.php">GLOSSARY</a></li>
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
  <h1>Translation History Form</h1>
  <form method="post" action="translationhistory.php">
    <label for="hid">History Id:</label>
    <input type="number" id="hid" name="hid" required><br><br>
    <label for="action">Action:</label>
    <input type="text" id="action" name="action" required><br><br>
    <label for="actiondate">Action Date:</label>
    <input type="date" id="actiondate" name="actiondate" required><br><br>
    <label for="comments">Comments:</label>
    <input type="text" id="comments" name="comments" required><br><br>
    <label for="tid">Translation Id:</label>
    <input type="number" id="tid" name="tid" required><br><br>
    <input type="submit" name="add" value="Insert"><br><br>
    <a href="./home.html">Go Back to Home</a><br><br>
  </form>
  <?php
  // Connection details
  include('databaseconnection.php');

  // Handling POST request
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $action = mysqli_real_escape_string($connection, $_POST['action']);
      $actiondate = mysqli_real_escape_string($connection, $_POST['actiondate']);
      $comments = mysqli_real_escape_string($connection, $_POST['comments']);
      $tid = intval($_POST['tid']);
      
      // Preparing SQL query
      $sql = "INSERT INTO translationhistory (Action, Action_date, Comments, Translation_id) 
      VALUES ('$action', '$actiondate', '$comments', '$tid')";

      // Execute SQL query
      if ($connection->query($sql) === TRUE) {
          header("Location: translationhistory.php");
          exit();
      } else {
          // Displaying error message if query execution fails
          echo "Error: " . $sql . "<br>" . $connection->error;
      }
  }

  // Retrieve and display data
  $sql = "SELECT * FROM translationhistory";
  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
      // Output data for all table
      echo "<h2>Translation History</h2>";
      echo "<table border='3'>";
      echo "<tr>
                <th>History_id</th>
                <th>Action</th>
                <th>Action_date</th>
                <th>Comments</th>
                <th>Translation_id</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>";
      while ($row = $result->fetch_assoc()) {
          $hid = $row['History_id'];
          echo "<tr>
                <td>" . $row['History_id'] . "</td>
                <td>" . $row['Action'] . "</td>
                <td>" . $row['Action_date'] . "</td>
                <td>" . $row['Comments'] . "</td>
                <td>" . $row['Translation_id'] . "</td>
                <td><a style='padding:4px' href='translationhdelete.php?History_id=$hid'>Delete</a></td> 
                <td><a style='padding:4px' href='updatetranslationhistory.php?History_id=$hid'>Update</a></td> 
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
