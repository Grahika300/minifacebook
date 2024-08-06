const http = require('http');
const fs = require('fs');
const socketio = require('socket.io');

const port = 8080;

const httpServer = http.createServer(httphandler);
const io = socketio(httpServer);

httpServer.listen(port);
console.log("HTTP server is listening on port " + port);

function httphandler(request, response) {
  response.writeHead(200); // 200 OK 
  // Ensure you have the front-end UI client.html
var clientUI_stream = fs.createReadStream('./client.html');
  clientUI_stream.pipe(response);
}

io.on('connection', function (socketclient) {
  console.log("A new socket.IO client is connected: " +
    socketclient.client.conn.remoteAddress + ": " +
    socketclient.id);

  socketclient.on("message", (data) => {
    console.log("Received data: " + data);
    // Emit the received message to all clients
    io.emit("message", data);
  });
});
