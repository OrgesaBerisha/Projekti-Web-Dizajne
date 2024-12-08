document.addEventListener("DOMContentLoaded", function (ngjarja) {
    const form = document.querySelector(".register-form");
    const BtnSubmit = document.getElementById("register-button");

    const validate = (ngjarja) => {
        ngjarja.preventDefault();
        const fullName = document.getElementById("fullName");
        const username = document.getElementById("userid");
        const email = document.getElementById("adresaEmail");
        const password = document.getElementById("pass");
        const city = document.getElementById("city");

        const fullNameValidim = (fullName) => {
            const fullNameRegex = /^[A-Za-z\s]{3,}$/;
            return fullNameRegex.test(fullName);
        }

        const usernameValidim = (username) => {
            const usernameRegex = /^[A-Za-z0-9._]{5,}$/;
            return usernameRegex.test(username);
        }

        const emailValidim = (email) => {
            const emailRegex = /^([A-Za-z0-9._%+-])+@([A-Za-z0-9.-])+\.[A-Za-z]{2,}$/;
            return emailRegex.test(email.toLowerCase());
        };

        const passwordValidim = (password) => {
            const passwordRegex = /^([A-Za-z0-9@$!%*?&]){7,}$/;
            return passwordRegex.test(password);
        };

        if (fullName.value === "") {
            alert("Please enter your full name.");
            fullName.focus();
            return false;
        }
        if (!fullNameValidim(fullName.value)) {
            alert("Full Name must contain at least 3 letters and only letters and spaces.");
            fullName.focus();
            return false;
        }
        if (username.value === "") {
            alert("Please enter your username of choice.");
            username.focus();
            return false;
        }
        if (!usernameValidim(username.value)) {
            alert("Username must contain at least 5 characters and can include letters, numbers, dots, and underscores.");
            username.focus();
            return false;
        }
        if (email.value === "") {
            alert("Please enter your email.");
            email.focus();
            return false;
        }
        if (!emailValidim(email.value)) {
            alert("Please enter a valid email address.");
            email.focus();
            return false;
        }
        if (password.value === "") {
            alert("Please write your password.");
            password.focus();
            return false;
        }
        if (!passwordValidim(password.value.trim())) {
            alert("Password must be at least 7 characters long and include letters, numbers, or special characters.");
            password.focus();
            return false;
        }
        if (city.value === "") {
            alert("Please select your city.");
            city.focus();
            return false;
        }

        alert("Form submitted successfully!");
        window.location.href = "menu.html";
    };

    form.addEventListener("submit", validate);
});






