const archiveForm = document.querySelector(".archive-chats form");
const submitArchiveBtn = archiveForm.querySelector(".submit-btn");

const removeArchiveForm = document.querySelector(".remove-archive form");
const removeArchiveBtn = removeArchiveForm.querySelector(".submit-btn");

const removeAllArchivesBtn = document.querySelector(".remove-archive .remove-all .submit-btn");

archiveForm.addEventListener("submit", (event) => {
     event.preventDefault();
});

submitArchiveBtn.addEventListener("click", async () => {
     sendData(archiveForm, "archive-user")
});

removeArchiveForm.addEventListener("submit", (event) => {
     event.preventDefault();
});

removeArchiveBtn.addEventListener("click", () => {
     sendData(removeArchiveForm, "remove-archive")
});

removeAllArchivesBtn.addEventListener("click", async () => {
     try {
          const response = await fetch("../php/remove-all-archive.php");

          const data = await response.text();

          alert(data);
     }
     catch(error) {
          console.error(error);
     }
});

async function sendData(form, file) {
     let formData = new FormData(form);

     try {
          const result = await fetch(`../php/${file}.php`,
               {
                    method: "POST",
                    body: formData
               }
          );
          
          const data = await result.text();

          alert(data);
     }
     catch(error) {
          console.error(error);
     }
}