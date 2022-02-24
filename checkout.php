<?php
session_start();
include "db.php";
$cart=@$_SESSION['cart'];
if(count($cart)>0){
//$lama_pinjam=5; //satuan hari
//$timestamp = 1234567890;
//$tgl_harus_kembali=date('Y-m-d',mktime(0,0,0,date('m'),(date('d')+$lama_pinjam),date('Y')));
//$stringDate = date('d-m-Y H:i', $timestamp);
mysqli_query($conn,"insert into transaksi(admin_id)value('".$_SESSION['admin_id']."')");//'".date('d-m-Y H:i')."',

$id=mysqli_insert_id($conn);
foreach ($cart as $list_produk => $item_produk) {
    $total=$item_produk['product_price'] * $item_produk['qty'];
    mysqli_query($conn,"insert into detail_transaksi(id_transaksi,product_id,qty,subtotal)value('".$id."','".$item_produk['product_id']."','".$item_produk['qty']."','".$total."')");
    }
unset($_SESSION['cart']);
echo '<script>alert("Berhasil menambahkan , silahkan bayar:)");location.href="histori.php"</script>';
}
?>