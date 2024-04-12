const WebSocket = require('ws');

// Create a WebSocket server instance
const wss = new WebSocket.Server({ port: 8080 });

// Event listener for when a client connects
wss.on('connection', function connection(ws) {
  console.log('Client connected');

  // Event listener for when a message is received from a client
  ws.on('message', function incoming(message) {
    console.log('Received:', message);
    
    // Broadcast the received message to all clients
    wss.clients.forEach(function each(client) {
      if (client !== ws && client.readyState === WebSocket.OPEN) {
        client.send(message);
      }
    });
  });
  
  // Event listener for when a client disconnects
  ws.on('close', function close() {
    console.log('Client disconnected');
  });
});
