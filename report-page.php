<!-- report-page.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Download Report - Standalone</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

  <!-- Optional: Your own custom top bar -->
  <header class="bg-gray-800 py-4 px-6 text-center">
    <h1 class="text-3xl font-bold text-lime-400">Standalone Report Page</h1>
    <p class="text-sm text-gray-300">Download your crop cycle analysis report</p>
  </header>

  <!-- Hero Section -->
  <section class="py-16 px-6 text-center">
    <h2 class="text-4xl font-bold text-lime-400 mb-4">Download Your Analysis Report</h2>
    <p class="mb-6">You can download a summary of your crop cycle analysis here.</p>
  </section>

  <!-- PDF Download List -->
  <section class="bg-gray-100 py-12 px-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8">
      <h3 class="text-2xl font-semibold text-center mb-6 text-gray-800">Available PDF Reports</h3>

      <?php
      // Array of PDF filenames
      $pdfFiles = ["Crop.pdf", "Weather.pdf", "Irrigation.pdf", "Land-Patern.pdf", "Cultivation.pdf"];

      // Loop to create download buttons
      foreach ($pdfFiles as $file) {
          echo '
          <div class="flex items-center justify-between bg-gray-50 p-4 rounded mb-4 shadow-sm">
            <span class="text-lg font-medium text-gray-800">' . htmlspecialchars($file) . '</span>
            <a href="pdfs/' . urlencode($file) . '" download
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
              Download PDF
            </a>
          </div>';
      }
      ?>
    </div>
  </section>
</body>
</html>