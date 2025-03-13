const form = document.querySelector("form.theme-options");
const saveBtn = document.querySelector("form.theme-options .submit-btn");

form.addEventListener("submit", (event) => {
     event.preventDefault();
});

saveBtn.addEventListener("click", async () => {
     let formData = new FormData(form);

     try {
          await fetch("../php/set-theme.php", 
               {
                    method: "POST",
                    body: formData
               }
          );

          localStorage.setItem("themeChange", Date.now());

          location.reload();
     }
     catch(error) {
          console.error(error);
     }
});