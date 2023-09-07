<?php
require_once '../../methods/chat_messages.php';
use Models\Connect\chat_messages;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $message = $_POST['message'];
    $username = $_SESSION["username"]; // Pode definir o nome do usuário aqui

    $chat = new chat_messages();
    $chat->save_msg($username, $message);
    
    // Opcional: Responder com a mensagem recém-enviada
    echo json_encode(['message' => $message, 'username' => $username]);
}

?>
