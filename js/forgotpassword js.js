var username1 = document.getElementById("username1");
var newpassword = document.getElementById("newpassword");
var re_password = document.getElementById("re_password");
var username_error = document.getElementById("username_error");
var password_error = document.getElementById("password_error");
var confirmpassword_error = document.getElementById("confirmpassword_error");
var btn4 = document.getElementById("btn4");

var eregex = /^[a-zA-Z0-9]+@[a-zA-Z]+\.com$/;
var nregex = /^[a-zA-Z]+$/;
var pwregex = /(?=.\d)(?=.[a-z])(?=.*[A-Z]).{8,}/;

btn4.addEventListener("click",function(event){
    var validate = true;
    if(!(username1.value)){
        username_error.textContent = "Email address must be required";
        validate = false;
    }
    else if(eregex.test(username1.value) == false){
        username_error.textContent = "Enter a valid email address";
        validate = false;
    }

    if(!(newpassword.value)){
        password_error.textContent = "Password must be required";
        validate = false;
    }
    else if((newpassword.value).length < 8){
        password_error.textContent = "Password must contain 8 characters";
        validate = false;
    }
    else if(pwregex.test(newpassword.value) == false){
        password_error.textContent = "Password must contain letters, numbers and characters";
        validate = false;
    }
    if(!(re_password.value)){
        confirmpassword_error.textContent = "Confirm password must be required";
        validate = false;
    }
    else if(re_password.value != newpassword.value){
        confirmpassword_error.textContent="Password doesn't match";
        validate = false;
    }
    if(validate == false){
        event.preventDefault();
    }
});