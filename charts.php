<!DOCTYPE html>
<html>
<head>
<title>WiFi Analytics</title>
<link rel="stylesheet" href="style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header>BISHOP BARHAM WIFI MANAGEMENT SYSTEM</header>

<div class="container">
<h2>WiFi Usage by Role</h2>
<canvas id="usageChart"></canvas>
</div>

<script>
fetch("chart_data.php")
.then(r => r.json())
.then(data => {
    new Chart(document.getElementById("usageChart"), {
        type: "bar",
        data: {
            labels: data.map(x => x.role),
            datasets: [{
                label: "Total Data Used (MB)",
                data: data.map(x => x.total)
            }]
        }
    });
});
</script>

</body>
</html>
