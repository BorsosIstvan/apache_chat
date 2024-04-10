<?php
// Lees berichten uit het JSON-bestand
$messages = file_get_contents('messages.json');
echo $messages;
?>
