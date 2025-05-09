<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=quick-pc1", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        if ($password !== $confirmPassword) {
            $message = "Passwords do not match.";
        } elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/', $password)) {
            $message = "Password must be at least 8 characters, with one uppercase letter, one number, and one special character.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashedPassword]);

            // OPTIONAL: log user in immediately
            $_SESSION["username"] = $username;

            // ✅ Redirect to home after successful registration
            header("Location: /quick-pc1/home.php");
            exit;
        }
    } catch (PDOException $e) {
        if (str_contains($e->getMessage(), 'Integrity constraint')) {
            $message = "Username or email already exists.";
        } else {
            $message = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('https://i.gifer.com/J4o.gif') repeat;
      animation: moveBackground 30s linear infinite;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    @keyframes moveBackground {
      from { background-position: 0 0; }
      to { background-position: -2000px 0; }
    }
    .container {
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      padding: 30px;
      width: 350px;
      text-align: center;
    }
    h2 { margin-bottom: 20px; color: #333; font-size: 24px; }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ddd;
      box-sizing: border-box;
      font-size: 16px;
    }
    button {
      width: 100%;
      padding: 12px;
      background-color: #4CAF50;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    button:hover {
      background-color: #45a049;
    }
    .message {
      margin-top: 10px;
      font-size: 14px;
    }
    .error { color: red; }
    .success { color: green; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Create Your Account</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
      <button type="submit">Register</button>
    </form>
    <?php if (!empty($message)): ?>
      <p class="message <?= str_contains($message, 'success') ? 'success' : 'error' ?>">
        <?= htmlspecialchars($message) ?>
      </p>
    <?php endif; ?>
  </div>
</body>
</html>
