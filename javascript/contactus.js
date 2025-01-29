document.addEventListener("DOMContentLoaded", function (ngjarja) {
    const form = document.querySelector(".register-form");
    const BtnSubmit = document.getElementById("register-button");

    const validate = (ngjarja) => {
        ngjarja.preventDefault();
        const name = document.getElementById("name");
        const username = document.getElementById("userid");
        const email = document.getElementById("adresaEmail");
        const password = document.getElementById("pass");

        const nameValidim = (name) => {
            const nameRegex = /^[A-Za-z\s]{3,}$/;
            return nameRegex.test(name);
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

        if (name.value === "") {
            alert("Please enter your name.");
            name.focus();
            return false;
        }
        if (!nameValidim(name.value)) {
            alert("Name must contain at least 3 letters and only letters and spaces.");
            name.focus();
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

        alert("Form submitted successfully!");
        form.submit();
        return true;
    };

    form.addEventListener('submit', validate);
});






