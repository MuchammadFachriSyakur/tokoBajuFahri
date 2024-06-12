const semuaButtonCheckout = document.querySelectorAll(".full-contain .wrap_tombol .btn_cetak");

semuaButtonCheckout.forEach((e)=>{
  e.addEventListener("click", e =>{
    const kontenPrint = document.querySelector(".card_invoice").innerHTML;
    const originalContents = document.body.innerHTML;
    document.body.innerHTML = kontenPrint;
    window.print();
    document.body.innerHTML = originalContents;
  });
});