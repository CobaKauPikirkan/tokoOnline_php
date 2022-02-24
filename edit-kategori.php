<?php
session_start();
include'db.php';
if($_SESSION['status_login']!=true){
header('location: login.php');
}
$kategori = mysqli_query($conn,"SELECT * FROM kategori WHERE category_id = '".$_GET['id']."' ");
if(mysqli_num_rows($kategori) == 0){
    echo '<script>window.location="kategori.php </script>';
}
$k = mysqli_fetch_object($kategori);

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
                <h3>Edit Kategori</h3>
                <div class="box">
                    <form action='' method="POST">
                        <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k->
                                    category_name?>" required>
                        <input type="submit" name="submit" value="edit" class="btn-login">
                    </form>
                    <?php 
                        if(isset($_POST['submit'])){
                            $nama = ucwords($_POST['nama']);
                           $update = mysqli_query($conn, "UPDATE kategori SET
                                                    category_name= '".$nama."'
                                                    WHERE category_id = '".$k->category_id."' ");
                            if($update){
                                echo'<script>alert("Berhasil menngedit data")</script>';
                                echo'<script>window.location="data-kategori.php"</script>';
                            }else{
                                echo'gagal'.mysqli_erron($conn);
                            }
                        }
                    ?>
                 
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