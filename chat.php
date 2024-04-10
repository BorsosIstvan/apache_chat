<?php
// Check of het verzoek een POST-verzoek is met een bericht
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"])) {
    // Ontvang het bericht van de client
    $message = $_POST["message"];
    // Voeg het bericht toe aan het chatbestand
    file_put_contents("chat.txt", $message . PHP_EOL, FILE_APPEND);
}

// Laad de berichten uit het chatbestand en stuur ze naar de client
$chatContents = file_get_contents("chat.txt");
echo $chatContents;
?>
