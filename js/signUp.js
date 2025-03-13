document.addEventListener("DOMContentLoaded", () => {
     const signUpForm = document.querySelector(".form.signUp");
     const error_msg = signUpForm.querySelector(".text.error-msg");
     const submitBtn = signUpForm.querySelector(".submit-btn");
 
     signUpForm.addEventListener("submit", (event) => {
          event.preventDefault();
     });
 
     submitBtn.addEventListener("click", async () => {
          let formData = new FormData(signUpForm);
     
          let data = "";

          

          try {
               const response = await fetch("php/signUp.php", {
                    method: "POST",
                    body: formData
               });
     
               data = await response.text();
               data = data.trimEnd();
     
               if(data == "Success") {
                    location.href = "users-page.php";
               }
          } 
          catch (error) {
               console.error(`HTTP ERROR: ${error}`);
          }

          error_msg.textContent = data;
     });
});