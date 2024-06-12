<?php
include("konek_db.php");
if(isset($_GET['beli_barang'])){
  $username = $_GET['username'];
  $nama_barang = $_GET['nama_barang'];
  $harga_barang = $_GET['harga_barang'];
  $gambar = $_GET['gambar_barang'];
  $jumlah_barang = 1;
  $total = $harga_barang * $jumlah_barang;
  $sql = "INSERT INTO checkout (nama_barang, harga_barang,
  gambar_barang,jumlah_barang,nama,harga_total) VALUES ('$nama_barang',
  '$harga_barang','$gambar','$jumlah_barang','$username','$total')";
  
  $query = mysqli_query($db,$sql);
  if($query){
    echo "<script>
    alert('Data berhasil ditambahkan');
    window.location.href = 'dashboard.php';
  </script>";
  }else{
    echo "<script>
     alert('Data tidak berhasil ditambahkan');
     window.location.href = 'dashboard.php';
    </script>";
  }
}
?>