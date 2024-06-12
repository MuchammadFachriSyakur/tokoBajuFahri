<?php
include("konek_db.php");
if(isset($_GET['update'])){
  $id = $_GET['id'];
  $status = htmlspecialchars($_GET['status']);
  $ongkir = $_GET['ongkir'];
  $layanan_pengiriman = htmlspecialchars($_GET['layanan_pengiriman']);
  $no_resi = htmlspecialchars($_GET['no_resi']);
  $catatan_penjual = htmlspecialchars($_GET['catatan_penjual']);
  
  $sql = "UPDATE invoice SET status='$status',ongkir='$ongkir',layanan_pengiriman='$layanan_pengiriman',no_resi='$no_resi',catatan_penjual='$catatan_penjual' WHERE id='$id'";
  $query = mysqli_query($db,$sql);
  
  if($query){
    echo "<script>
  alert('Data invoice berhasil diupdate!!!');
  window.location.href = 'daftar-order.php';
  </script>";
  }else{
    echo "<script>
  alert('Data invoice gagal diupdate!!!');
  window.location.href = 'daftar-order.php';
  </script>";
  }
  
}else{
  echo "<script>
  alert('Anda dilarang masuk');
  window.location.href = 'daftar-order.php';
  </script>";
}
?>