<!-- upload.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Upload Multi-Temporal Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

<?php include('navbar.php'); ?>

<section class="py-16 px-6 min-h-screen">
  <div class="max-w-xl mx-auto">
    <h2 class="text-4xl font-bold text-lime-400 mb-6">Upload Multi-Temporal Data</h2>
    <form action="analysed.html" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
      <input type="file" name="crop_data" class="form-control bg-gray-700 text-white" required>
      <button type="submit" class="btn btn-outline-light">Analyze</button>
    </form>
  </div>
</section>

</body>
</html>