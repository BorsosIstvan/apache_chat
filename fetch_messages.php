<?php
// Lees berichten uit het JSON-bestand
$messages = [];
if (file_exists('/home/pi/poci/apache_chat/messages.json')) {
    $messages = json_decode(file_get_contents('/home/pi/poci/apache_chat/messages.json'), true);
}

// Retourneer berichten als JSON
echo json_encode($messages);
?>
