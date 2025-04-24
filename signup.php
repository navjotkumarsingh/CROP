<?php
// Database connection variables
$host = 'localhost';
$dbname = 'Signup';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $user = $_POST['username'];
        $pass = $_POST['password'];

        if (!empty($email) && !empty($user) && !empty($pass)) {
            $sql = "INSERT INTO Information (email, username, password) VALUES (:email, :username, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':email' => $email,
                ':username' => $user,
                ':password' => password_hash($pass, PASSWORD_DEFAULT)
            ]);

            // Show popup on success
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Signup Success</title>
                <script src="https://cdn.tailwindcss.com"></script>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <style>
                    .popup {
                        animation: fadeInUp 0.5s ease-out forwards;
                    }

                    @keyframes fadeInUp {
                        from {
                            opacity: 0;
                            transform: translateY(50px);
                        }
                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                </style>
            </head>
            <body class="bg-gray-900 flex items-center justify-center min-h-screen text-white">
                <div class="popup bg-white text-center p-8 rounded-2xl shadow-xl max-w-sm w-full text-gray-800">
                    <div class="flex items-center justify-center mb-4">
                        <div class="bg-green-500 rounded-full p-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold mb-2">Signup Successful!</h2>
                    <p class="mb-4">You have been registered successfully.</p>
                    <a href="login.html" class="inline-block bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition">Go to Login</a>
                </div>

                <script>
                    setTimeout(() => {
                        window.location.href = "login.html";
                    }, 4000); // Auto redirect in 4 seconds
                </script>
            </body>
            </html>
            <?php
            exit();
        } else {
            echo "All fields are required.";
        }
    }
} catch (PDOException $e) {
    die("DB error: " . $e->getMessage());
}
?>