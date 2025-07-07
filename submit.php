<?php
// Enable error reporting (turn off in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials (from InfinityFree)
$servername = "sql300.infinityfree.com";
$username = "if0_39401656";
$password = "hrWPzzrEVfWKTi";
$dbname = "if0_39401656_elevatex";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$name       = $_POST['name']       ?? '';
$email      = $_POST['email']      ?? '';
$motivation = $_POST['motivation'] ?? '';
$level      = $_POST['level']      ?? '';
$goal       = $_POST['goal']       ?? '';
$language   = $_POST['language']   ?? '';

// Debug: print all POST data
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Sanity check (optional debug)
if (!$name || !$email || !$goal || !$level || !$language) {
  die("Missing required fields. Please go back and try again.");
}

// Insert into 'registrations' table
$sql = "INSERT INTO registrations (name, email, motivation, level, goal, language)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $email, $motivation, $level, $goal, $language);

// Execute and redirect
if ($stmt->execute()) {
  // Safely encode values for redirect
  $goal = urlencode($goal);
  $level = urlencode($level);
  $language = urlencode($language);

  // Redirect user to match-mentors page with filters
  header("Location: match-mentors.php?goal=$goal&level=$level&language=$language");
  exit();
} else {
  echo "Database error: " . $stmt->error;
}

$conn->close();
?>
