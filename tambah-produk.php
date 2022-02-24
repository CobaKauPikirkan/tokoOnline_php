<?php
session_start();
include'db.php';
if($_SESSION['status_login']!=true){
header('location: login.php');
}

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
                <h3>Tambah Produk</h3>
                <div class="box">
                    <form action='' method="POST" enctype="multipart/form-data">
                        <select class="input-control" name="kategori" required>
						<option value="">--Pilih--</option>
						<?php 
							$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY category_id DESC");
							while($r = mysqli_fetch_array($kategori)){
						?>
						<option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
						<?php } ?>
					</select>
                        <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                        <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                        <input type="file" name="gambar" class="input-control" required>
                        <textarea class="input-control" name="deskripsi" placeholder="Deskripsi" id="" cols="30" rows="10"></textarea><br>
                        <select name="status" class="input-control">
                            <option value="">--PILIH--</option>
                            <option value="1">Aktif</option>
                            <option value="0">Non Aktif</option>
                        </select>
                        <input type="submit" name="submit" value="tambah" class="btn-login">
                    </form>
                   <?php 
					if(isset($_POST['submit'])){

						// print_r($_FILES['gambar']);
						// menampung inputan dari form
						$kategori 	= $_POST['kategori'];
						$nama 		= $_POST['nama'];
						$harga 		= $_POST['harga'];
						$deskripsi 	= $_POST['deskripsi'];
						$status 	= $_POST['status'];

						// menampung data file yang diupload
						$filename = $_FILES['gambar']['name'];
						$tmp_name = $_FILES['gambar']['tmp_name'];

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'produk'.time().'.'.$type2;

						// menampung data format file yang diizinkan
						$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

						// validasi format file
						if(!in_array($type2, $tipe_diizinkan)){
							// jika format file tidak ada di dalam tipe diizinkan
							echo '<script>alert("Format file tidak diizinkan")</scrtip>';

						}else{
							// jika format file sesuai dengan yang ada di dalam array tipe diizinkan
							// proses upload file sekaligus insert ke database
							move_uploaded_file($tmp_name, './produk/'.$newname);

							$insert = mysqli_query($conn, "INSERT INTO produk VALUES (
										null,
										'".$kategori."',
										'".$nama."',
										'".$harga."',
										'".$deskripsi."',
										'".$newname."',
										'".$status."',
										null
											) ");

							if($insert){
								echo '<script>alert("Tambah data berhasil")</script>';
								echo '<script>window.location="data-produk.php"</script>';
							}else{
								echo 'gagal '.mysqli_error($conn);
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
        <script>
        CKEDITOR.replace( 'deskripsi' );
        </script>
    </body>
</html>