<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/chat/index.css"/>
  <title>Chat</title>
</head>
<body>
  <?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  ?>
  <div class="chat-container">
    <div class="chat-header">
      <h2>Chat de Suporte</h2>
    </div>
    <div class="chat" id="chat-messages">
      <!-- Mensagens serão preenchidas aqui usando fetch -->
    </div>
    <div class="input-container">
      <input type="text" id="message-input" placeholder="Digite sua mensagem..." autocomplete="off">
      <button id="send-button">Enviar</button>
    </div>
  </div>

  <script>
    const username = "<?php echo $_SESSION["username"];?>";
  </script>
  <script src="../chat/event/index.js"></script>
</body>
</html>
