window.addEventListener("storage", (event) => {
     if(event.key == "themeChange" || event.key == "pictureChanged" || event.key == "loggedOut") {
          location.reload();
     }
});