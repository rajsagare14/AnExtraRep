<?php
// Connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "an_extra_rep";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST["name"];
$age = $_POST["age"];
$weight = $_POST["weight"];
$email = $_POST["email"];

// Upload health report file
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["healthReport"]["name"]);
move_uploaded_file($_FILES["healthReport"]["tmp_name"], $targetFile);

// Insert user details and file path into the database
$sql = "INSERT INTO users (name, age, weight, email, health_report) VALUES ('$name', '$age', '$weight', '$email', '$targetFile')";
if ($conn->query($sql) === TRUE) {
  echo "User details inserted successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
