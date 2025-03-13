//NOTE: The reason there are many setTimeout() is that it makes the animations more smooth

//Forms
const loginForm = document.getElementById("login-form");
const signUpForm = document.getElementById("sign-up-form");

//Toggle buttons
const loginToggleBtn = document.getElementById("login-toggle-btn");
const signUpToggleBtn = document.getElementById("sign-up-toggle-btn");

//Toggle containers
const loginToggle = document.getElementById("login-toggle");
const signUpToggle = document.getElementById("sign-up-toggle");

//Event listeners
loginToggleBtn.addEventListener("click", () => {
     signUpForm.style.animationName = "move";
     signUpForm.style.animationDuration = "0.8s";
     
     //To prevent the Form from disappearing instantly
     setTimeout(() => {
          signUpForm.style.display = "none";

          loginForm.style.display = "flex";
          loginForm.style.animationFillMode = "forwards";
          loginForm.style.animationName = "formShow";
          loginForm.style.animationDuration = "1s";
     }, 800);

     loginToggle.style.animationName = "disappear";
     loginToggle.style.animationDuration = "0.8s";

     //To prevent the toggle-box from disappearing instantly
     setTimeout(() => {
          loginToggle.style.display = "none";
     }, 800);

     signUpToggle.style.animationFillMode = "forwards";
     signUpToggle.style.animationName = "appear";
     signUpToggle.style.animationDuration = "0.8s";

     //To make it so that the toggle-box is displayed in both conditions [with & without a display]
     if(signUpToggle.style.display == "none") {
          signUpToggle.style.display = "block";
     }
     else {
          signUpToggle.style.display = "block";
     }
});

signUpToggleBtn.addEventListener("click", () => {
     loginForm.style.animationName = "come";
     loginForm.style.animationDuration = "0.8s";
     
     //To prevent the Form from disappearing instantly
     setTimeout(() => {
          loginForm.style.display = "none";

          signUpForm.style.display = "flex";
          signUpForm.style.animationFillMode = "forwards";
          signUpForm.style.animationName = "formShow";
          signUpForm.style.animationDuration = "1s";
     }, 800);

     signUpToggle.style.animationName = "disappear";
     signUpToggle.style.animationDuration = "0.8s";

     //To prevent the toggle-box from disappearing instantly
     setTimeout(() => {
          signUpToggle.style.display = "none";
     }, 800);

     loginToggle.style.animationFillMode = "forwards";
     loginToggle.style.animationName = "appear";
     loginToggle.style.animationDuration = "0.8s";
     
     //To make it so that the toggle-box is displayed in both conditions [with & without a display]
     if(loginToggle.style.display == "none") {
          loginToggle.style.display = "block";
     }
     else {
          loginToggle.style.display = "block";
     }

});