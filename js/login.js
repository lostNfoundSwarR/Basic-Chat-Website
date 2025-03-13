document.addEventListener("DOMContentLoaded", () => {
     const loginForm = document.querySelector(".form.login");
     const error_msg = loginForm.querySelector(".text.error-msg");

     loginForm.addEventListener("submit", async (event) => {
          event.preventDefault();

          let formData = new FormData(loginForm)
          let data = "";

          try {
               const response = await fetch("php/login.php",
                    {
                         method: "POST",
                         body: formData
                    }
               );

               data = await response.text();
               data = data.trimEnd();

               if(data == "Success") {
                    location.href = "users-page.php";
               }
               else {
                    error_msg.textContent = data;
               }
          }
          catch(error) {
               console.error(`HTTP Error: ${error}`);
          }
     });
});