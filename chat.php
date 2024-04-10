<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['message'])) {
        // Verwerk het verzenden van berichten
        $message = $_POST['message'];
        // Toon het bericht (voorbeeld: echo naar de pagina)
        echo '<p><strong>' . $_SESSION['username'] . ':</strong> ' . htmlspecialchars($message) . '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
</head>
<body>
  <h1>Chat</h1>
  <p>Welkom, <?php echo $_SESSION['username']; ?>!</p>
  <form action="chat.php" method="post">
    <label for="message">Bericht:</label>
    <input type="text" id="message" name="message" required>
    <button type="submit">Verstuur</button>
  </form>
</body>
</html>
