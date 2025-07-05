<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Replace these with your actual InfinityFree database credentials
$servername = "elevatex.infinityfreeapp.com";         // e.g., sql301.epizy.com
$username = "if0_39401656";              // your InfinityFree DB username
$password = "hrWPzzrEVfWKTi";           // the password you set
$dbname = "if0_39401656_elevatex";       // your full database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data safely
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$motivation = $_POST['motivation'] ?? '';
$level = $_POST['level'] ?? '';
$goal = $_POST['goal'] ?? '';
$language = $_POST['language'] ?? '';

// Prepare and bind
$sql = "INSERT INTO registrations (name, email, motivation, level, goal, language)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $email, $motivation, $level, $goal, $language);

// Execute and redirect
if ($stmt->execute()) {
  header("Location: match-mentors.php?goal=$goal&level=$level&language=$language");
  exit();
} else {
  echo "Error: " . $stmt->error;
}

$conn->close();
?>
