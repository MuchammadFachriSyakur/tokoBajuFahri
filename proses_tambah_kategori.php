<?php
include ("konek_db.php");
if (isset($_GET["kirim_kategori_produk"])) {
  $kategori = $_GET['kategori'];
  $keamananInputUntukVariableKategori = htmlspecialchars($kategori);

  $sql = "INSERT INTO kategori_produk (jenis_kategori) VALUES ('$keamananInputUntukVariableKategori')";
  $query = mysqli_query($db, $sql);

  if ($query) {
    echo "<script>
        alert('Data Berhasil ditambahkan');
        window.location.href = 'kelola_kategori_produk.php';
      </script>";
  } else {
    echo "<script>
         alert('Data tidak Berhasil ditambahkan');
         window.location.href = 'kelola_kategori_produk.php';
       </script>";
  }
}
?>