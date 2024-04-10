<?php
// Lees berichten uit het JSON-bestand
$messages = [];
if (!file_exists('messages.json')) {
    file_put_contents('messages.json', '[]');
if (file_exists('messages.json')) {
    $messages = json_decode(file_get_contents('messages.json'), true);
}

// Retourneer berichten als JSON
echo json_encode($messages);
?>
