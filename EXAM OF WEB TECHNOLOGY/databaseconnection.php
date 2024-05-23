  <?php
  // Connection details
  $host = "localhost";
  $user = "222013049";
  $pass = "222013049";
  $database = "language translation tool";

  // Creating connection
  $connection = new mysqli($host, $user, $pass, $database);

  // Check connection
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }