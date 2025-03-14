import sendAJAX from "../js/modules/request-module.js";

const userImg = document.getElementById("user-img");
const userList = document.querySelector(".users-list");
const userOption = document.getElementById("users");

let contentForm = document.querySelectorAll(".content form");

let addFriendsBtns = document.querySelectorAll(".friend-btn");
let cancelReqBtns = document.querySelectorAll(".cancel-btn");

const friendList = document.querySelector(".users-list.friend-list");
const friendOption = document.getElementById("friends");

const searchField = document.querySelector(".search-field");
const searchForm = document.querySelector(".searchBar");

const notificationsBtn = document.querySelectorAll(".notifications-btn");

const settingsBtn = document.querySelector(".settings-btn");
const internalSettingsBtn = document.querySelector(".internal-btn.settings-btn")
const settingsOption = document.querySelector(".option-container");

contentForm.forEach((form) => {
     form.addEventListener("submit", (event) => {
          event.preventDefault();
     });
});

userImg.addEventListener("click", () => {
     window.open("settings/picture.php", "_blank");
});

friendOption.addEventListener("click", () => {
     userList.style.display = "none";
     friendList.style.display = "block";

     friendOption.classList.add("open");
     userOption.classList.remove("open");
});

userOption.addEventListener("click", () => {
     userList.style.display = "block";
     friendList.style.display = "none";

     userOption.classList.add("open");
     friendOption.classList.remove("open");
});

notificationsBtn.forEach((button) => {
     button.addEventListener("click", () => {
          window.open("requests-page.php", "_blank");
     });
});


internalSettingsBtn.addEventListener("click", () => {
     internalSettingsBtn.addEventListener("click", () => {
          window.open("settings/profile.php", "_blank");
     });
});

settingsBtn.addEventListener("click", () => {
     settingsOption.style.display = "flex";
});

settingsOption.addEventListener("mouseleave", () => {
     settingsOption.style.display = "none";
});

document.addEventListener("keyup", () => {   
     setInterval(async () => {
          let searchTerm = searchField.value;

          if(searchTerm.length > 0) {
               let formData = new FormData(searchForm);
               searchField.classList.add("active");
     
               try {
                    if(userList.style.display == "block") {
                         const response = await fetch("php/users-search.php",
                              {
                                   method: "POST",
                                   body: formData
                              }
                         )
          
                         const data = await response.text();
               
                         userList.innerHTML = data;
                    }
                    else {
                         const response = await fetch("php/friends-search.php",
                              {
                                   method: "POST",
                                   body: formData
                              }
                         )
          
                         const data = await response.text();
               
                         friendList.innerHTML = data;       
                    }
               }
               catch(error) {
                    console.error(error);
               }
          }
          else {
               searchField.classList.remove("active");
          }
     }, 500)
});

setInterval(async () => {
     if(friendList.style.display == "block") {
          try {
               const response = await fetch("php/friends.php");
     
               const data = await response.text();

               if(data == "empty") {
                    window.open("registration.php", "_self");
                    clearInterval();
                    return;
               }
     
               if(!searchField.classList.contains("active") && searchField.value.length == 0) {
                    friendList.innerHTML = data;
               }
          } 
          catch(error) {
               console.error(`HTTP error: ${error}`);
          }
     }
     else {
          clearInterval();
     }
}, 500);

let prevCodeLength = userList.innerHTML.length;

setInterval(async () => {
     if(userList.style.display == "block") {
          try {
               const response = await fetch("php/users.php");
     
               const data = await response.text();

               if(data == "empty") {
                    window.open("registration.php", "_self");
                    clearInterval();
                    return;
               }
     
               if(!searchField.classList.contains("active") && searchField.value.length == 0) {
                    userList.innerHTML = data;
               }

               let currentCodeLength = userList.innerHTML.length;

               if(currentCodeLength > prevCodeLength) {
                    contentForm = document.querySelectorAll(".content form");
                    addFriendsBtns = document.querySelectorAll(".friend-btn");
                    cancelReqBtns = document.querySelectorAll(".cancel-btn");

                    contentForm.forEach((form) => {
                         if(!form.hasAttribute("data-listener")) {
                              form.addEventListener("submit", (event) => {
                                   event.preventDefault();
                              });
                         }
                         form.setAttribute("data-listener", "true");
                    });

                    addFriendsBtns.forEach((addBtn) => {
                         if (!addBtn.hasAttribute("data-listener")) {
                              addBtn.addEventListener("click", () => {
                                   let form = addBtn.parentElement;

                                   sendAJAX(form, "send-request");
                              });
                              addBtn.setAttribute("data-listener", "true");
                         }
                    });

                    cancelReqBtns.forEach((cancelBtn) => {
                         if (!cancelBtn.hasAttribute("data-listener")) {
                              cancelBtn.addEventListener("click", () => {
                                   let form = cancelBtn.parentElement;

                                   sendAJAX(form, "cancel-request");
                              });
                              cancelBtn.setAttribute("data-listener", "true");
                         }
                    });
               }
          } 
          catch(error) {
               console.error(`HTTP error: ${error}`);
          }
     }
     else {
          clearInterval();
     }
}, 500);
