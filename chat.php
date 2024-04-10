<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Verwerk het verzenden van berichten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['message'])) {
        // Verwerk het verzenden van berichten
        $message = $_POST['message'];
        // Voorbeeld: Toon het bericht (voeg het toe aan een bestand, database, enz.)
        file_put_contents('messages.txt', $_SESSION['username'] . ': ' . $message . PHP_EOL, FILE_APPEND);
        // Stuur HTTP 200 OK-status
        http_response_code(200);
        exit();
    }
}

// Haal de huidige berichten op
$messages = file('messages.txt');

// Laatste 10 berichten weergeven
$messages = array_slice($messages, -10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <h1>Chat</h1>
  <p>Welkom, <?php echo $_SESSION['username']; ?>!</p>
  <div id="messages">
    <?php foreach ($messages as $message): ?>
      <p><?php echo htmlspecialchars($message); ?></p>
    <?php endforeach; ?>
  </div>
  <form id="messageForm" action="chat.php" method="post">
    <label for="message">Bericht:</label>
    <input type="text" id="message" name="message" required>
    <button type="submit">Verstuur</button>
  </form>

  <script>
    $(document).ready(function() {
      // Functie om berichten op te halen via AJAX
      function fetchMessages() {
        $.ajax({
          url: 'messages.txt', // URL van het bestand met berichten
          cache: false,
          success: function(data) {
            // Voeg nieuwe berichten toe aan de chatinterface
            $('#messages').html(data);
          },
          complete: function() {
            // Herhaal de functie elke 3 seconden
            setTimeout(fetchMessages, 3000);
          }
        });
      }

      // Start het periodiek ophalen van berichten
      fetchMessages();

      // Verstuur bericht via AJAX wanneer het formulier wordt ingediend
      $('#messageForm').submit(function(event) {
        event.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(), function(response) {
          // Wis het invoerveld na het verzenden van het bericht
          $('#message').val('');
        });
      });
    });
  </script>
</body>
</html>
