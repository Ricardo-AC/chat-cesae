let pageUsername = document.getElementById('username').innerText;
$("#msgBox").scrollTop($("#msgBox")[0].scrollHeight);

Pusher.logToConsole = true;

var pusher = new Pusher('6c723a6f8599163886eb', {
  cluster: 'eu'
});

var channel = pusher.subscribe(mychannel);
channel.bind('messages', function (data) {
  let message = JSON.stringify(data.message);
  let username = JSON.stringify(data.username);
  let image_url = JSON.stringify(data.image_url);
  username = username.slice(1, username.length - 1);
  message = message.slice(1, message.length - 1);
  image_url = image_url.slice(1, image_url.length - 1);
  if (message != "" | image_url != "") {
    appendMsg(message, image_url, username);
    $("#msgBox").scrollTop($("#msgBox")[0].scrollHeight);
  }
});

function appendMsg(message, image_url, username) {
  let textMsg;
  let div = document.createElement('div');
  div.id = 'id';

  if (pageUsername == username) {
    div.className = 'bubble recipient ';
    textMsg = message;
  }
  else {
    div.className = 'bubble sender ';
    textMsg = username + ": " + message;
    const msgSound = new Audio("sounds/msgSound.mp3");
    msgSound.play();
  }
  let img = document.createElement("img");
  img.src = image_url;
  img.style.width = "100%";
  div.appendChild(img);
  let text = document.createTextNode(textMsg);
  div.appendChild(text);
  const discussionBox = document.querySelector('#discussionBox');
  discussionBox.appendChild(div);
}

formElem.onsubmit = async (e) => {
  event.preventDefault();

  let response = await fetch('server.php', {
    method: 'POST',
    body: new FormData(formElem)
  });
  document.getElementById("msg").value = "";
  document.getElementById("upload-photo").value = ""
};
let emojiPicker = document.querySelector('emoji-picker')
emojiPicker.addEventListener('emoji-click', event => {
  document.getElementById("msg").value = document.getElementById("msg").value + event.detail.unicode
});





