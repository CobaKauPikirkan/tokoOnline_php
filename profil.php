<?php
session_start();
include'db.php';
if($_SESSION['status_login']!=true){
header('location: login.php');
}
$query =mysqli_query($conn, "SELECT* FROM admin WHERE admin_id='".$_SESSION['admin_id']."' ");
$d = mysqli_fetch_object($query);
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
                <h3>Profil</h3>
                <div class="box">
                    <form action='' method="POST">
                        <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                        <input type="text" name="username" placeholder="username" class="input-control" value="<?php echo $d->username ?>" required>
                        <input type="text" name="hp" placeholder="no.hp" class="input-control" value="<?php echo $d->admin_telp ?>" required>
                        <input type="email" name="email" placeholder="email" class="input-control" value="<?php echo $d->admin_email ?>" required>
                        <input type="text" name="alamat" placeholder="alamat" class="input-control" value="<?php echo $d->admin_address ?>" required>
                        <input type="submit" name="submit" value="ubah" class="btn-login">
                    </form>
                    <?php
                        if(isset($_POST['submit'])){
                            $nama   =ucwords($_POST['nama']);
                            $user   =$_POST['username'];
                            $telp   =$_POST['hp'];
                            $email  =$_POST['email'];
                            $alamat =ucwords($_POST['alamat']);

                            $update = mysqli_query($conn,"UPDATE admin SET
                                            admin_name='".$nama."',
                                            username='".$user."',
                                            admin_telp='".$telp."',
                                            admin_email='".$email."',
                                            admin_address='".$alamat."'
                                            WHERE admin_id='".$d->admin_id."' ");
                            if($update){
                            echo'<script>alert("berhasil mengubah profil")</script>';
                            echo'<script>window.location="profil.php"</script>';
                            }else{
                                echo'gagal' .mysqli_error($conn);
                            }
                        }
                        
                    ?>
                </div>
                <h3>Ubah Password</h3>
                <div class="box">
                    <form action='' method="POST">
                        <input type="password" name="pass1" placeholder="Password baru" class="input-control" required>
                        <input type="password" name="pass2" placeholder="konfirmasi" class="input-control" required>
                        <input type="submit" name="ubah_password" value="ubah" class="btn-login">
                    </form>
                    <?php
                        if(isset($_POST['ubah_password'])){
                            $pass1   =$_POST['pass1'];
                            $pass2   =$_POST['pass2'];

                            if($pass2 != $pass1){
                                echo'<script>alert("konfirmasi password anda salah")</script>';
                            }else{
                                 $u_pass = mysqli_query($conn,"UPDATE admin SET
                                            password='".MD5($pass1)."'
                                            WHERE admin_id='".$d->admin_id."' ");
                                 if($u_pass){
                                     echo'<script>alert("berhasil mengubah password")</script>';
                                     echo'<script>window.location="profil.php"</script>';
                                 }else{
                                      echo'gagal' .mysqli_error($conn);
                                 }
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