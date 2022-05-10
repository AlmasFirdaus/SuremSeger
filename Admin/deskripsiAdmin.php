<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['role'] != 1) {
    header("Location: ../User/indexUser.php");
    exit;
}

require_once('../functions.php');
$id = $_SESSION['user']['id'];
$user = query("SELECT * FROM users WHERE id = $id")[0];
$deskripsi = query("SELECT * FROM deskripsi WHERE id = 1")[0];
$about = query("SELECT * FROM about WHERE id = 1")[0];
$product = query("SELECT * FROM produk");
$contact = query("SELECT * FROM contact")[0];


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submithome"])) {
    // var_dump($_POST);
    // cek apakah data berhasil di ubah atau tidak
    if (updatehome($_POST) > 0) {
        // $success = true;
        // header('Location: profileAdmin.php');
        echo "
            <script> 
                alert('Data home berhasil diubah');
                document.location.href = './deskripsiAdmin.php';
            </script>
            ";
    } else {
        echo "
        <script> 
        alert('Data home gagal diubah');
        document.location.href = './deskripsiAdmin.php';
        </script>
        ";
    }
    // $success = false;
};
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submitabout"])) {
    // var_dump($_POST);
    // cek apakah data berhasil di ubah atau tidak
    if (updateabout($_POST) > 0) {
        // $success = true;
        // header('Location: profileAdmin.php');
        echo "
            <script> 
                alert('Data about berhasil diubah');
                document.location.href = './deskripsiAdmin.php';
            </script>
            ";
    } else {
        echo "
        <script> 
        alert('Data about gagal diubah');
        document.location.href = './deskripsiAdmin.php';
        </script>
        ";
    }
    // $success = false;
};
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submitcontact"])) {
    // var_dump($_POST);
    // cek apakah data berhasil di ubah atau tidak
    if (updatecontact($_POST, $id) > 0) {
        // $success = true;
        // header('Location: profileAdmin.php');
        echo "
            <script> 
                alert('Data contact berhasil diubah');
                document.location.href = './deskripsiAdmin.php';
            </script>
            ";
    } else {
        echo "
        <script> 
        alert('Data contact gagal diubah');
        document.location.href = './deskripsiAdmin.php';
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

    <!-- Navbar Sidebar Admin -->
    <?php include 'nav_sidebar.php' ?>

    <!-- Form Register  -->
    <section id="form">
        <div class="container mt-5">
            <div class="row g-3 justify-content-center">
                <div class="col-8">
                    <div class="box-register" id="box-profile">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <h2>HOME</h2>
                            <div class="row justify-content-center">
                                <div class="col-md-3 mb-3 ">
                                    <img src="../assets/img/dashboard/<?= $deskripsi['gambar']; ?>" class="gambar" id="profileuser" width="150" height="150" alt="" style="border-radius: 50%;">
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-6 mb-3">
                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Upload Gambar</label>
                                            <input class="form-control" type="file" name="gambar" id="gambar">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="judulhome" class="form-label">Judul</label>
                                        <input type="text" class="form-control" name="judulhome" id="judulhome" value="<?= $deskripsi['judul']; ?>">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="deskripsihome" class="form-label">Deskripsi</label>
                                        <!-- <input type="text" class="form-control" name="deskripsihome" id="deskripsihome" value="<?= $deskripsi['deskripsi']; ?>"> -->
                                        <textarea class="form-control" name="deskripsihome" id="deskripsihome" cols="30" rows="10"><?= $deskripsi['deskripsi']; ?></textarea>
                                    </div>

                                    <div class=" d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                        <button type="submit" name="submithome" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row g-3 justify-content-center">
                <div class="col-8">
                    <div class="box-register" id="box-profile">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <h2>ABOUT</h2>
                            <div class="row justify-content-center">
                                <div class="col-md-3 mb-3 ">
                                    <img src="../assets/img/dashboard/<?= $about['gambar']; ?>" class="profileuser" id="profileuser" width="150" height="150" alt="" style="border-radius: 50%;">
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-6 mb-3">
                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Upload Gambar</label>
                                            <input class="form-control" type="file" name="gambar" id="gambar">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="deskripsiabout" class="form-label">Deskripsi</label>
                                        <!-- <input type="text" class="form-control" name="deskripsiabout" id="deskripsiabout" value="<?= $about['deskripsi_about']; ?>"> -->
                                        <textarea class="form-control" name="deskripsiabout" id="deskripsiabout" cols="30" rows="10"><?= $about['deskripsi_about']; ?></textarea>
                                    </div>

                                    <div class=" d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                        <button type="submit" name="submitabout" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row g-3 justify-content-center">
                <div class="col-8">
                    <div class="box-register" id="box-profile">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <h2 class="mb-5">Contact</h2>
                            <div class="row justify-content-center">
                                <div class="col-md-12 mb-3">
                                    <label for="lokasi" class="form-label">lokasi:</label>
                                    <input type="text" class="form-control" name="lokasi" id="lokasi" value="<?= $contact['lokasi']; ?>">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="jambuka" class="form-label">Jam Buka:</label>
                                    <input type="text" class="form-control" name="jambuka" id="jambuka" value="<?= $contact['jambuka']; ?>">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="nohp" class="form-label">No HP:</label>
                                    <input type="text" class="form-control" name="nohp" id="nohp" value="<?= $contact['nohp']; ?>">
                                </div>

                                <div class=" d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                    <button type="submit" name="submitcontact" class="btn btn-primary">Save</button>
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