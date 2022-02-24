<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title></title>
    </head>
<body>
<h3 align="center">Daftar</h3>
    <form action="proses_daftar.php" method="post">
        nama :

        <input type="text" name="admin_name" value="" class="form-control">
        Username :

        <input type="text" name="username" value="" class="form-control">

        Password :

        <input type="password" name="password" value="" class="form-control">

        Nomor Telpon:

        <input type="text" name="admin_telp" value="" class="form-control">
        Email :

        <input type="text" name="admin_email" value="" class="form-control">
        alamat :

        <input type="text" name="admin_address" value="" class="form-control">
     
        
        <td><a href="login.php"class="btn btn-warning">Kembali</a></td>
        <input type="submit" name="simpan" value="Daftar" class="btn btn-primary">
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>