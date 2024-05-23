<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  
  <title> User Of System</title>

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
     
   <h1>Userof Form</h1>
<form method="post" action="userof.php">

<label for="uid">User Id:</label>
<input type="number" id="uid" name="uid" required><br><br>

<label for="uname">User Name:</label>
<input type="text" id="uname" name="uname" required><br><br>

<label for="email">Email:</label>
<input type="email" id="email" name="email" required><br><br>

<label for="pword">Password:</label>
<input type="password" id="pword" name="pword" required><br><br>

  <label for="role">Role:</label>
<input type="text" id="role" name="role" required><br><br>

  <label for="regdate">Registration Date:</label>
<input type="date" id="regdate" name="regdate" required><br><br>

<label for="lastlo">Last Login:</label>
<input type="date" id="lastlo" name="lastlo" required><br><br>

 <input type="submit" name="add" value="Insert"><br><br>
 <a href="./home.html">Go Back to Home</a><br><br>
</form>
<?php
// Connection details
include('databaseconnection.php');

// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO userof(Username, Email, Password, Role,RegistrationDate, Lastlogin) VALUES (?,?,?,?,?,?)");

    // Bind parameters
    $stmt->bind_param("ssssss",$uname, $email, $pword,$role,$regdate,$lastlo);

    // Set parameters and execute
    $uname= $_POST['uname'];
    $email= $_POST['email'];
    $pword= $_POST['pword'];
   $role= $_POST['role'];
   $regdate= $_POST['regdate'];
  $lastlo= $_POST['lastlo'];
   
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    }
    $connection->close();
    ?>

<?php
// Connection details
include('databaseconnection.php');

// Selecting data from the database
$sql_select = "SELECT * FROM userof";
$result = $connection->query($sql_select);
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>User</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Records of User</h2></center>
    <table border="5">
        <tr>
            <th>User_id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
            <th>RegistrationDate</th>
            <th>Lastlogin</th>
        </tr>
        <?php
        // Define connection parameters
        include('databaseconnection.php');

        // Prepare SQL query to retrieve all products
        $sql = "SELECT * FROM userof";
        $result = $connection->query($sql);

        // Check if there are any products
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $uid = $row['User_id']; // Fetch the User_id
                echo "<tr>
                    <td>" . $row['User_id'] . "</td>
                    <td>" . $row['Username'] . "</td>
                    <td>" . $row['Email'] . "</td>
                    <td>" . $row['Password'] . "</td>
                    <td>" . $row['Role'] . "</td>
                    <td>" . $row['RegistrationDate'] . "</td>
                    <td>" . $row['Lastlogin'] . "</td>
                    <td><a style='padding:4px' href='userofdelete.php?User_id=$uid'>Delete</a></td> 
                    <td><a style='padding:4px' href='userofupdate.php?User_id=$uid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Divine</h2></b>
  </center>
</footer>
</body>
</html>