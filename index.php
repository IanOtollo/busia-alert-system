<?php
include 'db.php';
$countResult = $conn->query("SELECT COUNT(*) as total FROM subscribers");
$row = $countResult->fetch_assoc();
$totalSubscribers = $row['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home - Busia Disaster Alert System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
  <a href="index.php">Home</a>
  <a href="alerts.php">View Alerts</a>
  <a href="admin.html">Post Alert</a>
  <a href="contact.html">SOS / Contact</a>
  <a href="map.php">🗺 View Alert Map</a>
</nav>

<?php
include 'db.php';
$tickerResult = $conn->query("SELECT type, location, message FROM alerts ORDER BY date_issued DESC LIMIT 3");
?>
<div class="ticker">
  <marquee behavior="scroll" direction="left">
    <?php while ($row = $tickerResult->fetch_assoc()): ?>
      ⚠️ <?= htmlspecialchars($row['type']) ?> in <?= htmlspecialchars($row['location']) ?> – <?= htmlspecialchars($row['message']) ?> &nbsp;&nbsp;&nbsp;
    <?php endwhile; ?>
  </marquee>
</div>


<header>
  <div class="branding">
    <img src="logo.png" alt="Busia County Logo" class="logo">
    <h1>Busia County Disaster Alert System</h1>
  </div>
</header>

<section class="form-section">
  <h2>Welcome to the Official Busia Alert System</h2>
  <p>
    This platform helps residents of Busia County stay informed about critical events such as
    floods, disease outbreaks, and other emergencies.
  </p>
  <p>
    You can view the latest alerts or subscribe to receive updates via SMS.
  </p>
</section>

<section class="form-section">
  <p><strong>Total Subscribers:</strong> <?= $totalSubscribers ?> residents across Busia County.</p>
</section>

<section class="form-section">
  <h2>Get Alerts by SMS</h2>
  <form action="register.php" method="POST">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="text" name="phone" placeholder="Phone (07XXXXXXXX)" required>
    <select name="ward" required>
      <option value="">-- Select Ward --</option>
      <option value="Butula">Butula</option>
      <option value="Matayos">Matayos</option>
      <option value="Nambale">Nambale</option>
      <option value="Funyula">Funyula</option>
    </select>
    <button type="submit">Subscribe</button>
  </form>
</section>

</body>
</html>
