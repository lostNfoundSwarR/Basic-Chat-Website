const form = document.querySelector(".form.send-msg");
const sendBtn = form.querySelector(".submit-btn.send-btn");
const imgChooser = form.querySelector(".file-chooser");
const messageBox = document.querySelector(".message-box");

let isImage = false;

if(!sessionStorage.getItem("pageLoaded")) {
     sessionStorage.setItem("pageLoaded", "true"); // Mark the page as loaded
     navigator.sendBeacon("php/onload.php", new Blob()); // Send "Active" status
}

window.addEventListener("load", () => {
     navigator.sendBeacon("php/onload.php", new Blob()); // Send "Active" status  
});

form.addEventListener("submit", (event) => {
     event.preventDefault();
});

imgChooser.addEventListener("change", () => {
     form["message"].readOnly = true;
     
     let imageFkPath = imgChooser.value;
     let tmpIdx = imageFkPath.lastIndexOf("\\") + 1;

     imageName = imageFkPath.substr(tmpIdx);

     isImage = true;
     
     form["message"].value = imageName;
});

document.addEventListener("keydown", (event) => {
     if(event.key == "enter") {
          insertMessage();
     }
});

sendBtn.addEventListener("click", async () => {
     let formData = new FormData(form);

     if((form["message"].value).trim() == "") {
          return;
     }

     try {
          if(isImage) {
               await fetch("php/insert-image.php",
                    {
                         method: "POST",
                         body: formData
                    }
               );

               isImage = false;
               form["message"].readOnly = false;
          }
          else {
               await fetch("php/insert-message.php",
                    {
                         method: "POST",
                         body: formData
                    }
               );
          }

          form["message"].value = "";
          form["message"].readOnly = false;
          console.log("successful");
     }
     catch(error) {
          console.error(error);
     }
});
 
setInterval(async () => {
     let formData = new FormData(form);

     try {
          const response = await fetch("php/get-message.php",
               {
                    method: "POST",
                    body: formData
               }
          )

          const data = await response.text();

          messageBox.innerHTML = data;
     }
     catch(error) {
          console.log(error);
     }
}, 500);