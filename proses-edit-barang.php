<?php
include ("konek_db.php");

if (isset($_POST['edit-barang'])) {
  $id = $_POST['id_barang'];
  $nama_barang = htmlspecialchars($_POST['nama_barang']);
  $harga_barang = $_POST['harga_barang'];
  $deskripsi_barang = htmlspecialchars($_POST['deskripsi_barang']);
  $gambar_barang = $_FILES['gambar_barang'];
  $kategoribarang = htmlspecialchars($_POST['kategori_produk']);

  $image = $_FILES['gambar_barang']['name'];
  $tmp = $_FILES['gambar_barang']['tmp_name'];

  if ($image == "") {
    $sql = "UPDATE barang SET nama_barang='$nama_barang',harga_barang='$harga_barang',deskripsi_barang='$deskripsi_barang',kategori_produk='$kategoribarang' WHERE id=$id";
    $query = mysqli_query($db, $sql);
    if ($query) {
      echo "<script>
         alert('Data Berhasil ditambahkan');
         window.location.href = 'kelola-daftar-makanan.php';
       </script>";
    } else {
      echo "<script>
         alert('Data tidak berhasil ditambahkan');
         window.location.href = 'kelola-daftar-makanan.php';
       </script>";
    }
  } else {
    $sql = "UPDATE barang SET nama_barang='$nama_barang',harga_barang='$harga_barang',deskripsi_barang='$deskripsi_barang',gambar_barang='$image',kategori_produk='$kategoribarang' WHERE id=$id";
    $query = mysqli_query($db, $sql);
    if ($query) {
      echo "<script>
         alert('Data Berhasil ditambahkan');
         window.location.href = 'kelola-daftar-makanan.php';
       </script>";
    } else {
      echo "<script>
         alert('Data tidak berhasil ditambahkan');
         window.location.href = 'kelola-daftar-makanan.php';
       </script>";
    }
    $location = "img/" . $image;
    move_uploaded_file($tmp, $location);
  }
} else {
  die("akses dilarang");
}
?>