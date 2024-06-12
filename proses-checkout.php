<?php
include ("konek_db.php");
if (isset($_GET['selesaikan-pembayaran'])) {
  $username = htmlspecialchars($_GET['username']);
  $nama_lengkap = htmlspecialchars($_GET['nama']);
  $alamat = htmlspecialchars($_GET['alamat']);
  $email = htmlspecialchars($_GET['email']);
  $telepon = htmlspecialchars($_GET['telepon']);
  $sistemPembayaran = $_GET['pembayaran'];
  $dataArrayBarang = unserialize($_GET['daftar_barang']);
  $implode = implode(",", $dataArrayBarang);


  $kodebaru = uniqid();

  $sql = "INSERT INTO invoice (kode_unik,username,email,no_telepon,nama_lengkap,alamat,sistem_pembayaran,id_barang) VALUES ('$kodebaru','$username','$email','$telepon','$nama_lengkap','$alamat','$sistemPembayaran','$implode')";
  $query1 = mysqli_query($db, $sql);

  $sql2 = "SELECT * FROM checkout";
  $query2 = mysqli_query($db, $sql2);
  while ($data = mysqli_fetch_array($query2)) {
    $id = $data['id'];
    $nama = $data['nama'];
    if ($nama == $username) {
      $status = "terbeli";
      $sql3 = "UPDATE checkout SET status='$status', kode_unik='$kodebaru' WHERE id=$id";
      $query3 = mysqli_query($db, $sql3);
    }
  }
  if ($query1) {
    header("location: daftar-checkout.php");
  } else {
    echo "Transaksi gagal";
  }
} else {
  echo "Akses dilarang";
}
?>