<?php 
session_start();
	error_reporting(0);
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM admin WHERE admin_id = 6");
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
			<h3>Histori</h3>
			<div class="box">
                <table border="1" cellspacing="0" class="table">
                   <thead>
    <th>NO</th><th>Tanggal transaksi</th><th>Nama produk</th><th>Status</th><th>Aksi</th>
</thead>
<tbody>
        <?php
            $qry_histori=mysqli_query($conn,"SELECT * FROM transaksi WHERE admin_id=".$_SESSION['admin_id']." ORDER BY id_transaksi DESC");
            $no=0;
            while($dt_histori=mysqli_fetch_array($qry_histori)){
                if($dt_histori['id_transaksi'!=null]){
            $no++;
            $produk_checkout="<ol>";
            $produk=mysqli_query($conn,"SELECT* FROM detail_transaksi JOIN produk ON produk.product_id=detail_transaksi.product_id WHERE id_transaksi =".$dt_histori['id_transaksi']);
            while($p=mysqli_fetch_array($produk)){
                if($p['product_id']!=null){
                    $produk_checkout.=$p['product_name'];
                }
            }
            $produk_checkout.="</ol>";
            $qry_cek_bayar=mysqli_query($conn,"SELECT * FROM bayar WHERE id_transaksi ='".$dt_histori['id_transaksi']."'");
            if(mysqli_num_rows($qry_cek_bayar)>0){
                $dt_bayar=mysqli_fetch_array($qry_cek_bayar);
                $status_bayar="<label class='alert alert-success'>Sudah bayar</label>";
        
                $button_bayar="<a href='hapus_histori.php?id=".$dt_histori['id_transaksi']."' class='button-hapus'><strong>X</strong></a>";
                } else {
        
                $status_bayar="<label class='alert alert-danger'>Belum bayar</label>";
        
                $button_bayar="<a href='bayar.php?id=".$dt_histori['id_transaksi']."' class='button-check' onclick='return confirm(\"Apakah anda yakin untuk membayar?\")'>Bayar</a>";
                }
            }
        ?>
            <tr>
                <td><?=$no?></td>
                <td><?=$dt_histori['tgl_transaksi']?></td>
                <td><?=$produk_checkout?></td>
                <td align="center"><?=$status_bayar?></td>
                <td align="center"><?=$button_bayar?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
                </table>
                        <br>
                    <!-- <a href="user.php" class="button-tambah">kembali</a> -->
                    
                    
                        
                    
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