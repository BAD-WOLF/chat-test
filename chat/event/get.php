<?php
require_once __DIR__.'/../../methods/chat_messages.php';
use Models\Connect\chat_messages;

$chat = new chat_messages();
$messages = $chat->get_msg();
echo json_encode($messages);
?>