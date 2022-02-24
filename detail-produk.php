<?php 
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
	<title>TokoOnline</title>
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
			<h3>Detail Produk</h3>
			<div class="box">
				<div class="col-2">
					<img src="produk/<?php echo $p['product_image'] ?>" width="100%">
				</div>
			<!-- <form action="masukkankeranjang.php?product_id=<?=$p['product_id']?>"method="post"> -->
				<div class="col-2">
					<h3><?php echo $p['product_name'] ?></h3>
					<h4>Rp. <?php echo number_format($p['product_price']) ?></h4>
					<p>Deskripsi :<br>
						<?php echo $p['product_description'] ?>
					</p>
					
					 <td>Jumlah yang dibeli  </td><td><input type="number"id="jumlah_beli" value="1"></td>
					<br>
					<br><br>
					 <td><a onclick="addtocart()" class="button-tambah">beli</a></td>
					 
					 <!-- <td><input type="submit" class="button-tambah" value="Beli"></td> -->
				</div>
			<!-- </form> -->
			</div>
		</div>
	</div>

	<!-- footer -->
	<!-- <div class="footer">
		<div class="container">
			
			<small>Copyright &copy; 2021 - Fachrurozi rizky</small>
		</div>
	</div> -->
</body>

</html>
<script>
    //href="masukkan_keranjang.php?id=<?php echo $p['product_id']?>&qty=<?php echo $_GET['jumlah_beli']?>"
    function addtocart(){
        var id=<?php echo $p['product_id']?>;
        var qty=document.getElementById("jumlah_beli").value; 
        location="masukkankeranjang.php?id="+id+"&qty="+qty;
    }
</script>
