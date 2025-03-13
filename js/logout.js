const logOutBtn = document.querySelector(".profile-content .submit-btn.logout-btn");

logOutBtn.addEventListener("click", async () => {
     try {
          const response = await fetch("../php/logout.php");

          const data = await response.text();

          localStorage.setItem("loggedOut", Date.now());

          if(data == "close") {
               window.close();
          }
     }
     catch(error) {
          console.error(error);
     }
});