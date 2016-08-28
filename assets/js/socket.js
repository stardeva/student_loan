$(document).ready(function(){
  var host = '192.168.0.63';
  var port = 3000;
  var uri = "/Chat-Using-WebSocket-and-PHP-Socket-master/server.php"
  var wsUri = "ws://" + host + ':' + port + uri;
  websocket = new WebSocket(wsUri); 
  
  websocket.onopen = function(ev) {
    $('#message_box').append("<div class=\"system_msg\">Connected!</div>");
    console.log("Socket connected!");
  }

  websocket.onmessage = function(ev) {
    var msg = JSON.parse(ev.data);

    console.log('Message:');
    console.log(msg);
  };
  
  websocket.onerror = function(ev) {
    
  };
  websocket.onclose = function(ev){
    console.log('Scoket connection closed');
  };
});