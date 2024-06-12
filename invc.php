<?php
include("konek_db.php");
if(!isset($_GET['lihat_detail_invoice'])){
  echo "<script>
    window.location.href = 'index.php';
  </script>";
}else{
  $id = $_GET['id'];
  $kode_unik = $_GET['kode_unik'];
  $username = $_GET['username'];
  $mentahanArray = $_GET['id_barang'];
 
  $explode = explode(",",$mentahanArray);  
  
}

$total = 0;

$ongkirBarang = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ellens closet</title>
  <link rel="stylesheet" href="src/css/output.css" type="text/css" media="all" />
</head>
<body>
  <div class="full-contain w-full min-h-screen flex flex-col justify-center items-center gap-5">

    <?php

     $sql = "SELECT * FROM invoice";
     $query = mysqli_query($db, $sql);
     $kode_checkout = "";
     
     while($data = mysqli_fetch_array($query)):
    ?>
    <?php  
    $user = $data['username'];?>
     <?php if($username == $user && $kode_unik == $data['kode_unik']):?>
      <?php 
      $kodeBarang = $data['kode_unik']; 
      $ongkirBarang+= $data['ongkir'];
      $total += $ongkirBarang;
      ?>
      <div class="card_invoice w-full max-w-[500px] flex flex-col justify-center items-center p-2 mb-4">
        <div class="header w-full flex justify-between items-center border-b-2 border-slate-600">
             <p class="text-3xl font-extrabold">INVOICE</p>
             <img src="img/logo.jpg" class="w-[150px] h-[100px] bg-cover bg-no-repeat bg-center object-cover" alt="Logo">
        </div>
        <div class="detail w-full flex justify-between items-start py-4">
            <div class="w-[50%] flex flex-col justify-center items-start">
               <p class="text-[18px] font-bold mb-2">Kepada:</p>
               <p class="w-full whitespace-nowrap overflow-hidden text-ellipsis"><?=  $data['nama_lengkap']; ?></p>
               <p class="w-full whitespace-nowrap overflow-hidden text-ellipsis"><?= $data['email'];?></p>
            </div>
            <div class="w-[50%] flex flex-col justify-start items-center">
               <p>Date : <?= $data['created_at'];?></p>
               <p>Kode : <?= $data['kode_unik'];?></p>
               <p>Layanan pengiriman : <?= $data['layanan_pengiriman'];?></p>
               <p>No resi : <?= $data['no_resi'];?></p>
            </div>
        </div>
        <table class="w-full">
           <thead>
          <tr class="w-full">
            <th class="w-[40%] p-2 border border-black">Produk</th>
            <th class="w-[10%] p-2 border border-black">Jumlah</th>
            <th class="w-[25%] p-2 border border-black">Harga</th>
            <th class="w-[25%] p-2 border border-black">Total Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sqla = "SELECT * FROM checkout";
          $querya = mysqli_query($db, $sqla);
            while($data = mysqli_fetch_array($querya)) {
              $status = $data['status'];
              $id = $data['id'];
              $namaBarang = $data['nama_barang'];
              $jumlahBarang = $data['jumlah_barang'];
              $hargaBarang = $data['harga_barang'];
              $hargaTotal = $data['harga_total'];
                foreach ($explode as $data){
                $angka = (int)$data;
                if($id == $angka){
                   echo "<tr class='px-2 border-b border-slate-200'>";
                     echo "<td class='p-2 border border-black'>".$namaBarang."</td>";
                     echo "<td class='p-2 border border-black'>".$jumlahBarang."</td>";
                     $rupiahHargaBarang = "Rp " . number_format($hargaBarang, 2, ',', '.');
                     echo "<td class='p-2 border border-black'>".$rupiahHargaBarang."</td>";
                     $rupiahTotalHargaBarang = "Rp " . number_format($hargaTotal, 2, ',', '.');
                     $total += $hargaTotal;
                     echo "<td class='p-2 border border-black'>".$rupiahTotalHargaBarang."</td>";
                   echo "</tr>";
                  }
                }
        }
          
          ?>
        </tbody>
        <tbody>
          <tr>
            <td class="p-2 border border-black">Ongkir</td>
            <td class="p-2 border border-black"></td>
            <td class="p-2 border border-black"></td>
            <?php 
            $rupiahOngkirHargaBarang = "Rp " . number_format($ongkirBarang, 2, ',', '.');
            ?>
            <td class="p-2 border border-black"><?=  $rupiahOngkirHargaBarang; ?></td>
          </tr>
          <tr>
            <td class="p-2 border border-black">Total</td>
            <td class="p-2 border border-black"></td>
            <td class="p-2 border border-black"></td>
            <?php 
             $rupiahTotalBayarUser = "Rp " . number_format($total, 2, ',', '.');
            ?>
            <td class="p-2 border border-black"><?=  $rupiahTotalBayarUser; ?></td>
          </tr>
        </tbody>
        </table>
      </div>
      <!-- <button class="btn_cetak px-3 py-5 rounded-full bg-red-500">Cetak</button> -->
     <?php endif; ?>
    <?php endwhile; ?>

    <div class="wrap_tombol w-full flex flex-wrap justify-center items-center gap-3">
     <a href="daftar_pesanan.php">Kembali</a>
     <button class="btn_cetak px-3 py-5 rounded-full">Cetak</button>
    </div>
  </div>
  
  <script src="src/js/invoice.js"></script>
</body>
</html>