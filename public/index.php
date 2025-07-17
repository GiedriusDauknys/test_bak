<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Įmonių statistika</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

<h1>Įmonių sąrašas</h1>

<?php
// Paprasti testiniai duomenys
$companies = [
    ["name" => "UAB Alfa", "city" => "Vilnius", "profit" => 12000],
    ["name" => "MB Beta", "city" => "Kaunas", "profit" => -3000],
    ["name" => "UAB Gama", "city" => "Klaipėda", "profit" => 0],
    ["name" => "UAB Delta", "city" => "Vilnius", "profit" => 800],
    ["name" => "MB Omega", "city" => "Kaunas", "profit" => -1200],
];

// Skaičiavimai
$profitable = 0;
$loss = 0;

foreach ($companies as $c) {
    if ($c["profit"] > 0) $profitable++;
    else $loss++;
}
?>

<table>
    <tr>
        <th>Pavadinimas</th>
        <th>Miestas</th>
        <th>Pelnas (€)</th>
    </tr>
    <?php foreach ($companies as $company): ?>
        <tr>
            <td><?= htmlspecialchars($company["name"]) ?></td>
            <td><?= htmlspecialchars($company["city"]) ?></td>
            <td><?= $company["profit"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Pelnas / Nuostolis</h2>
<canvas id="profitChart" width="400" height="200"></canvas>

<script>
    const ctx = document.getElementById('profitChart');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Pelningos įmonės', 'Nuostolingos įmonės'],
            datasets: [{
                data: [<?= $profitable ?>, <?= $loss ?>],
                backgroundColor: ['#4CAF50', '#F44336']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

</body>
</html>
