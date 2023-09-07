
const venom = require('venom-bot');

venom.create(
  'sessionName',
  (base64Qrimg, asciiQR, attempts) => {
    console.log('Number of attempts to read the qrcode:', attempts);
    console.log('Terminal qrcode:\n', asciiQR); // Exibir o QR code no terminal
  },
  (statusSession) => {
    console.log('Status Session:', statusSession);
  },
  {
    logQR: false,
    autoClose: 60000,
  },
  (browser, waPage) => {
    console.log('Browser PID:', browser.process().pid);
    waPage.screenshot({ path: 'screenshot.png' });
  }
)
.then((client) => {
  client.onMessage(async (message) => {
    if (message.body === '!ping') {
      await client.sendText(message.from, 'Pong! 🏓'); // Responder com "Pong!"
    }
  });
})
.catch((error) => {
  console.log(error);
});
