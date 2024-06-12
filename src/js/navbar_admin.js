const navbar = document.querySelector(".nav-bar .toggle");
navbar.addEventListener("click", e =>{
  const ul = document.querySelector(".container .grid1");
  ul.classList.toggle("aktif");
});