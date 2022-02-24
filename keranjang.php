<?php 
session_start();
	error_reporting(0);
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM admin WHERE admin_id = 1");
	$a = mysqli_fetch_object($kontak);

	$produk = mysqli_query($conn, "SELECT * FROM produk WHERE product_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_array($produk);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TokoONline</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
	<!-- header -->
	<header>
		<div class="container">
			<h1><a href="user.php">TokoOnline</a></h1>
			<ul>
				<li><a href="user.php">home</a></li>
                <li><a href="histori.php">histori</a></li>
				<li><a href="produk.php">Produk</a></li>
			</ul>
		</div>
	</header>

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!-- product detail -->
	<div class="section">
		<div class="container">
			<h3>keranjang</h3>
			<div class="box">
                <table border="1" cellspacing="0" class="table">
                    
                    <thead>
                    <tr>
                    <th>NO</th><th>Nama Produk</th><th>Jumlah</th><th>Total</th><th>Aksi</th>
                    </tr>
                    </thead>

					<tbody>
                            <?php
                            if(@$_SESSION['cart'] != null){
                            foreach(@$_SESSION['cart'] as $list_produk => $item_produk):?>
                            <?php 
                                $total=$item_produk['product_price'] * $item_produk['qty'];
                            ?>
                            <tr>
                                <td><?=($list_produk+1)?></td>
                                <td><?=$item_produk['product_name']?></td>
                                <td><?=$item_produk['qty']?></td>
                                <td>Rp.<?php echo number_format($total)?></td>
                                <td align="center"><a href="checkout.php" class="button-tambah">Check Out</a>
                                <a href="hapus-cart.php?id=<?=$list_produk?>" class="button-hapus">Clear</a></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
			
						<?php 
                        }
                        $var="tidak ada barang dalam keranjang";
                        if($_SESSION['cart'] == null){
                    ?>
                    <tr>
                        <td align="center" coolspan=5><?php echo $var; } ?></td>
                    </tr>
                        </table>
                        <br>
                    <a href="user.php" class="button-tambah">kembali</a>
                    
                    
                        
                    
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footer">
		<div class="container">
			<h4>Alamat</h4>
			<p><?php echo $a->admin_address ?></p>

			<h4>Email</h4>
			<p><?php echo $a->admin_email ?></p>

			<h4>No. Hp</h4>
			<p><?php echo $a->admin_telp ?></p>
			<small>Copyright &copy; 2021 - Fachrurozi rizky</small>
		</div>
	</div>
</body>
</html>