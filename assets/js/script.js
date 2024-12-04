// function showEmailAlert() {
//     var content = document.getElementById("warningContent");
//     var incEmail = document.getElementById("incEmail");
//     content.classList.remove("none");
//     incEmail.classList.remove("none");
// }

// function showEmailUsed() {
//     var content = document.getElementById("warningContent");
//     var usedEmail = document.getElementById("usedEmail");

//     content.classList.remove("none");
//     usedEmail.classList.remove("none");
// }

// function showPassAlert() {
//     var content = document.getElementById("warningContent");
//     var incPass = document.getElementById("incPass");


//     content.classList.remove("none");
//     incPass.classList.remove("none");
// }


// JavaScript to toggle the sidebar on small screens
const burgerIcon = document.getElementById('burger-icon');
const sidebar = document.querySelector('.sidebar');

burgerIcon.addEventListener('click', function () {
    sidebar.classList.toggle('show');  // Toggle sidebar visibility
});
