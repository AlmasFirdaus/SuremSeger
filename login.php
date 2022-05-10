<?php
require_once("functions.php");

session_start();


if (isset($_SESSION['login'])) {
  header("Location: User/indexUser.php");
  exit;
}



if (isset($_POST["login"])) {

  $email = $_POST["email"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE email LIKE '%$email%' OR nohp LIKE '%$email%' ");

  if (empty($email) or empty($password)) {
    $error1 = true;
  }

  // cek username
  if (mysqli_num_rows($result)) {
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' OR nohp = '$email' ");

    if (mysqli_num_rows($result) === 1) {

      // cek password
      $row = mysqli_fetch_assoc($result);

      if (password_verify($password, $row['password'])) {

        $_SESSION["login"] = true;
        $_SESSION["role"] = $row['role'];
        $_SESSION["user"] = $row;

        header("Location: User/indexUser.php");
        exit;
      }
    }
    $error2 = true;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />

  <title>Login | SuremSeger.ID</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-sm navbar-light shadow-sm" id="navbar">
    <div class="container d-flex justify-content-start">
      <a class="navbar-brand" href="index.php">
        <img src="./assets/img/sapi icon.png" alt="" width="30" height="24" class="d-inline-block align-text-top" />
        Surem Seger
      </a>
      <div class="hstack gap-3">
        <div class="vr"></div>
        <div class="title-login fs-4">Log in</div>
      </div>
    </div>
  </nav>
  <!-- Akhir Navbar -->

  <!--  Login  -->
  <div class="container" id="login">
    <div class="row g-0 justify-content-center align-items-center">
      <div class="col-md-8">
        <div class="box-login">
          <div class="row d-flex justify-content-end">
            <div class="col-md-6">
              <div class="card-body ">
                <h5 class="card-title">Login</h5>
                <?php if (isset($error1)) : ?>
                  <p style="color: red; font-style:italic;">Mohon isi username dan password</p>
                <?php elseif (isset($error2)) : ?>
                  <p style="color: red; font-style:italic;">Mohon periksa kembali E-mail dan Password Anda</p>
                <?php endif; ?>

                <form action="" method="POST">
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="email" />
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" />
                  </div>
                  <p>Belum memiliki akun ? klik <a href="registerAkun.php">klik disini</a></p>
                  <div class=" gap-2 d-flex justify-content-end">
                    <a href="index.php">
                      <button type="button" class="btn btn-outline-secondary">Kembali</button>
                    </a>
                    <a href="profileUser.php">
                      <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </a>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#c7d0d8" fill-opacity="1" d="M0,256L24,240C48,224,96,192,144,176C192,160,240,160,288,165.3C336,171,384,181,432,202.7C480,224,528,256,576,272C624,288,672,288,720,277.3C768,267,816,245,864,240C912,235,960,245,1008,256C1056,267,1104,277,1152,272C1200,267,1248,245,1296,229.3C1344,213,1392,203,1416,197.3L1440,192L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
  </svg>

  <!-- Akhir Login -->
  <footer class="text-center pb-1" style="background:  #c7d0d8">
    <p>©Copyright <label class="fw-bold">Susu Rembangan</label>. All Rights Reserved</p>
  </footer>
</body>

</html>