// Sample data for demonstration purposes
const userChats = {
  Emily: [
    "Hey there!",
    "How are you?",
    "This is a sent message from You.",
    "Feel free to chat!",
  ],
  Nomini: [
    "Hi!",
    "I'm doing well, thank you.",
    "This is a received message from Nomini.",
    "Sure, let's chat!",
  ],
};

function loadChat(user) {
  var chatMessages = document.getElementById("chatMessages");
  chatMessages.innerHTML = "";

  if (userChats[user]) {
    userChats[user].forEach((message, index) => {
      var messageContainer = document.createElement("div");
      messageContainer.className =
        user === "You" ? "sent-message" : "received-message";

      var messageText = document.createElement("span");
      messageText.textContent = message;

      messageContainer.appendChild(messageText);
      chatMessages.appendChild(messageContainer);
    });
  }
}

function sendMessage() {
  var messageInput = document.getElementById("messageInput");
  var messageText = messageInput.value;

  if (messageText.trim() !== "") {
    var chatMessages = document.getElementById("chatMessages");
    var newMessage = document.createElement("div");
    newMessage.className = "message";
    newMessage.textContent = messageText;
    chatMessages.appendChild(newMessage);

    var selectedUser = document.querySelector(".navbar li.active").textContent;
    if (!userChats[selectedUser]) {
      userChats[selectedUser] = [];
    }
    userChats[selectedUser].push(messageText);

    messageInput.value = "";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var navbarItems = document.querySelectorAll(".navbar li");
  navbarItems.forEach((item) => {
    item.addEventListener("click", function () {
      navbarItems.forEach((i) => i.classList.remove("active"));
      item.classList.add("active");
      var selectedUser = item.textContent;
      loadChat(selectedUser);
    });
  });

  var initialUser = document.querySelector(".navbar li").textContent;
  loadChat(initialUser);
});
