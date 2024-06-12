const semuaTombolHilangkanProduct = document.querySelectorAll('.wrap_card .wrapDeleter .btn_link');

semuaTombolHilangkanProduct.forEach((e) =>{
    e.addEventListener("click",(e)=>{
      const konfirmasi = confirm("Apakah anda ingin menghapus product!");
      if(konfirmasi == false){
        e.preventDefault();
      }
    });
})

const tombolBayar = document.querySelector(".btn_pembayaran");

tombolBayar.addEventListener("click", e =>{
    const konfirmasi = confirm("Apakah product yang ada dikeranjang sudah benar!");
    if(konfirmasi == false){
      e.preventDefault();
    }
})