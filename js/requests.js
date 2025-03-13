import {Request} from "../js/modules/request-module.js";

let form;
let acceptBtns;
let denyBtns;

const requestsList = document.querySelector(".requests-list");

let prevCodeLength = requestsList.innerHTML.length;

setInterval(async () => {
     try {
          const response = await fetch("php/get-requests.php");

          const data = await response.text();

          requestsList.innerHTML  = data;

          let currentCodeLength = requestsList.innerHTML.length;

          if(currentCodeLength > prevCodeLength) {
               form = document.querySelectorAll("form");
               acceptBtns = document.querySelectorAll(".submit-btn.accept-request");
               denyBtns = document.querySelectorAll(".submit-btn.deny-request");

               form.forEach((form) => {
                    if(!form.hasAttribute("data-listener")) {
                         form.addEventListener("submit", (event) => {
                              event.preventDefault();
                         });
                    }
                    form.setAttribute("data-listener", "true");
               });

               acceptBtns.forEach((addBtn) => {
                    if (!addBtn.hasAttribute("data-listener")) {
                         addBtn.addEventListener("click", () => {
                              let form = addBtn.parentElement;

                              Request.sendAJAX(form, "accept-request");
                         });
                         addBtn.setAttribute("data-listener", "true");
                    }
               });

               denyBtns.forEach((cancelBtn) => {
                    if (!cancelBtn.hasAttribute("data-listener")) {
                         cancelBtn.addEventListener("click", () => {
                              let form = cancelBtn.parentElement;

                              Request.sendAJAX(form, "decline-request");
                         });
                         cancelBtn.setAttribute("data-listener", "true");
                    }
               });
          }
     }
     catch(error) {
          console.error(error);
     }
}, 500);
