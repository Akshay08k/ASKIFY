document.addEventListener("DOMContentLoaded", () => {
  fetchUsers();
});

function fetchUsers() {
  fetch("/messages/users")
    .then((response) => response.json())
    .then((users) => {
      const userList = document.getElementById("userList");
      userList.innerHTML = "";
      users.forEach((user) => {
        const li = document.createElement("li");
        li.textContent = user.username;
        li.dataset.userId = user.id;
        li.classList.add("mb-2", "cursor-pointer", "hover:text-blue-500");
        li.addEventListener("click", () => openChat(user.id));
        userList.appendChild(li);
      });
    });
}

function openChat(receiverId) {
  fetch(`/messages/history/${receiverId}`)
    .then((response) => response.json())
    .then((messages) => {
      const chat = document.getElementById("chat");
      chat.innerHTML = ""; // Clear previous chat

      messages.forEach((msg) => {
        const messageDiv = document.createElement("div");
        messageDiv.textContent = msg.message;
        messageDiv.classList.add("p-2", "rounded", "max-w-xs");

        // Check if the message sender is the current user
        if (msg.sender === 63) {
          messageDiv.classList.add("bg-blue-500", "text-white", "ml-auto"); // Align right for the current user
        } else {
          messageDiv.classList.add("bg-gray-300", "text-black"); // Align left for other users
        }

        chat.appendChild(messageDiv);
      });
    });
}
function sendMessage() {
  const messageInput = document.getElementById("messageInput");
  const message = messageInput.value.trim();

  // Dynamically determine the receiver's ID from the selected user
  const selectedUser = document.querySelector(".selectedUser");
  const receiverId = selectedUser ? selectedUser.dataset.userId : null;

  if (message !== "" && receiverId) {
    fetch("/message/send", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ receiverId, message }),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
      })
      .then(() => {
        // Refresh the chat messages after sending the message
        openChat(receiverId);
        // Clear the message input field
        messageInput.value = "";
      })
      .catch((error) => {
        console.error("Error sending message:", error);
      });
  }
}

// Add a class to the selected user for styling
document.getElementById("userList").addEventListener("click", (event) => {
  const userList = document.querySelectorAll("#userList li");
  userList.forEach((user) => user.classList.remove("selectedUser"));
  event.target.classList.add("selectedUser");
});
