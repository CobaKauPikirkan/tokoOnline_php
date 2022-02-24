<?php
if($_POST){
$username=$_POST['username'];
$password=$_POST['password'];
if(empty($username)){
    echo "<script>alert('Username tidak boleh kosong');location.href='login.php';</script>";
} elseif(empty($password)){
    echo "<script>alert('Password tidak boleh kosong');location.href='login.php';</script>";
} else {
    include "db.php";
    $qry_login=mysqli_query($conn,"select * from admin where username = '".$username."' and password = '".md5($password)."'");
        if(mysqli_num_rows($qry_login)>0){
    $dt_login=mysqli_fetch_array($qry_login);
        session_start();
        $_SESSION['admin_id']=$dt_login['admin_id'];
        $_SESSION['admin_name']=$dt_login['admin_name'];
    if($dt_login['level'] == 1){
        $_SESSION['status_login']=true;
        echo "<script>window.location='dashboard.php'</script>";
    }else if($dt_login['level'] == 2){
        $_SESSION['status_login']=true;
        echo "<script>window.location='user.php'</script>";
    }
//header("location: dashboard.php");
} else {
echo "<script>alert('Username dan Password tidak benar');location.href='login.php';</script>";
}
}
}
?>