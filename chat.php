<?php
// Check of het verzoek een POST-verzoek is met een bericht
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"])) {
    // Ontvang de gebruikersnaam en het bericht van de client
    $username = $_POST["username"];
    $message = $_POST["message"];
    // Voeg het bericht toe aan het chatbestand
    file_put_contents("chat.txt", json_encode(["username" => $username, "message" => $message]) . PHP_EOL, FILE_APPEND);
}

// Laad de berichten uit het chatbestand en stuur ze naar de client
$chatContents = file_get_contents("chat.txt");
// Parse de berichten als JSON
$messages = [];
$lines = explode(PHP_EOL, $chatContents);
foreach ($lines as $line) {
    if (!empty($line)) {
        $messageData = json_decode($line, true);
        if ($messageData) {
            $messages[] = $messageData;
        }
    }
}
// Stuur de berichten terug naar de client als JSON
header("Content-Type: application/json");
echo json_encode($messages);
?>

