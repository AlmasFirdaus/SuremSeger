<?php

session_start();

if (!isset($_SESSION['login'])) {
  header("Location: ../login.php");
  exit;
}

require_once('../functions.php');

$id = $_SESSION['user']['id'];
$user = query("SELECT * FROM users WHERE id = $id")[0];
$deskripsi = query("SELECT * FROM deskripsi WHERE id = 1")[0];
$about = query("SELECT * FROM about WHERE id = 1")[0];
$product = query("SELECT * FROM produk WHERE stock_produk > 0");
$contact = query("SELECT * FROM contact")[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../style.css" />
  <!-- Bootstrap end -->

  <title>SuremSeger.ID</title>
</head>

<body id="body-index">

  <!-- Navbar - Sidebar -->
  <?php include 'nav_sidebar.php' ?>

  <!-- Home -->

  <section id="home">
    <div class="container">
      <div class="row d-flex justify-content-around align-items-center text-center">
        <div class="col-md-4 order-2 order-md-1 mb-3">
          <h1><?= $deskripsi['judul']; ?></h1>
          <p class="fs-5"> <?= $deskripsi['deskripsi']; ?></p>
        </div>
        <div class="col-md-4 order-1 order-md-2 mb-4">
          <img src="../assets/img/dashboard/<?= $deskripsi['gambar']; ?>" alt="">
        </div>
      </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#ffffff" fill-opacity="1" d="M0,64L30,53.3C60,43,120,21,180,58.7C240,96,300,192,360,213.3C420,235,480,181,540,181.3C600,181,660,235,720,256C780,277,840,267,900,229.3C960,192,1020,128,1080,112C1140,96,1200,128,1260,128C1320,128,1380,96,1410,80L1440,64L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path>
    </svg>
  </section>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h2>About Us</h2>
        </div>
      </div>
      <div class="row">
        <div class="">
          <img src="../assets/img/dashboard/<?= $about['gambar']; ?>" class="rounded mx-auto d-block mt-4" alt="...">
        </div>
      </div>
      <div class="row d-flex justify-content-center mt-3 text-center">
        <div class="col-md-4">
          <p><?= $about['deskripsi_about']; ?></p>
        </div>
      </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#f5f5f5" fill-opacity="1" d="M0,224L34.3,229.3C68.6,235,137,245,206,240C274.3,235,343,213,411,186.7C480,160,549,128,617,144C685.7,160,754,224,823,245.3C891.4,267,960,245,1029,197.3C1097.1,149,1166,75,1234,80C1302.9,85,1371,171,1406,213.3L1440,256L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
    </svg>
    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#c7d0d8" fill-opacity="1" d="M0,32L30,74.7C60,117,120,203,180,224C240,245,300,203,360,197.3C420,192,480,224,540,202.7C600,181,660,107,720,117.3C780,128,840,224,900,224C960,224,1020,128,1080,90.7C1140,53,1200,75,1260,74.7C1320,75,1380,53,1410,42.7L1440,32L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path>
    </svg> -->
  </section>

  <!-- Akhir Home -->

  <!-- Product -->

  <section id="product">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h2>Product</h2>
        </div>
      </div>
      <div class="row mt-4 align-items-center">
        <!-- <pre><?= print_r($product); ?></pre> -->
        <?php foreach ($product as $prod) : ?>
          <div class="col-md-6 col-lg-4 col-xl-3 mb-3 d-flex justify-content-center">
            <div class="card" style="width: 15rem;">
              <img src="../assets/img/produk/<?= $prod["gambar_produk"] ?>" class=" card-img-top " alt="<?= $prod["nama_produk"] ?>">
              <div class="card-header bg-transparent">
                <h5 class="card-title"><?= $prod["nama_produk"] ?></h5>
              </div>
              <div class="card-body">
                <p class="card-text">Susu segar rembangan rasa <?= $prod["nama_produk"] ?></p>
                <p>Rp. <?= $prod["harga_produk"] ?></p>
                <div class="row align-items-center">
                  <div class="col text-end">
                    <a href="detailProductUser.php?id=<?= $prod["id_produk"] ?>" class="btn btn-success">Detail</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#ffffff" fill-opacity="1" d="M0,32L48,69.3C96,107,192,181,288,229.3C384,277,480,299,576,266.7C672,235,768,149,864,128C960,107,1056,149,1152,149.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
  </section>

  <!-- Akhir Product -->

  <!-- Contact -->

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h2>Contact</h2>
        </div>
      </div>

      <div class="info">
        <div class="row mt-4 d-flex justify-content-around ">

          <div class="col-md-6 col-xl-6 mb-3 order-1 order-md-2 ">
            <div class="maps">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.157664791206!2d113.68801741477995!3d-8.085398494178806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfc4b00d932b43570!2sRembangan%20Dairy%20Farm!5e0!3m2!1sid!2sid!4v1648605306839!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </div>

          <div class="col-md-6 col-xl-3 mb-3 order-2 order-md-1 ">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Lokasi:</h4>
              <p><?= $contact["lokasi"]; ?></p>
            </div>

            <div class="open-hours">
              <i class="bi bi-clock"></i>
              <h4>Jam Buka:</h4>
              <p>
                Senin - Minggu:<br />
                <?= $contact['jambuka']; ?>
              </p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>No HP:</h4>
              <p><?= $contact['nohp']; ?></p>
            </div>


          </div>
        </div>
      </div>
    </div>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#c7d0d8" fill-opacity="1" d="M0,256L24,240C48,224,96,192,144,176C192,160,240,160,288,165.3C336,171,384,181,432,202.7C480,224,528,256,576,272C624,288,672,288,720,277.3C768,267,816,245,864,240C912,235,960,245,1008,256C1056,267,1104,277,1152,272C1200,267,1248,245,1296,229.3C1344,213,1392,203,1416,197.3L1440,192L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path>
    </svg>
  </section>

  <!-- Akhir Contact -->

  <footer class="text-center pb-1" style="background:  #c7d0d8">
    <p>©Copyright <label class="fw-bold">Susu Rembangan</label>. All Rights Reserved</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>