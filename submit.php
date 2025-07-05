<?php
// Database connection
$servername = "localhost";
$username = "root"; // or your hosting DB username
$password = "";     // or your hosting DB password
$dbname = "elevatex"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$motivation = $_POST['motivation'];
$level = $_POST['level'];
$goal = $_POST['goal'];
$language = $_POST['language'];

// Insert into registrations table
$sql = "INSERT INTO registrations (name, email, motivation, level, goal, language)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $email, $motivation, $level, $goal, $language);
$stmt->execute();

// Redirect to mentor matching page
header("Location: match-mentors.php?goal=$goal&level=$level&language=$language");
exit();
?>
