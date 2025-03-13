const deleteBtn = document.querySelector(".delete-content .submit-btn");

deleteBtn.addEventListener("click", async () => {
     try {
          await fetch("../php/delete-account.php");

          window.close();
     }
     catch(error) {
          console.error(error);
     }
});