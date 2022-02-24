<?php 
session_start();
if($_SESSION['status_login']!=true){
header('location: login.php');
}
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM admin WHERE admin_id = 6");
	$a = mysqli_fetch_object($kontak);
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
                <h1><a href="user.php">TokoOnline</a></h1>
                <ul>
                    <li><a href="user.php">home</a></li>
                    <li><a href="histori.php">histori</a></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="produk.php" class="button-jual">Produk</a></li>   
                    <li><a href="keluar.php">keluar</a></li>
                </ul>
            </div>
        </header>

         <div class="search">
             <div class="container">
                 <form action="produk.php">
                     <input type="text" name="search" placeholder="search">
                     <input type="submit" name ="cari" placeholder="search">
                 </form>
             </div>
         </div>

        <div class="section">
            <div class="container">
                <h3>Kategori</h3>
                <div class="box"> 
                    <?php 
                        $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY category_id DESC");
					    if(mysqli_num_rows($kategori) > 0){
						    while($k = mysqli_fetch_array($kategori)){
                    ?>
                    <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                    <div class="col-6">
                        <img src="img/icon-kategori.png" width="50px" style="margin-bottom:5px;">
                        <p><?php echo $k['category_name'] ?></p>
                    </div>
                    </a>
				<?php }}else{ ?>
					<p>Kategori tidak ada</p>
				<?php } ?>
                </div>
            </div>
        </div>

         <div class="section">
            <div class="container">
                <h3>Produk terbaru</h3>
                <div class="box"> 
                    <?php 
                        $produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY product_id DESC LIMIT 8");
					    if(mysqli_num_rows($produk) > 0){
						    while($p = mysqli_fetch_array($produk)){
                    ?>
                    <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                    <div class="col-4">
                        <img src="produk/<?php echo $p['product_image'] ?>">
                        <p class="nama"><?php echo $p['product_name']?></p>
                        <p class="harga">Rp. <?php echo number_format($p['product_price'])  ?></p>
                    </div>
                 <?php }} else{ ?>
                    <p>Produk tidak ada</p>

                <?php } ?>
                </div>
            </div>
        </div>

        
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