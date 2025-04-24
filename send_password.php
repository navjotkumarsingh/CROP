<?php
// Mail settings
$host = 'localhost';
$dbname = 'Signup';
$dbUser = 'root';
$dbPass = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbUser, $dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch user with email
        $stmt = $pdo->prepare("SELECT * FROM Information WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $to = $user['email'];
            $subject = "Your Password Recovery";
            $message = "Hello " . $user['username'] . ",\n\nYour password is: " . $user['plain_password'];
            $headers = "From: no-reply@yourdomain.com";

            if (mail($to, $subject, $message, $headers)) {
                echo "<script>alert('Password has been sent to your email.'); window.location.href='login.html';</script>";
            } else {
                echo "<script>alert('Failed to send email. Please try again.'); window.location.href='forgot_password.html';</script>";
            }
        } else {
            echo "<script>alert('Email not found.'); window.location.href='forgot_password.html';</script>";
        }

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>