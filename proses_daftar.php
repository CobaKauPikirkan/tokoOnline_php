<?php
if($_POST){
$nama_penjual=$_POST['admin_name'];
$username=$_POST['username'];
$password= $_POST['password'];
$telp=$_POST['admin_telp'];
$email=$_POST['admin_email'];
$address=$_POST['admin_address'];
    if(empty($nama_penjual)){
    echo "<script>alert('nama tidak boleh kosong');location.href='daftar.php';</script>";
    } elseif(empty($username)){
    echo "<script>alert('username tidak boleh kosong');location.href='daftar.php';</script>";
    } elseif(empty($password)){
    echo "<script>alert('password tidak boleh kosong');location.href='daftar.php';</script>";
} else {
    include "db.php";
    $insert=mysqli_query($conn,"insert into admin(admin_name, username, password, admin_telp, admin_email, admin_address)value('".$nama_penjual."','".$username."','".md5($password)."','".$telp."','".$email."','".$alamat."')") or
    die(mysqli_error($conn));
        if($insert){
        echo "<script>alert('Sukses mendaftarkan');location.href='daftar.php';</script>";
        } else {
        echo "<script>alert('Gagal mendaftarkan');location.href='daftar.php';</script>";
        }
}
}
?>