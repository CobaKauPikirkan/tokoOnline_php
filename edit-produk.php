<?php
session_start();
include'db.php';
if($_SESSION['status_login']!=true){
header('location: login.php');
}
    $produk = mysqli_query($conn, "SELECT * FROM produk WHERE product_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk) == 0){
		echo '<script>window.location="data-produk.php"</script>';
	}
	$p = mysqli_fetch_object($produk);

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width= device-width, initial-scale=1">
        <title>Toko ONLINE</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
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
                <h3>Edit Produk</h3>
                <div class="box">
                    <form action='' method="POST" enctype="multipart/form-data">
                        <select class="input-control" name="kategori" required>
						<option value="">--Pilih--</option>
						<?php 
							$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY category_id DESC");
							while($r = mysqli_fetch_array($kategori)){
						?>
						<option value="<?php echo $r['category_id'] ?>"<?php echo ($r['category_id'] == $p->category_id)? 'selected':''; ?>><?php echo $r['category_name'] ?></option>
						<?php } ?>
					</select>
                        <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
                        <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
                        
                        <img src="produk/<?php echo $p->product_image ?>" width="100px">
					    <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                        <input type="file" name="gambar" class="input-control">
                        <textarea class="input-control" name="deskripsi" placeholder="Deskripsi" id="" cols="30" rows="10"><?php echo $p->product_description ?></textarea>
                        <select name="status" class="input-control">
                            <option value="">--PILIH--</option>
                            <option value="1" <?php echo ($p->product_status == 1)? 'selected':''; ?>>Aktif</option>
                            <option value="0" <?php echo ($p->product_status == 0)? 'selected':''; ?>>Non Aktif</option>
                        </select>
                        <input type="submit" name="submit" value="ubah " class="btn-login">
                    </form>
                   <?php 
					if(isset($_POST['submit'])){
                        						// data inputan dari form
						$kategori 	= $_POST['kategori'];
						$nama 		= $_POST['nama'];
						$harga 		= $_POST['harga'];
						$deskripsi 	= $_POST['deskripsi'];
						$status 	= $_POST['status'];
						$foto 	 	= $_POST['foto'];

						// foto baru
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

						

						//if ganti gambar
						if($filename != ''){
							$type1 = explode('.', $filename);
							$type2 = $type1[1];

							$newname = 'produk'.time().'.'.$type2;

							// menampung data file yang diizinkan
							$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

							// validasi format file
							if(!in_array($type2, $tipe_diizinkan)){
								// if format file tidak ada di dalam tipe diizinkan
								echo '<script>alert("Format file tidak diizinkan")</scrtip>';

							}else{
								unlink('./produk/'.$foto);
								move_uploaded_file($tmp_name, './produk/'.$newname);
								$namagambar = $newname;
							}

						}else{
							// tidak jadi
							$namagambar = $foto;
							
						}

						// update data produk
						$update = mysqli_query($conn, "UPDATE produk SET 
												category_id = '".$kategori."',
												product_name = '".$nama."',
												product_price = '".$harga."',
												product_description = '".$deskripsi."',
												product_image = '".$namagambar."',
												product_status = '".$status."'
												WHERE product_id = '".$p->product_id."'	");
						if($update){
							echo '<script>alert("Ubah data berhasil")</script>';
							echo '<script>window.location="data-produk.php"</script>';
						}else{
							echo 'gagal '.mysqli_error($conn);
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
        <script>
        CKEDITOR.replace( 'deskripsi' );
        </script>
    </body>
</html>