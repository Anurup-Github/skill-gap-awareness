<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "sql300.infinityfree.com";
$username = "if0_39401656";
$password = "hrWPzzrEVfWKTi";
$dbname = "if0_39401656_elevatex";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get filters from URL and normalize
$goal = strtolower(trim($_GET['goal'] ?? ''));
$level = strtolower(trim($_GET['level'] ?? ''));
$language = strtolower(trim($_GET['language'] ?? ''));

echo "<pre>DEBUG:
Goal: $goal
Level: $level
Language: $language</pre>";


// Prepare and execute query
$sql = "SELECT * FROM mentors
        WHERE LOWER(expertise) = ? AND LOWER(level) = ? AND LOWER(language) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $goal, $level, $language);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Matched Mentors | ElevateX</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 40px;
    }
    h2 {
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background: #007BFF;
      color: white;
    }
    tr:nth-child(even) {
      background: #f9f9f9;
    }
    .no-match {
      background: #fff3cd;
      color: #856404;
      padding: 20px;
      border: 1px solid #ffeeba;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<h2>🎯 Matched Mentors for You</h2>

<?php if ($result->num_rows > 0): ?>
  <table>
    <tr>
      <th>Name</th>
      <th>Expertise</th>
      <th>Level</th>
      <th>Language</th>
      <th>Availability</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['expertise']) ?></td>
        <td><?= htmlspecialchars($row['level']) ?></td>
        <td><?= htmlspecialchars($row['language']) ?></td>
        <td><?= htmlspecialchars($row['availability']) ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
<?php else: ?>
  <div class="no-match">
    <strong>No mentors match your criteria yet.</strong><br>
    We'll notify you when one is available!
  </div>
<?php endif; ?>

</body>
</html>
