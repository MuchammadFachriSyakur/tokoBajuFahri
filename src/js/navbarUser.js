const navbar = document.querySelector(".navbar .gridhome .grid1 .hamburger");

navbar.addEventListener("click", e =>{
  const ul = document.querySelector(".navbar .gridhome .nav-link");
  ul.classList.toggle("hidden");
});

const formLogout = document.querySelector(".logout_user");
formLogout.addEventListener("submit", e =>{
  const konfimasi = confirm("Apakah anda ingin kelter!");
  
  if(konfimasi == false){
    e.preventDefault();
  }
});