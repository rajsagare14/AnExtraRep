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

$email = $_GET["email"];

// Fetch health report file path based on email
$sql = "SELECT health_report FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $healthReportPath = $row["health_report"];

  // Download the health report file
  header('Content-Type: application/pdf');
  header('Content-Disposition: attachment; filename="health_report.pdf"');
  readfile($healthReportPath);
} else {
  echo "Health report not found for the given email";
}

$conn->close();
?>