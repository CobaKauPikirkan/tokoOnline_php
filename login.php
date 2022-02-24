<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width= device-width, initial-scale=1">
        <title>LOGIN Toko ONLINE</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    </head>
    <!-- <body id="bg-login">
        <div class="box-login">
            <h2>Login</h2>
            <form action="proses_login.php" method="POST">
                <input type="text" name="username" placeholder="username" value="" class="input-control">
              
                <input type="password" name="password" placeholder="Password" class="input-control">
                <input type="submit" name="submit" value="login" class="btn-login">
                <td><a href="daftar.php" class="daftar-button">Daftar</a></td>
            </form>
            
        </div>
        
    </body> -->
    <body>
  <div id="card">
    <div id="card-content">
      <div id="card-title">
        <h2>LOGIN</h2>
        <div class="underline-title"></div>
      </div>
      <form action="proses_login.php" method="post" class="form">
        <label for="user-email" style="padding-top:13px">
            &nbsp;Username
          </label>
        <input id="user-email" class="form-content" type="text" name="username" autocomplete="on" required />
        <div class="form-border"></div>
        <label for="user-password" style="padding-top:22px">&nbsp;Password
          </label>
        <input id="user-password" class="form-content" type="password" name="password" required />
        <div class="form-border"></div>
        <!-- <a href="#">
          <legend id="forgot-pass">Forgot password?</legend>
        </a> -->
        <input id="submit-btn" type="submit" name="submit" value="LOGIN" />
        <a href="daftar.php" id="signup">Don't have account yet?</a>
      </form>
    </div>
  </div>
</body>
</html>
