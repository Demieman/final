// script.js

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');

    form.addEventListener('submit', function (event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Prevent form submission
            alert('Passwords do not match. Please try again.');
        }
    });
});