const navbar = document.querySelector(".navbar .gridhome .grid1 .hamburger");

navbar.addEventListener("click", e =>{
  const ul = document.querySelector(".navbar .gridhome .nav-link");
  ul.classList.toggle("hidden");
});