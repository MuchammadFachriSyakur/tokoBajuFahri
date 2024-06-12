<?php
include("konek_db.php");
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "DELETE FROM kategori_produk WHERE id='$id'";
  $query = mysqli_query($db,$sql);
  
  if($query){
    echo "<script>
    alert('Data jenis kategori berhasil dihapus!!');
    window.location.href = 'kelola_kategori_produk.php';
  </script>"; 
  }else{
    echo "<script>
    alert('Data jenis kategori gagal dihapus!!');
    window.location.href = 'kelola_kategori_produk.php';
  </script>";
  }
}else{
  die("Akses Dilarang");
}