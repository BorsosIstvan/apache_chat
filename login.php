<?php
session_start();

if (isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
    header('Location: chat.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <h1>Login</h1>
  <form action="login.php" method="post">
    <label for="username">Gebruikersnaam:</label>
    <input type="text" id="username" name="username" required>
    <button type="submit">Inloggen</button>
  </form>
</body>
</html>
