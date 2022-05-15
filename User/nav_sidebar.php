 <!-- Navbar -->
 <nav class="navbar navbar-expand-sm navbar-light shadow-sm fixed-top" id="navbar">
     <div class="container">
         <button class="btn btn-outline-light me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bi bi-list" style="color: black;"></i></button>
         <a class="navbar-brand" href="./indexUser.php">
             <img src="../assets/img/sapi icon.png" alt="" width="30" class="d-inline-block align-text-top" />
             Surem Seger
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto">
                 <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="indexUser.php#home">Home</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="indexUser.php#about">About</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="indexUser.php#product">Product</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="indexUser.php#contact">Contact</a>
                 </li>
             </ul>
         </div>
     </div>
 </nav>
 <!-- Akhir Navbar -->

 <!-- SideBar Admin-->

 <?php if ($_SESSION['role'] == 1) : ?>

     <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
         <div class="offcanvas-header">
             <img src="../assets/img/profil_user/<?= $user['gambar']; ?>" class="profileuser" id="profileuser" width="80" height="80" alt="" style="border-radius: 50%;">
             <h5 class="offcanvas-title" id="offcanvasScrollingLabel"><?php echo "{$user['namalengkap']}"; ?></h5>
             <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>
         <div class="offcanvas-body">
             <ul class="nav nav-pills flex-column">
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Data Mitra</a>
                     <ul class="dropdown-menu">
                         <li><a class="dropdown-item" href="../user/profileUser.php">Profile</a></li>
                         <li><a class="dropdown-item" href="../admin/deskripsiAdmin.php">Deskripsi Mitra</a></li>
                     </ul>
                 </li>
             </ul>
             <ul class="nav nav-pills flex-column">
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Data Pembeli</a>
                     <ul class="dropdown-menu">
                         <li><a class="dropdown-item" href="../admin/dataPesanan.php">Data Pesanan</a></li>
                         <li><a class="dropdown-item" href="../admin/dataPembatalan.php">Data Pembatalan</a></li>
                     </ul>
                 </li>
             </ul>
             <ul class="nav nav-pills flex-column">
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Data Produk</a>
                     <ul class="dropdown-menu">
                         <li><a class="dropdown-item" href="../admin/dataProduk.php">Data Produk</a></li>
                         <li><a class="dropdown-item" href="../admin/readyStockProduk.php">Ready Stock Produk</a></li>
                     </ul>
                 </li>
             </ul>
             <ul class="nav nav-pills flex-column">
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Data User</a>
                     <ul class="dropdown-menu">
                         <li><a class="nav-link" href="../Admin/dataAdmin.php">Data Admin</a></li>
                         <li><a class="nav-link" href="../Admin/dataCustomer.php">Data Customer</a></li>
                     </ul>
                 </li>
             </ul>
             <ul class="nav nav-pills flex-column">
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Laporan</a>
                     <ul class="dropdown-menu">
                         <li><a class="dropdown-item" href="../admin/dataPembeli.php">Data Transaksi Pembelian</a></li>
                         <li><a class="dropdown-item" href="../admin//dataPenjualanProduk.php">Data Penjualan Produk</a></li>
                     </ul>
                 </li>
             </ul>
             <ul class="nav nav-pills flex-column">
                 <li class="nav-item">
                     <a class="nav-link" href="../user/keranjang.php">Keranjang Belanja</a>
                     <a class="nav-link" href="../user/riwayat.php">Riwayat Pembelian</a>
                 </li>
             </ul>
         </div>
         <div class="offcanvas-footer gap-2 d-flex justify-content-center m-3">
             <a href="../logout.php">
                 <button class="btn btn-outline-secondary">Logout</button>
             </a>
         </div>
     </div>

     <!-- Akhir Sidebar Admin -->

     <!-- SideBar User -->

 <?php elseif ($_SESSION['role'] == 2) : ?>

     <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
         <div class="offcanvas-header">
             <img src="../assets/img/profil_user/<?= $user['gambar']; ?>" class="profileuser" id="profileuser" width="80" height="80" alt="" style="border-radius: 50%;">
             <h5 class="offcanvas-title" id="offcanvasScrollingLabel"><?php echo "{$user['namalengkap']}"; ?></h5>
             <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>
         <div class="offcanvas-body">
             <ul class="nav nav-pills flex-column">
                 <li class="nav-item">
                     <a class="nav-link" href="./profileUser.php">Profile</a>
                     <a class="nav-link" href="./keranjang.php">Keranjang Belanja</a>
                     <a class="nav-link" href="./riwayat.php">Riwayat Pembelian</a>
                 </li>
             </ul>
         </div>
         <div class="offcanvas-footer gap-2 d-flex justify-content-center m-3">
             <a href="../logout.php">
                 <button class="btn btn-outline-secondary">Logout</button>
             </a>
         </div>
     </div>

     <!-- Akhir Sidebar -->

 <?php endif; ?>