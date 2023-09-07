document.addEventListener('DOMContentLoaded', function() {
  loadMessages();

  document.querySelector('#send-button').addEventListener('click', function() {
    sendMessage();
  });

  // Carrega mensagens inicialmente a cada 1 segundos
  setInterval(loadMessages, 1000);
});

function loadMessages() {
  fetch('event/get.php')
    .then(response => response.json())
    .then(data => {
      console.log(data);
      const chatMessages = document.querySelector('#chat-messages');
      chatMessages.innerHTML = ''; // Limpa as mensagens existentes
      
      data.forEach(message => {
        let css = 'received';
        if(message.username == username){
          css = 'send';
        }
        const messageDiv = document.createElement('div');
        // aq ele vai resceber oq vem do php, eu tenho que achar um jeito de variar entre sent e received
        // no entanto ta tendo so received
        messageDiv.className = 'message ' + css;
        messageDiv.innerHTML = `
          <span class="message-sender">${message.username}:</span>
          ${message.msg}
          <span class="message-time">${message.msgTime}</span>
        `;
        chatMessages.appendChild(messageDiv);
      });
    })
    .catch(error => {
      console.error('Erro ao carregar mensagens:', error);
    });
}

function sendMessage() {
  const message = document.querySelector('#message-input').value;
  
  if (message.trim() !== '') {
    fetch('event/send.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `message=${encodeURIComponent(message)}`,
    })
    .then(response => response.json())
    .then(data => {
      document.querySelector('#message-input').value = '';
      loadMessages();
    })
    .catch(error => {
      console.error('Erro ao enviar mensagem:', error);
    });
  }
}