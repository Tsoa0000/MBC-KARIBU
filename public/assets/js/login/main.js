const signInBtn = document.querySelector("#sign-in-btn");
const signUpBtn = document.querySelector("#sign-up-btn");
const container = document.querySelector("#container");


signUpBtn.addEventListener('click', () => {
    container.classList.add("sign-up-mode");
});
signInBtn.addEventListener('click', () => {
    container.classList.remove("sign-up-mode");
});

document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.querySelector('input[name="password"]').value;
    const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;


});

