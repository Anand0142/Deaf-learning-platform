document.addEventListener('DOMContentLoaded', function() {
    const signUpButton = document.getElementById('signUpButton');
    const signInButton = document.getElementById('signInButton');
    const signInForm = document.getElementById('signIn');
    const signUpForm = document.getElementById('signup');

    // Toggle between signup and signin forms
    signUpButton.addEventListener('click', function(e) {
        e.preventDefault();
        signInForm.style.display = "none";
        signUpForm.style.display = "block";
    });

    signInButton.addEventListener('click', function(e) {
        e.preventDefault();
        signInForm.style.display = "block";
        signUpForm.style.display = "none";
    });

    // Handle form submissions
    const loginForm = signInForm.querySelector('form');
    const registerForm = signUpForm.querySelector('form');

    loginForm.addEventListener('submit', function(e) {
        // Let the form submit normally to login.php
        return true;
    });

    registerForm.addEventListener('submit', function(e) {
        // Let the form submit normally to register.php
        return true;
    });
});
