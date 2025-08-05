<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Alert Map | Busia County</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body { margin: 0; font-family: Arial, sans-serif; }
    #map { height: 100vh; width: 100%; }
  </style>
</head>
<body>

<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
  const map = L.map('map').setView([0.456, 34.108], 9);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  fetch('get-alerts.php')
    .then(res => res.json())
    .then(data => {
      data.forEach(alert => {
        L.marker([alert.latitude, alert.longitude])
          .addTo(map)
          .bindPopup(`<b>${alert.type}</b><br>${alert.message}<br><i>${alert.ward}</i>`);
      });
    })
    .catch(err => console.error('Map load error:', err));
</script>

</body>
</html>
