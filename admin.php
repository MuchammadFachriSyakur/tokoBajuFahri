<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Ellen Closet</title>
    <link rel="stylesheet" href="src/css/admin_1.css" type="text/css" media="all" />
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
                <li><a href="#">Kelola Daftar Barang</a></li>
                <li><a href="#">Daftar Pencheckout</a></li>
                <li><a href="#">Daftar Barang Rusak</a></li>
                <li><a href="#">Daftar Para Bot</a></li>
                <li>
                    <form method="POST">
                        <button type="submit" name="logout_admin">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="grid2">

        </div>
    </div>

    <script src="src/js/navbar_admin.js"></script>
</body>

</html>