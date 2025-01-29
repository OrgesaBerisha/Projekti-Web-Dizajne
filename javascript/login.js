document.addEventListener("DOMContentLoaded", function (ngjarja) {
    const form = document.querySelector(".register-form");
    const BtnSubmit = document.getElementById("register-button");

    const validate = (ngjarja) => {
        ngjarja.preventDefault();
        const username = document.getElementById("userid");
        const password = document.getElementById("pass");

        const usernameValidim = (username) => {
            const usernameRegex = /^[A-Za-z0-9._]{5,}$/;
            return usernameRegex.test(username);
        }
        const passwordValidim = (password) => {
            const passwordRegex = /^([A-Za-z0-9@$!%*?&]){7,}$/;
            return passwordRegex.test(password);
        };

        if (username.value === "") {
            alert("Please enter your username.");
            username.focus();
            return false;
        }
        if (!usernameValidim(username.value)) {
            alert("Username must contain at least 5 characters and can include letters, numbers, dots, and underscores.");
            username.focus();
            return false;
        }
        if (password.value === "") {
            alert("Please enter your password.");
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