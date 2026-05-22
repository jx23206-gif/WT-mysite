const hamburger = document.querySelector('.hamburger');
const nav = document.querySelector('.ham_nav');

hamburger.addEventListener('click', () => {
nav.classList.toggle('show');  // showがついたり消えたり
});