if (!window.WebSocket) {
    alert("Ваш браузер не поддерживает цеб-сокеты");
}

// var webSocket = new WebSocket("ws://front.task.local/chat:8080");
var webSocket = new WebSocket("ws://front.task.local:8080");

webSocket.onmessage = function (event) {
    var data = event.data;
    var messageContainer = document.createElement('div');
    var textNode = document.createTextNode(data);
    messageContainer.appendChild(textNode);
    document.getElementById("root_chat")
        .appendChild(messageContainer);
}


document.getElementById("chat_form")
    .addEventListener('submit', function (event) {
        event.preventDefault();
        var textMessage = this.message.value;
        webSocket.send(textMessage);
        event.preventDefault();
        return false;
    });