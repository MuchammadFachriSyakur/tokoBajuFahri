<?php
include("konek_db.php");
if(isset($_GET['edit_kategori'])){
  $id = $_GET['id'];
  $nama = htmlspecialchars($_GET['name']);
  
  $sql = "UPDATE kategori_produk SET jenis_kategori='$nama' WHERE id='$id'";
  $query = mysqli_query($db,$sql);
  
  if($query){
    echo "<script>
     alert('Data jenis kategori berhasil diupdate');
     window.location.href = 'kelola_kategori_produk.php';
    </script>";
  }else{
    echo "<script>
     alert('Data jenis kategori gagal diupdate');
     window.location.href = 'kelola_kategori_produk.php';
    </script>";
  }
}else{
  die("Akses dilarang");
}
?>