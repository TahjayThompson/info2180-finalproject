"use strict";

window.addEventListener("DOMContentLoaded", function() {
    let loginButton = document.getElementsByClassName("login")[0];
    
    loginButton.addEventListener("click", function() {
        let emailInput = document.getElementById("email").value;
        let passwordInput = document.getElementById("password").value;

        if (emailInput == "" && passwordInput != "") {
            alert("Enter your email address!");
        }
        else if (emailInput != "" && passwordInput == "") {
            alert("Enter your password!");
        }
        else if (emailInput == "" && passwordInput == "") {
            alert("Enter your email address and password!");
        }
        else {
            return true;
        }
    })
});