const deleteOneChatForm = document.querySelector(".delete-chats.single form");
const deleteOneChatBtn = deleteOneChatForm.querySelector(".submit-btn");

const deleteAllChatsBtn = document.querySelector(".delete-chats.all .submit-btn");

deleteOneChatForm.addEventListener("submit", (event) => {
     event.preventDefault();
});

deleteOneChatBtn.addEventListener("click", () => {
     sendData(deleteOneChatForm, "delete-one-chat");
});

deleteAllChatsBtn.addEventListener("click", async () => {
     try {
          const response = await fetch("../php/delete-all-chats.php");

          const data = await response.text();
          
          alert(data);
     }
     catch(error) {
          console.error(error);
     }
});