<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '<pre>';
print_r($_POST);
echo '</pre>';
exit;

$servername = "sql300.infinityfree.com";
$username = "if0_39401656";
$password = "hrWPzzrEVfWKTi";
$dbname = "if0_39401656_elevatex";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$motivation = $_POST['motivation'] ?? '';
$level = $_POST['level'] ?? '';
$goal = $_POST['goal'] ?? '';
$language = $_POST['language'] ?? '';

$sql = "INSERT INTO registrations (name, email, motivation, level, goal, language)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $email, $motivation, $level, $goal, $language);

if ($stmt->execute()) {
  $goal = urlencode($goal);
  $level = urlencode($level);
  $language = urlencode($language);

  header("Location: match-mentors.php?goal=$goal&level=$level&language=$language");
  exit();
} else {
  echo "Error: " . $stmt->error;
}

$conn->close();
?>
