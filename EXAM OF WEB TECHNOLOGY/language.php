<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <title>Language Table</title>
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
    function confirmInsert() {
        return confirm('Are you sure you want to insert this record?');
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

  <h1>Language Form</h1>
  <form method="post" action="language.php">
    <label for="lid">Language Id:</label>
    <input type="number" id="lid" name="lid" required><br><br>

    <label for="lname">Language Name:</label>
    <input type="text" id="lname" name="lname" required><br><br>

    <label for="ISOcode">ISO Code:</label>
    <input type="text" id="ISOcode" name="ISOcode" required><br><br>

    <label for="nativename">Native Name:</label>
    <input type="text" id="nativename" name="nativename" required><br><br>

    <label for="country">Country:</label>
    <input type="text" id="country" name="country" required><br><br>

    <label for="descr">Description:</label>
    <input type="text" id="descr" name="descr" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br>
    <a href="./home.html">Go Back to Home</a><br><br>
  </form>

  <?php
  // Connection details
include('databaseconnection.php');

  // Insert data if form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Prepare and bind the parameters
      $stmt = $connection->prepare("INSERT INTO language(Language_name, ISO_Code, Native_name, Country, Description) VALUES (?,?,?,?,?)");

      // Bind parameters
      $stmt->bind_param("sssss", $lname, $ISOcode, $nativename, $country, $descr);

      // Set parameters and execute
      $lname = $_POST['lname'];
      $ISOcode = $_POST['ISOcode'];
      $nativename = $_POST['nativename'];
      $country = $_POST['country'];
      $descr = $_POST['descr'];

      if ($stmt->execute()) {
          echo "New record has been added successfully";
      } else {
          echo "Error: " . $stmt->error;
      }
      $stmt->close();
  }

  // Close connection
  $connection->close();
  ?>

  <table border="5">
    <thead>
      <tr>
        <th>Language_id</th>
        <th>Language_name</th>
        <th>ISO_Code</th>
        <th>Native_name</th>
        <th>Country</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Connection details
      include('databaseconnection.php');

      // Selecting data from the database
      $sql_select = "SELECT * FROM language";
      $result = $connection->query($sql_select);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $lid = $row['Language_id']; 
              echo "<tr>
                      <td>" . $row['Language_id'] . "</td>
                      <td>" . $row['Language_name'] . "</td>
                      <td>" . $row['ISO_Code'] . "</td>
                      <td>" . $row['Native_name'] . "</td>
                      <td>" . $row['Country'] . "</td>
                      <td>" . $row['Description'] . "</td>
                      <td>
                          <a style='padding:4px' href='languagedelete.php?Language_id=$lid'>Delete</a>
                          <a style='padding:4px' href='updatelanguage.php?Language_id=$lid'>Update</a>
                      </td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='7'>No records found</td></tr>";
      }
      $connection->close();
      ?>
    </tbody>
  </table>

  <footer>
    <center> 
      <b><h2>UR CBE BIT &copy; 2024 &reg; Designer by: @Divine</h2></b>
    </center>
  </footer>
</body>
</html>
