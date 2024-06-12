const allProductCategoryFilters = document.querySelectorAll(".categoryProduct");

allProductCategoryFilters.forEach((e)=>{
 const typeOfProducts = e.getAttribute("data-kategori");
 e.addEventListener("click", (e)=>{
   applyProductFilters(typeOfProducts);
 });
});

function applyProductFilters(category){
 const products = document.querySelectorAll(".wrap_card .card_item");

 for(const productItem of products){
   const categoryProduct = productItem.getAttribute("data-kategori");
   if(category === "All" || category === categoryProduct){
    productItem.style.display = "flex";
   }else{
    productItem.style.display = "none";
   }
 }
}