<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ontvang en filter de gebruikersnaam en het bericht
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    
    // Controleer of zowel de gebruikersnaam als het bericht niet leeg zijn
    if (!empty($username) && !empty($message)) {
        // Lees de bestaande berichten uit het JSON-bestand
        $messages = [];
        if (file_exists('messages.json')) {
            $messages = json_decode(file_get_contents('messages.json'), true);
        }
        
        // Voeg het nieuwe bericht toe aan de lijst van berichten
        $newMessage = [
            'username' => $username,
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        $messages[] = $newMessage;
        
        // Schrijf de bijgewerkte lijst van berichten terug naar het JSON-bestand
        file_put_contents('messages.json', json_encode($messages, JSON_PRETTY_PRINT));
    }
}
?>
