<?php
include("konek_db.php");
if(isset($_GET['update_data'])){
  $id = $_GET['id_barang'];
  $gambar = $_GET['gambar_barang'];
  $nama_barang = $_GET['nama_barang'];
  $harga_barang = $_GET['harga_barang'];
  $jumlah_barang = $_GET['jumlah_barang'];
  
  if($jumlah_barang < 0){
    echo "<script>
     alert('Anda Perlu menambahkan jumlah barang karena jumlah barang anda
     kurang dari 0');
    </script>";
  }else{
     $harga_udpate = $harga_barang * $jumlah_barang;
     echo $harga_udpate;
     $sql = "UPDATE checkout SET
     jumlah_barang='$jumlah_barang',harga_total='$harga_udpate' WHERE id=$id";
     $query = mysqli_query($db, $sql);
     if($query){
       echo "<script>
        alert('Data berhasil diupdate');
        window.location.href = 'daftar-checkout.php';
       </script>";
     }else{
       echo "<script>
        alert('Data tidak berhasil diupdate');
        window.location.href = 'daftar-checkout.php';
       </script>";
     }
  }
}else{
  header("location: index.php");
}
?>