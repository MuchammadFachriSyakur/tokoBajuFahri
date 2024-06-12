var indekPertama = 0;
function autoSlide(){
    setTimeout(autoSlide,2000);
    let pics;
    const img = document.querySelectorAll('.slide-container .slides img');
    for(pics = 0; pics < img.length;pics++){
      img[pics].style.display = 'none';
    }
    indekPertama++;
    if(indekPertama > img.length){
        indekPertama = 1;
    }
    img[indekPertama - 1].style.display = 'block';
}
autoSlide();

function filter_kategori(kategori) {
  const item = document.querySelectorAll(".container .wrap_card .card_item");
  for (const produk of item) {
    const kategoriProduk = produk.getAttribute('data-kategori');
    if (kategori === 'all' || kategori === kategoriProduk) {
      produk.style.display = 'flex';
    } else {
      produk.style.display = 'none';
    }
  }
}

const button = document.querySelectorAll(".container .kategori-produk button");
button.forEach((e)=>{
  e.addEventListener("click", (e)=> {
    filter_kategori(e.target.getAttribute('data-kategori'));
  });
})