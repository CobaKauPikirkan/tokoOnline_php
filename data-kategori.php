<?php
session_start();
include'db.php';
if($_SESSION['status_login']!=true){
header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width= device-width, initial-scale=1">
        <title>Toko ONLINE</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="container">
                <h1><a href="dashboard.php">TokoOnline</a></h1>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="data-kategori.php">Data Kategori</a></li>
                    <li><a href="data-produk.php">Data Produk</a></li>
                    <li><a href="keluar.php">Logout</a></li>
                </ul>
            </div>
        </header>
        <!-- konten -->
        <div class="section">
            <div class="container">
                <h3>Data Kategori</h3>
                <div class="box">
                    <p><a href="tambah-kategori.php" class="button-tambah">Tambah Data</a>
                    </br>
                    </br>
                    <table border="1" cellspacing="0" class="table">
                        <thead>
                            <tr>
                                <th width="60px">NO</th>
                                <th>Kategori</th>
                                <th width="150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY category_id DESC");
                                while($row = mysqli_fetch_array($kategori)){
                            
                            ?>
                                <tr>
                                    <td><?php echo $no++?></td>
                                    <td><?php echo $row['category_name']?></td>
                                    <td>
                                        <a href="edit-kategori.php? id=<?php echo $row['category_id'] ?>"class="edit2-button">Edit</a> || <a href="
                                        proses-hapus.php?idk=<?php echo $row['category_id']?>" class="hapus2-button" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </td>
                                </tr>
                             <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- footer -->
        <footer>
            <div class="container">
                <small>Copyrigt &copy; 2021 - TokoOnline. by fachrurozi rizky</small>
            </div>
        </footer>
    </body>
</html>