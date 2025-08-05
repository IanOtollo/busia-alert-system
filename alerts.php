<?php
include 'db.php';

$wardFilter = isset($_GET['ward']) ? $_GET['ward'] : '';
if ($wardFilter) {
  $stmt = $conn->prepare("SELECT * FROM alerts WHERE location = ? ORDER BY date_issued DESC");
  $stmt->bind_param("s", $wardFilter);
  $stmt->execute();
  $result = $stmt->get_result();
} else {
  $result = $conn->query("SELECT * FROM alerts ORDER BY date_issued DESC");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Current Alerts - Busia</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
  <a href="index.php">Home</a>
  <a href="alerts.php">View Alerts</a>
  <a href="admin.html">Post Alert</a>
  <a href="contact.html">SOS / Contact</a>
</nav>
<div class="back-home">
</div>

 <header>
  <div class="branding">
    <img src="logo.png" alt="Busia County Logo" class="logo">
    <h1>Busia County Disaster Alert System</h1>
  </div>
</header>


  <section class="form-section">
    <form method="GET" action="alerts.php" style="margin-bottom: 20px;">
  <label for="ward">Filter by Ward:</label>
  <select name="ward" id="ward" onchange="this.form.submit()">
    <option value="">-- All Wards --</option>
    <option value="Butula" <?= isset($_GET['ward']) && $_GET['ward'] === 'Butula' ? 'selected' : '' ?>>Butula</option>
    <option value="Matayos" <?= isset($_GET['ward']) && $_GET['ward'] === 'Matayos' ? 'selected' : '' ?>>Matayos</option>
    <option value="Nambale" <?= isset($_GET['ward']) && $_GET['ward'] === 'Nambale' ? 'selected' : '' ?>>Nambale</option>
    <option value="Funyula" <?= isset($_GET['ward']) && $_GET['ward'] === 'Funyula' ? 'selected' : '' ?>>Funyula</option>
  </select>
</form>

    <h2>Active Alerts</h2>

    <?php if ($result->num_rows > 0): ?>
      <ul>
        <?php while ($row = $result->fetch_assoc()): ?>
          <li>
            <strong><?= htmlspecialchars($row['type']) ?></strong>  
            in <em><?= htmlspecialchars($row['location']) ?></em>  
            on <?= date("M d, Y H:i", strtotime($row['date_issued'])) ?><br>
            <small><?= htmlspecialchars($row['message']) ?></small>
          </li>
          <hr>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p>No active alerts at this time.</p>
    <?php endif; ?>

  </section>
</body>
</html>
