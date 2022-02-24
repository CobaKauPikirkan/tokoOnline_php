<?php
if($_GET['id']){
include "db.php";
$id_transaksi=$_GET['id'];
mysqli_query($conn, "insert into bayar(id_transaksi, tanggal_bayar)value('".$id_transaksi."','".date('Y-m-d')."')");
header('location: histori.php');
}
?>