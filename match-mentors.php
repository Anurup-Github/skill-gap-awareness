<?php
$servername = "sql300.infinityfree.com";
$username = "if0_39401656";
$password = "hrWPzzrEVfWKTi";
$dbname = "if0_39401656_elevatex";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get filters from URL
$goal = $_GET['goal'] ?? '';
$level = $_GET['level'] ?? '';
$language = $_GET['language'] ?? '';

// Query mentors table
$sql = "SELECT * FROM mentors WHERE expertise=? AND level=? AND language=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $goal, $level, $language);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Matched Mentors</title>
  <style>
    body { font-family: Arial; background: #f4f4f4; padding: 2rem; }
    table { width: 100%; border-collapse: collapse; background: #fff; }
    th, td { padding: 1rem; border: 1px solid #ccc; text-align: left; }
    th { background: #004d99; color: white; }
  </style>
</head>
<body>
  <h2>Mentors Matched to Your Learning Path</h2>
  <?php if ($result->num_rows > 0): ?>
    <table>
      <tr>
        <th>Name</th>
        <th>Expertise</th>
        <th>Level</th>
        <th>Language</th>
        <th>Availability</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
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
    <p>No mentors match your criteria yet. We’ll notify you when one is available!</p>
  <?php endif; ?>
</body>
</html>

<?php $conn->close(); ?>
