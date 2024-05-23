<?php
include('databaseconnection.php');
// Check if the 'query' GET parameter is set
if (isset($_GET['query'])) {
     
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query for Site
    $sql = "SELECT * FROM Userof WHERE Username LIKE '%$searchTerm%'";
    $result_Userof = $connection->query($sql);

    // Perform the search query for Therapist
    $sql = "SELECT * FROM Dictionary WHERE Email LIKE '%$searchTerm%'";
    $result_Dictionary = $connection->query($sql);

    // Perform the search query for Handler
    $sql = "SELECT * FROM Glossary WHERE Term LIKE '%$searchTerm%'";
    $result_Glossary = $connection->query($sql);

    // Perform the search query for Activities
    $sql = "SELECT * FROM Translation WHERE TranslatedText LIKE '%$searchTerm%'";
    $result_Translation = $connection->query($sql);

    // Perform the search query for session
    $sql = "SELECT * FROM Userpreference WHERE Theme LIKE '%$searchTerm%'";
    $result_Userpreference = $connection->query($sql);

    // Perform the search query for Client
    $sql = "SELECT * FROM Translationmemory WHERE TargetText LIKE '%$searchTerm%'";
    $result_Translationmemory = $connection->query($sql);

    // Perform the search query for Therapist_availability
    $sql = "SELECT * FROM Translationhistory WHERE Action LIKE '%$searchTerm%'";
    $result_Translationhistory= $connection->query($sql);

    // Perform the search query for Dog_Certification
    $sql = "SELECT * FROM Language WHERE Language_name LIKE '%$searchTerm%'";
    $result_Language = $connection->query($sql);

    // Perform the search query for Session_feedback
    $sql = "SELECT * FROM Feedback WHERE Rating LIKE '%$searchTerm%'";
    $result_Feedback = $connection->query($sql);

    // Perform the search query for Therapist_ratings
    $sql = "SELECT * FROM SourceText WHERE Author LIKE '%$searchTerm%'";
    $result_SourceText= $connection->query($sql);


    // Output search results
    echo "<h2><u>Search Results:</u></h2>";
    echo "<h3>Userof:</h3>";
    if ($result_Userof->num_rows > 0) {
        while ($row = $result_Dog->fetch_assoc()) {
            echo "<p>" . $row['fbsql_username(link_identifier)'] . "</p>";
        }
    } else {
        echo "<p>No userof found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Dictionary:</h3>";
    if ($result_Dictionaryt->num_rows > 0) {
        while ($row = $result_Therapist->fetch_assoc()) {
            echo "<p>" . $row['Definition'] . "</p>";
        }
    } else {
        echo "<p>No Dictionary found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Glossary:</h3>";
    if ($result_Glossary->num_rows > 0) {
        while ($row = $result_Glossary->fetch_assoc()) {
            echo "<p>" . $row['Term'] . "</p>";
        }
    } else {
        echo "<p>No Glossary found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Translation:</h3>";
    if ($result_Translation->num_rows > 0) {
        while ($row = $result_Translation->fetch_assoc()) {
            echo "<p>" . $row['TranslatedText'] . "</p>";
        }
    } else {
        echo "<p>No Translation found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Userpreference:</h3>";
    if ($result_Userpreference->num_rows > 0) {
        while ($row = $result_session->fetch_assoc()) {
            echo "<p>" . $row['Theme'] . "</p>";
        }
    } else {
        echo "<p>No userpreference found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Translationmemeory:</h3>";
    if ($result_Translationmemory->num_rows > 0) {
        while ($row = $result_Translationmemory->fetch_assoc()) {
            echo "<p>" . $row['TargetText'] . "</p>";
        }
    } else {
        echo "<p>No Translationmemeory found matching the search term: " . $searchTerm . "</p>";
    }


    echo "<h3>Translationhistory:</h3>";
    if ($result_Translationhistory->num_rows > 0) {
        while ($row = $result_Translationhistory->fetch_assoc()) {
            echo "<p>" . $row['Action'] . "</p>";
        }
    } else {
        echo "<p>No Translationhistory found matching the search term: " . $searchTerm . "</p>";
    }

     echo "<h3>Language:</h3>";
    if ($result_Language->num_rows > 0) {
        while ($row = $result_Language->fetch_assoc()) {
            echo "<p>" . $row['Language_name'] . "</p>";
        }
    } else {
        echo "<p>No Language found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Feedback:</h3>";
    if ($result_Feedback->num_rows > 0) {
        while ($row = $result_Feedback->fetch_assoc()) {
            echo "<p>" . $row['Rating'] . "</p>";
        }
    } else {
        echo "<p>No Feedback found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>SourceText:</h3>";
    if ($result_SourceText->num_rows > 0) {
        while ($row = $result_SourceText->fetch_assoc()) {
            echo "<p>" . $row['Author'] . "</p>";
        }
    } else {
        echo "<p>No SourceText found matching the search term: " . $searchTerm . "</p>";
    }

    $connection->close();
} else {
    echo "No search term was provided.";
}
?>