<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  
  <title> Translation</title>

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
     <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a> </li>
    <li style="display: inline; margin-right: 10px;"><a href="./userof.php">USEROF</a> </li>
    <li style="display: inline; margin-right: 10px;"><a href="./translation.php">TRANSLATION</a> </li>
    <li style="display: inline; margin-right: 10px;"><a href="./sourcetext.php">SOURCETEXT</a> </li>
    <li style="display: inline; margin-right: 10px;"><a href="./language.php">LANGUAGE</a>  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">FEEDBACK</a>  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./dictionary.php">DICTIONARY</a> </li>
   <li style="display: inline; margin-right: 10px;"><a href="./translationmemory.php">TRANSLATION MEMORY</a> </li>
   <li style="display: inline; margin-right: 10px;"><a href="./translationhistory.php">TRANSLATION HISTORY</a> </li>
   <li style="display: inline; margin-right: 10px;"><a href="./userpreference.php">USER PREFERENCE</a></li>
   <li style="display: inline; margin-right: 10px;"><a href="./glossary.php">GLOSSARY</a> </li>
   
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
     
   <h1>Translation Form</h1>
<form method="post" action="translation.php">

<label for="tid">Translation Id:</label>
<input type="number" id="tid" name="tid" required><br><br>

<label for="tdate">Translation Date:</label>
<input type="Date" id="tdate" name="tdate" required><br><br>

<label for="ttext">Translated Text:</label>
<input type="text" id="ttext" name="ttext" required><br><br>

<label for="sourcetid">SourceText Id:</label>
<input type="number" id="sourcetid" name="sourcetid" required><br><br>

  <label for="lid">Language Id:</label>
<input type="number" id="lid" name="lid" required><br><br>

 <input type="submit" name="add" value="Insert"><br><br>
 <a href="./home.html">Go Back to Home</a><br><br>
</form>
<?php
// Connection details
include('databaseconnection.php');

// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO translation(Translation_date, Translatedtext, SourceText_id, Language_id) VALUES (?,?,?,?)");

    // Bind parameters
    $stmt->bind_param("ssii",$tdate, $ttext, $sourcetid,$lid);

    // Set parameters and execute
    $tdate= $_POST['tdate'];
    $ttext= $_POST['ttext'];
    $sourcetid= $_POST['sourcetid'];
   $lid= $_POST['lid'];
   
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
$sql_select = "SELECT * FROM translation";
$result = $connection->query($sql_select);
?>
<!DOCTYPE html>
<html>
<head>
    
    <title>Translation</title>
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
    <center><h2>Translation Of Text</h2></center>
    <table border="5">
        <tr>
            <th>Translation_id</th>
            <th>Translation_date</th>
            <th>Translatedtext</th>
            <th>SourceText_id</th>
            <th>Language_id</th>    
        </tr>
        <?php
   include('databaseconnection.php');

        // Prepare SQL query to retrieve all products
        $sql = "SELECT * FROM translation";
        $result = $connection->query($sql);

        // Check if there are any products
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $tid = $row['Translation_id']; // Fetch the Translation_id
                echo "<tr>
                    <td>" . $row['Translation_id'] . "</td>
                    <td>" . $row['Translation_date'] . "</td>
                    <td>" . $row['Translatedtext'] . "</td>
                    <td>" . $row['SourceText_id'] . "</td>
                    <td>" . $row['Language_id'] . "</td>
                    <td><a style='padding:4px' href='translationdelete.php?Translation_id=$tid'>Delete</a></td> 
                    <td><a style='padding:4px' href='updatetranslation.php?Translation_id=$tid'>Update</a></td> 
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