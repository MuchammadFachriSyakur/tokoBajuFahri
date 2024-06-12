<?php
session_start();
include ("konek_db.php");
if (isset($_POST['logout_admin'])) {
  session_unset();
  session_destroy();
  header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="src/css/kelola_user.css" type="text/css" media="all" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
rel="stylesheet">
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body>
  <nav class="nav-bar">
    <h1>Admin Page</h1>
    <div class="toggle">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </nav>
  <div class="container">
    <div class="grid1">
      <ul class="wrap_linked">
        <li><a href="kelola_user.php">Kelola Daftar User</a></li>
        <li><a href="kelola-daftar-makanan.php">Kelola Daftar Barang</a></li>
        <li><a href="daftar-order.php">Daftar Order</a></li>
        <li><a href="kelola_kategori_produk.php">Kelola daftar kategori produk</a></li>
        <li>
          <form method="POST">
            <button type="submit" name="logout_admin">Logout</button>
          </form>
        </li>
      </ul>
    </div>
    <div class="grid2">
      <?php
      $sql = "SELECT * FROM user";
      $query = mysqli_query($db, $sql);
      ?>

      <table cellspacing="0" class="w-full">

        <thead class="w-full bg-slate-800 text-slate-300">

          <tr>
            <th class="p-2">Id</th>
            <th class="p-2">Username</th>
            <th class="p-2">Password</th>
            <th class="p-2">Tanggal Dibuat</th>
            <th class="p-2">Level akun</th>
            <th class="p-2">Tindakan</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($siswa = mysqli_fetch_array($query)): ?>
            <tr>
              <td>
                <?php echo $siswa['id']; ?>
              </td>
              <td>
                <?php echo $siswa['username']; ?>
              </td>
              <td>
                <?php echo $siswa['password']; ?>
              </td>
              <td>
                <?php echo $siswa['created-at'] ?>
              </td>
              <td>
                <?php echo $siswa['level']; ?>
              </td>
              <td class="tindakan">
                <?php
                echo "<a href='form-edit.php?id=" . $siswa['id'] . "'><i class='ph ph-pencil-simple'></i></a>";
                echo "<a href='hapus-user.php?id=" .
                  $siswa['id'] . "'><i class='ph ph-trash'></i></a>";
                echo "</td>";
                echo "</tr>";
                ?>
              <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="src/js/navbar_admin.js"></script>
</body>

</html>