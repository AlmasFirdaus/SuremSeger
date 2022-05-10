<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

// if ($_SESSION['role'] != 2) {
//     header("Location: ../Admin/indexAdmin.php");
//     exit;
// }
// echo "<br><br><br>";
// echo "<pre>";
// print_r($_SESSION['user']);
// echo "</pre>";

require_once('../functions.php');
$id_user = $_SESSION['user']['id'];
$user = query("SELECT * FROM users WHERE id = $id_user")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // var_dump($_POST);
    // cek apakah data berhasil di ubah atau tidak
    if (ubah($_POST, $id_user) > 0) {
        // $success = true;
        // header('Location: profileAdmin.php');
        echo "
            <script> 
                alert('Data berhasil diubah');
                document.location.href = './profileUser.php';
            </script>
            ";
    } else {
        echo "
        <script> 
        alert('Data gagal diubah');
        document.location.href = './profileUser.php';
        </script>
        ";
    }
    // $success = false;
};


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../style.css" />

    <title>Profile | SuremSeger.ID</title>
</head>

<body>

    <!-- Navbar - Sidebar -->
    <?php include 'nav_sidebar.php' ?>

    <!-- Form Register  -->
    <section id="form">
        <div class="container mt-5">
            <div class="row g-3 justify-content-center">
                <div class="col-8">
                    <div class="box-register" id="box-profile">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row justify-content-center">
                                <div class="col-md-3 mb-3 ">
                                    <img src="../assets/img/profil_user/<?= $user['gambar']; ?>" class="profileuser" id="profileuser" width="150" height="150" alt="" style="border-radius: 50%;">
                                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, voluptates.</p> -->
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-6 mb-3">
                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Upload Profile</label>
                                            <input class="form-control" type="file" name="gambar" id="gambar">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="profnamalengkap" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="namalengkap" id="namalengkap" value="<?= $user['namalengkap']; ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="profemail" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?= $user['email']; ?>">
                                    </div>
                                    <div class=" col-md-6 mb-3">
                                        <label for="profnohp" class="form-label">No HP</label>
                                        <input type="text" class="form-control" name="nohp" id="nohp" value="<?= $user['nohp']; ?>">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="profalamat" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" name="alamat" id="alamat" value="<?= $user['alamat']; ?>">
                                    </div>
                                    <div class=" col-md-6 mb-3">
                                        <label for="profprovinsi" class="form-label">Provinsi</label>
                                        <input type="text" class="form-control" name="provinsi" id="provinsi" value="<?= $user['provinsi']; ?>">
                                    </div>
                                    <div class=" col-md-6 mb-3">
                                        <label for="profkota" class="form-label">Kota</label>
                                        <input type="text" class="form-control" name="kota" id="kota" value="<?= $user['kota']; ?>">
                                    </div>
                                    <div class=" col-md-6 mb-3">
                                        <label for="profkecamatan" class="form-label">Kecamatan</label>
                                        <input type="text" class="form-control" name="kecamatan" id="kecamatan" value="<?= $user['kecamatan']; ?>">
                                    </div>
                                    <div class=" col-md-6 mb-3">
                                        <label for="profkodepos" class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" name="kodepos" id="kodepos" value="<?= $user['kodepos']; ?>">
                                    </div>
                                    <div class=" d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                        <a href="./gantiPassword.php">
                                            <button type="button" name="gantipassword" class="btn btn-outline-secondary">Ganti Password</button>
                                        </a>
                                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                    </div>
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
    </section>
    <!-- Akhir Form Register -->

    <footer class="text-center pb-1" style="background:  #c7d0d8">
        <p>©Copyright <label class="fw-bold">Susu Rembangan</label>. All Rights Reserved</p>
    </footer>

</body>

</html>