<?php
    session_start();
    include "db.php";
    $produk=mysqli_query($conn,"SELECT* FROM produk WHERE product_id = '".$_GET['id']."'");
    $p=mysqli_fetch_array($produk);
    $_SESSION['cart'][]=array('product_id'=>$p['product_id'],'product_name'=>$p['product_name'],'product_price'=>$p['product_price'],'qty'=>$_GET['qty']);
    echo"<script>location='keranjang.php'</script>";
    // echo $_GET['id'];   
?>