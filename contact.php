<?php
$host = 'localhost';      // Usually localhost
$db = 'CONTACT';          // Your database name
$user = 'root';           // Your DB username
$pass = '';               // Your DB password

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    // Create connection
    $conn = new mysqli($host, $user, $pass, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert into Message table
    $stmt = $conn->prepare("INSERT INTO Message (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Contact Saved Successfully!'); window.location.href = 'nav.html';</script>";
    } else {
        echo "<script>alert('Error saving contact. Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us</title>
  <link href="https://cdn.tailwindcss.com" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #1a1a2e;
      font-family: Arial, sans-serif;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .contact-box {
      width: 350px;
      background: rgba(0, 0, 0, 0.5);
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
      position: relative;
      text-align: center;
    }

    .avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background-color: #fff;
      padding: 5px;
      position: absolute;
      top: -50px;
      left: 50%;
      transform: translateX(-50%);
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
    }

    h1 {
      margin-top: 60px;
      margin-bottom: 20px;
      font-size: 24px;
      color: #fff;
    }

    .contact-box p {
      text-align: left;
      margin: 10px 0 5px;
      font-weight: bold;
      color: #fff;
    }

    .contact-box input[type="text"],
    .contact-box input[type="email"],
    .contact-box textarea {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 5px;
      background-color: #fff;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .contact-box button {
      width: 100%;
      padding: 12px;
      border-radius: 25px;
      font-weight: bold;
      border: 2px solid #98db1f;
      background: transparent;
      color: #fff;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }

    .contact-box button span {
      background: #98db1f;
      height: 100%;
      width: 0;
      border-radius: 25px;
      position: absolute;
      left: 0;
      bottom: 0;
      z-index: -1;
      transition: 0.5s;
    }

    .contact-box button:hover span {
      width: 100%;
    }

    .contact-box button:hover {
      border: none;
    }
  </style>
</head>
<body>

  <div class="contact-box">
    <h1>Contact Us</h1>
    <form method="POST" action="contact.php">
      <p>Your Name</p>
      <input type="text" name="name" placeholder="Enter your name" required>
      <p>Your Email</p>
      <input type="email" name="email" placeholder="Enter your email" required>
      <p>Message</p>
      <textarea name="message" rows="4" placeholder="Your message" required></textarea>
      <button type="submit"><span></span>Send Message</button>
    </form>
  </div>

</body>
</html>