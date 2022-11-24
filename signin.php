<?php
session_start();

if (isset($_SESSION['user'])) {
    if (count($_SESSION['user']) >= 1) {
        header("Location: ../index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-In E-Presence SKIEL</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="text-center">
    
    <main class="form-signin w-100 m-auto">
      <form style="width: 350px;" class="mx-auto my-5 py-5" action="../db/signin.php" method="POST">
      <?php
          if (isset($_SESSION['message']['danger'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['message']['danger'].'</div>';
              unset($_SESSION['message']['danger']);
          }
          ?>
        <img class="mb-4" src="../assets/images/logo-sekolah.png" style="width: 90px">
        <h1 class="h3 mb-3 fw-normal">Masuk Aplikasi</h1>
          <input type="text" name="signin" value="1" hidden>
        <div class="form-floating pb-3">
          <input type="text" class="form-control" id="form-signin-username" name="username">
          <label for="floatingInput">Alamat E-Mail / No. Telepon / ID Pengenal</label>
        </div>
        <div class="form-floating pb-3">
          <input type="password" class="form-control" id="form-signin-password" placeholder="Password" name="password">
          <label for="floatingPassword">Password</label>
        </div>
    
        <div class="checkbox mb-3">
          <label class="d-flex align-items-center">
            <input class="me-3" type="checkbox" value="remember-me"> Otomatis Masuk Lain Kali
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary mb-3" type="submit" id="form-signin-button-action">Masuk</button>
          <p>Belum memiliki akun ? <a href="./signup.php">Daftar Disini</a></p>
        <p class="mt-5 mb-3 text-muted">SMKN 1 GUNUNGPUTRI - 2022</p>
      </form>
    </main>
    
    
        
      
    
    </body>
<script src="../assets/fontawesome/all.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/popper/popper.min.js"></script>
    <script src="../assets/script.js"></script>
</html>