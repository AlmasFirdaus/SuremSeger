<?php
require_once("./functions.php");

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "
            <script> 
                alert('User baru berhasil ditambahkan');
                document.location.href = 'login.php';
            </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />

    <title>Register | SuremSeger.ID</title>
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
                <div class="title-login fs-4">Register</div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->

    <!-- Form Register  -->
    <div class="container mt-5">
        <div class="row g-3 justify-content-center">
            <div class="col-md-8">
                <div class="box-register" id="box-register">

                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="regnamalengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="regnamalengkap" id="regnamalengkap" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="regemail" class="form-label">Email</label>
                                <input type="email" class="form-control" name="regemail" id="regemail" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="regnohp" class="form-label">No HP</label>
                                <input type="text" class="form-control" name="regnohp" id="regnohp" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="regpassword" class="form-label">Password</label>
                                <input type="password" class="form-control" name="regpassword" id="regpassword" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="regpassword2" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="regpassword2" id="regpassword2" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="regalamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="regalamat" id="regalamat" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="regprovinsi" class="form-label">Provinsi</label>
                                <input type="text" class="form-control" name="regprovinsi" id="regprovinsi" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="regkota" class="form-label">Kota</label>
                                <input type="text" class="form-control" name="regkota" id="regkota" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="regkecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" name="regkecamatan" id="regkecamatan" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="regkodepos" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control" name="regkodepos" id="regkodepos">
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                <a href="login.php">
                                    <button type="button" class="btn btn-outline-secondary">Sudah punya akun?</button>
                                </a>
                                <a href="login.php">
                                    <button type="submit" name="register" class="btn btn-primary">Sign up</button>
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#c7d0d8" fill-opacity="1" d="M0,256L24,240C48,224,96,192,144,176C192,160,240,160,288,165.3C336,171,384,181,432,202.7C480,224,528,256,576,272C624,288,672,288,720,277.3C768,267,816,245,864,240C912,235,960,245,1008,256C1056,267,1104,277,1152,272C1200,267,1248,245,1296,229.3C1344,213,1392,203,1416,197.3L1440,192L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
    </svg>
    <!-- Akhir Form Register -->

    <footer class="text-center pb-1" style="background:  #c7d0d8">
        <p>©Copyright <label class="fw-bold">Susu Rembangan</label>. All Rights Reserved</p>
    </footer>

</body>

</html>