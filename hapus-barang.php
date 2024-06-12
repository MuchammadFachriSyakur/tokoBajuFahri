<?php
include("konek_db.php");
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $gambar_barang = $_GET['gambar_barang'];
  
  unlink("img/$gambar_barang");
  $sql = "DELETE FROM barang WHERE id=$id";
  $query = mysqli_query($db,$sql);
  if($query){
    echo "<script>
    alert('Product berhasil dihapus');
    window.location.href = 'kelola-daftar-makanan.php';
  </script>";
  }else{
    echo "<script>
    alert('Product gagal dihapus');
    window.location.href = 'kelola-daftar-makanan.php';
  </script>";
  }
}else{
  die("Akses Dilarang");
}
?>