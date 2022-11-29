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
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Sign-In E-Presence SKIEL</title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body class="text-center">
    <main class="form-signin w-100 m-auto">
      <form style="width: 350px;" class="mx-auto my-5" id="form-signup" action="../db/signup.php" method="POST">
          <?php
          if (isset($_SESSION['message']['danger'])) {
              echo '<div class="alert alert-danger" role="alert">'.$_SESSION['message']['danger'].'</div>';
              unset($_SESSION['message']['danger']);
          }
          ?>
        <img class="mb-4" src="./assets/images/logo-sekolah.png" style="width: 90px">
        <h1 class="h3 mb-3 fw-normal">Pendaftaran Pengguna Baru</h1>
        <div class="form-floating pb-3">
            <input name="add_user" value="1" hidden>
          <input type="text" class="form-control" id="form-signup-name" name="name">
          <label for="form-signup-name">Nama Lengkap</label>
        </div>
        <div class="form-floating pb-3">
          <input type="text" class="form-control" id="form-signup-username" name="username">
          <label for="form-signup-username">Username</label>
        </div>
        <div class="form-floating pb-3">
          <input type="email" class="form-control" id="form-signup-email" name="email">
          <label for="form-signup-email">Alamat E-Mail</label>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">+62</span>
          <div class="form-floating">
            <input type="text" class="form-control" id="form-signup-phone" name="phone">
            <label for="form-signup-phone">Nomor Telepon</label>
          </div>
        </div>
        <select class="form-select mb-3" aria-label="Default select example" id="form-signup-role" name="role">
          <option selected>Peran Pengguna Baru</option>
          <option value="student">Sekretaris</option>
          <option value="teacher">Guru</option>
          <option value="admin">Admin</option>
        </select>
        <div class="form-floating pb-3">
          <input type="password" class="form-control" id="form-signup-password" placeholder="Password" name="password">
          <label for="form-signup-password">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" id="form-signup-button-action">Daftar</button>
        <p class="mt-5 mb-3 text-muted">SMKN 1 GUNUNGPUTRI - 2022</p>
      </form>
    </main>
    </body>

    <script src="./assets/fontawesome/all.min.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/popper/popper.min.js"></script>
    <script src="./assets/script.js"></script>
</html>