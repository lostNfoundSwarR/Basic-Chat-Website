const form = document.querySelector(".main-content form");
const changeBtn = form.querySelector(".submit-btn");

const imageInput = document.querySelector(".cover-btn .file-chooser");
const coverBtn = document.querySelector(".cover-btn");
const fileName = document.querySelector(".file-name");
const errorMsg = document.querySelector(".error-msg");

coverBtn.addEventListener("click", () => {
     console.log("Hello");
});

imageInput.addEventListener("change", () => {
     let imageFkPath = imageInput.value;
     let tmpIdx = imageFkPath.lastIndexOf("\\") + 1;

     imageName = imageFkPath.substr(tmpIdx);
     
     fileName.textContent = imageName;
});

form.addEventListener("submit", (event) => {
     event.preventDefault();
});

changeBtn.addEventListener("click", async () => {
     console.log

     let formData = new FormData(form);

     try {
          const response = await fetch("../php/profile-picture.php",
               {
                    method: "POST",
                    body: formData
               }
          );

          const data = await response.text();

          if(!data.startsWith("Error")) {
               errorMsg.style.display = "none";
               location.reload();
               localStorage.setItem("pictureChanged", Date.now());
          }
          else {
               errorMsg.style.display = "block";
               errorMsg.textContent = data;
          }
     }
     catch(error) {
          console.log(error);
     }
});