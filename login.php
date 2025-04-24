<?php
session_start();

// Database connection settings
$host = 'localhost';
$dbname = 'Signup';
$dbUser = 'root';
$dbPass = '';

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle form submissions
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // LOGIN BLOCK
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Check user by email
            $stmt = $pdo->prepare("SELECT * FROM Information WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];

                // Show success popup and redirect after 4 seconds
                echo '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>Login Success</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 0;
                            height: 100vh;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            background-color: #1a1a2e;
                            font-family: Arial, sans-serif;
                        }
                        .popup {
                            background-color: #fff;
                            padding: 30px;
                            border-radius: 15px;
                            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                            text-align: center;
                            width: 300px;
                            position: relative;
                        }
                        .popup .tick {
                            width: 60px;
                            height: 60px;
                            margin: 0 auto 20px;
                            background-color: #4BB543;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }
                        .popup .tick::before {
                            content: "✓";
                            font-size: 36px;
                            color: white;
                        }
                        .popup h2 {
                            color: #4BB543;
                            margin: 10px 0 5px;
                        }
                        .popup p {
                            color: #333;
                            margin: 0;
                        }
                    </style>
                    <script>
                        setTimeout(function() {
                            window.location.href = "nav.html";
                        }, 4000);
                    </script>
                </head>
                <body>
                    <div class="popup">
                        <div class="tick"></div>
                        <h2>Login Successful!</h2>
                        <p>Redirecting to home...</p>
                    </div>
                </body>
                </html>';
                exit();
            } else {
                echo "<script>alert('Invalid email or password'); window.location.href='login.html';</script>";
                exit();
            }
        }

        // FORGOT PASSWORD BLOCK
        if (isset($_POST['forgot_password'])) {
            $email = $_POST['email'];

            $stmt = $pdo->prepare("SELECT * FROM Information WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $to = $user['email'];
                $subject = "Password Recovery - Your Account";
                $message = "Hello " . $user['username'] . ",\n\nHere is your password: " . $user['plain_password'] . "\n\nPlease consider changing your password after login.";
                $headers = "From: no-reply@yourdomain.com";

                if (mail($to, $subject, $message, $headers)) {
                    echo "<script>alert('Password sent to your email.'); window.location.href='login.html';</script>";
                } else {
                    echo "<script>alert('Failed to send email.'); window.location.href='login.html';</script>";
                }
            } else {
                echo "<script>alert('Email not found.'); window.location.href='login.html';</script>";
            }

            exit();
        }
    }

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>