<?php
$crop = $_POST['crop'] ?? '';
$soil = $_POST['soil'] ?? '';
$weather = $_POST['weather'] ?? '';

// Expanded recommendations with soil and weather suitability
$recommendations = [
    "wheat" => [
        "fertilizer" => "Nitrogen, Phosphorus, Potash",
        "steps" => "Sowing → Irrigation → Cutting → Threshing",
        "season" => "Rabi (Winter)",
        "soil" => ["loamy", "clayey"],
        "weather" => ["cold"]
    ],
    "rice" => [
        "fertilizer" => "Urea, DAP (Di-Ammonium Phosphate)",
        "steps" => "Sowing → Transplanting → Harvesting → Threshing",
        "season" => "Kharif (Monsoon)",
        "soil" => ["alluvial", "clayey"],
        "weather" => ["humid", "rainy"]
    ],
    "corn" => [
        "fertilizer" => "Nitrogen-rich fertilizers",
        "steps" => "Sowing → Irrigation → Harvesting → Shelling",
        "season" => "Kharif or Rabi (depending on region)",
        "soil" => ["loamy", "sandy"],
        "weather" => ["hot"]
    ],
    "sugarcane" => [
        "fertilizer" => "Nitrogen, Potash, Organic manure",
        "steps" => "Planting → Irrigation → Earthing → Harvesting",
        "season" => "Spring or Autumn",
        "soil" => ["black", "alluvial"],
        "weather" => ["humid", "hot"]
    ],
    "cotton" => [
        "fertilizer" => "Phosphorous, Potash, Organic compost",
        "steps" => "Sowing → Weeding → Picking → Ginning",
        "season" => "Kharif (Summer)",
        "soil" => ["black", "red"],
        "weather" => ["dry", "hot"]
    ],
    "soybean" => [
        "fertilizer" => "Potassium, Nitrogen, Phosphate",
        "steps" => "Sowing → Irrigation → Harvesting → Drying",
        "season" => "Kharif",
        "soil" => ["loamy", "black"],
        "weather" => ["hot", "humid"]
    ],
    "barley" => [
        "fertilizer" => "Nitrogen, Phosphorus, Potash",
        "steps" => "Ploughing → Sowing → Irrigation → Harvesting",
        "season" => "Rabi (Winter)",
        "soil" => ["loamy", "clayey"],
        "weather" => ["cold"]
    ],
    "potatoes" => [
        "fertilizer" => "Nitrogen, Potassium, Phosphorus",
        "steps" => "Sowing → Irrigation → Earthing → Harvesting",
        "season" => "Rabi",
        "soil" => ["sandy", "loamy"],
        "weather" => ["cool", "cold"]
    ],
    "tomatoes" => [
        "fertilizer" => "Nitrogen, Phosphorus, Potassium",
        "steps" => "Sowing → Transplanting → Irrigation → Harvesting",
        "season" => "Kharif or Rabi",
        "soil" => ["loamy", "sandy"],
        "weather" => ["warm", "hot"]
    ],
    "onions" => [
        "fertilizer" => "Nitrogen, Potash, Phosphorus",
        "steps" => "Sowing → Irrigation → Harvesting → Drying",
        "season" => "Rabi or Kharif",
        "soil" => ["loamy", "alluvial"],
        "weather" => ["mild", "dry"]
    ],
    "carrots" => [
        "fertilizer" => "Phosphorus, Potash",
        "steps" => "Sowing → Irrigation → Harvesting",
        "season" => "Winter",
        "soil" => ["loamy", "sandy"],
        "weather" => ["cool"]
    ],
    "peas" => [
        "fertilizer" => "Phosphorus, Potassium",
        "steps" => "Sowing → Irrigation → Harvesting",
        "season" => "Rabi",
        "soil" => ["loamy"],
        "weather" => ["cool"]
    ],
    "spinach" => [
        "fertilizer" => "Nitrogen, Organic compost",
        "steps" => "Sowing → Irrigation → Harvesting",
        "season" => "Winter",
        "soil" => ["loamy", "alluvial"],
        "weather" => ["cool"]
    ],
    "chickpeas" => [
        "fertilizer" => "Phosphorus, Potash",
        "steps" => "Sowing → Irrigation → Harvesting → Threshing",
        "season" => "Rabi",
        "soil" => ["loamy", "black"],
        "weather" => ["dry", "cool"]
    ],
    "lentils" => [
        "fertilizer" => "Phosphorus",
        "steps" => "Sowing → Irrigation → Harvesting → Threshing",
        "season" => "Rabi",
        "soil" => ["loamy"],
        "weather" => ["cool"]
    ],
    "mustard" => [
        "fertilizer" => "Nitrogen, Phosphorus",
        "steps" => "Sowing → Irrigation → Harvesting",
        "season" => "Rabi",
        "soil" => ["alluvial", "loamy"],
        "weather" => ["cool"]
    ],
    "groundnuts" => [
        "fertilizer" => "Calcium, Phosphorus, Potassium",
        "steps" => "Sowing → Irrigation → Harvesting → Drying",
        "season" => "Kharif or Summer",
        "soil" => ["sandy", "loamy"],
        "weather" => ["hot"]
    ],
    "bananas" => [
        "fertilizer" => "Nitrogen, Potassium, Magnesium",
        "steps" => "Planting → Irrigation → Fertilization → Harvesting",
        "season" => "Year-round (preferably monsoon)",
        "soil" => ["alluvial", "loamy"],
        "weather" => ["hot", "humid"]
    ],
    "apples" => [
        "fertilizer" => "Nitrogen, Phosphorus, Potassium",
        "steps" => "Planting → Pruning → Irrigation → Harvesting",
        "season" => "Winter (temperate regions)",
        "soil" => ["loamy"],
        "weather" => ["cold"]
    ],
    "grapes" => [
        "fertilizer" => "Phosphorus, Potassium, Magnesium",
        "steps" => "Planting → Pruning → Training → Harvesting",
        "season" => "Spring/Summer",
        "soil" => ["sandy", "loamy"],
        "weather" => ["hot", "dry"]
    ]
];

$advice = $recommendations[$crop] ?? null;
$isSuitable = $advice && in_array($soil, $advice['soil']) && in_array($weather, $advice['weather']);

$soilNote = '';
$weatherNote = '';

if ($advice) {
    if (!in_array($soil, $advice['soil'])) {
        $soilNote = "Note: Selected soil ($soil) is not ideal for $crop. Recommended: " . implode(", ", $advice['soil']);
    }
    if (!in_array($weather, $advice['weather'])) {
        $weatherNote = "Note: Selected weather ($weather) may not support optimal growth. Recommended: " . implode(", ", $advice['weather']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Crop Analysis Result</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f0fff0;
    }
    .navbar {
      background-color: #355e3b;
    }
    .navbar-brand, .nav-link, .btn {
      color: white !important;
    }
    .result-card {
      max-width: 700px;
      margin: 50px auto;
      background: white;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    footer {
      background-color: #355e3b;
      color: white;
      padding: 10px 0;
      text-align: center;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Smart Crop Advisor</a>
    <div class="d-flex ms-auto">
      <a href="nav.html" class="btn btn-outline-light me-2">Home</a>
      <a href="analysed.html" class="btn btn-outline-light">Back</a>
    </div>
  </div>
</nav>

<div class="container result-card">
  <h2 class="text-success text-center mb-4">Farming Recommendation</h2>

  <?php if ($advice): ?>
    <div class="border rounded p-4 bg-light">
      <p><strong>Recommended Fertilizer:</strong> <?= $advice['fertilizer'] ?></p>
      <p><strong>Farming Steps:</strong> <?= $advice['steps'] ?></p>
      <p><strong>Best Season to Grow:</strong> <?= $advice['season'] ?></p>

      <?php if ($soilNote): ?>
        <div class="alert alert-warning mt-3"><?= $soilNote ?></div>
      <?php endif; ?>

      <?php if ($weatherNote): ?>
        <div class="alert alert-warning"><?= $weatherNote ?></div>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-danger text-center">No recommendations available for the selected crop.</div>
  <?php endif; ?>
</div>


<footer>
  <p>&copy; 2025 Smart Crop Advisor. All Rights Reserved.</p>
</footer>

</body>
</html>