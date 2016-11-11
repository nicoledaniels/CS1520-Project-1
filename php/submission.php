<?php
    if ($_POST){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "submission";

      //Create the connection
      $connection = new mysqli($servername, $username, $password, $dbname);

      //Check the connection
      if ($connection->connect_error) {
        die("Connection failed" . $connection->connect_error);
      }

      //Create the database, if it does not already exist
      if ($connection->select_db('submission') == false){
        $submission_db = "CREATE DATABASE submission";
        if ($connection->query($submission_db) == true) {
          echo "Database created successfully";
        }
        else {
          echo "There was a problem creating the database";
        }
      }

      //Create the submission table, if it doesn't already exist
      $table = mysqli_query($connection, 'select 1 from `submissions` LIMIT 1');
      if(!$table){
        $submission = "CREATE TABLE submissions (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        message TEXT,
        submission_date TIMESTAMP
        )";
        if ($connection->query($submission) === true){
          echo "Table submissions created";
        }
        else {
          echo "error creating table: " .$connection->error;
        }
      }

      //Get the appropriate variables from the form when submitted
      $name = $_POST['name'];
      $email = $_POST['email'];
      $message = $_POST['message'];

      //Insert values into the database
      $query = "INSERT INTO `submissions` (`id`, `name`, `email`, `message`, `submission_date`) VALUES (NULL, '$name', '$email', '$message', CURRENT_TIMESTAMP);";

      if(!mysqli_query($connection, $query)){
        die("Error: Could not save information" . mysqli_error($connection));
      }

      mysqli_close($connection);
    }
?>
