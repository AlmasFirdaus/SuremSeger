<?php

//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_suremseger");


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambahProduk($data)
{
    global $conn;

    $namaproduk = htmlspecialchars($data["namaproduk"]);
    $hargaproduk = htmlspecialchars($data["hargaproduk"]);
    $detailproduk = htmlspecialchars($data["detailproduk"]);
    $volumeproduk = htmlspecialchars($data["volumeproduk"]);
    $beratproduk = htmlspecialchars($data["beratproduk"]);
    $stockproduk = htmlspecialchars($data["stockproduk"]);
    // var_dump($data);

    // upload gambar
    $gambar = uploadProduk();
    if (!$gambar) {
        return false;
    }

    $query = " INSERT INTO produk
                    VALUES
                    ('','$namaproduk', '$hargaproduk', '$detailproduk', '$volumeproduk', '$beratproduk', '$stockproduk', '$gambar')
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function uploadProduk()
{
    $namaFile = $_FILES['gambar_produk']['name'];
    $ukuranFile = $_FILES['gambar_produk']['size'];
    $error = $_FILES['gambar_produk']['error'];
    $tmpName = $_FILES['gambar_produk']['tmp_name'];

    // cek apakah tidak ada file yang di upload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
                </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar');
                </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    // if ($ukuranFile > 1000000) {
    //     echo "<script>
    //             alert('Ukuran gambar terlalu besar! maks 1mb');
    //             </script>";
    //     return false;
    // }

    // lolos pengecheckan, gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/img/produk/' . $namaFileBaru);
    return $namaFileBaru;
}

function ubahProduk($data, $id)
{
    global $conn;
    $product = query("SELECT * FROM produk WHERE id_produk = $id")[0];

    // var_dump($data);
    $nama = htmlspecialchars($data["namaproduk"]);
    $harga = htmlspecialchars($data["hargaproduk"]);
    $detail = htmlspecialchars($data["detailproduk"]);
    $volume = htmlspecialchars($data["volumeproduk"]);
    $berat = htmlspecialchars($data["beratproduk"]);
    $stock = htmlspecialchars($data["stockproduk"]);
    $gambar = $product['gambar_produk'];


    $error = $_FILES['gambar_produk']['error'];
    // cek apakah tidak ada file yang di upload
    if ($error !== 4) {
        $result = mysqli_query($conn, "SELECT gambar_produk FROM produk WHERE id_produk = $id");
        $file = mysqli_fetch_assoc($result);

        $fileName = implode('.', $file);

        $location = "../assets/img/produk/$fileName";
        if (file_exists($location)) {
            unlink('../assets/img/produk/' . $fileName);
        }
        $gambar = uploadProduk();
    } else if ($error === 4) {
        $gambar = $product['gambar_produk'];
    }

    $query = " UPDATE produk SET
                nama_produk = '$nama',
                harga_produk = '$harga',
                deskripsi_produk = '$detail',
                volume_produk = '$volume',
                berat_produk = '$berat',
                stock_produk = '$stock',
                gambar_produk = '$gambar'
                WHERE id_produk = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



function hapusProduk($id)
{

    global $conn;
    $result = mysqli_query($conn, "SELECT gambar_produk FROM produk WHERE id_produk = $id");
    $file = mysqli_fetch_assoc($result);
    // $a = 'file';
    // var_dump($a);
    // var_dump($file);

    $fileName = implode('.', $file);
    // $b = 'filename';
    // var_dump($b);
    // var_dump($fileName);
    $location = "../assets/img/produk/$fileName";
    if (file_exists($location)) {
        unlink('../assets/img/produk/' . $fileName);
    }

    mysqli_query($conn, "DELETE FROM produk where id_produk = $id");

    return mysqli_affected_rows($conn);
}

function hapus($id)
{

    global $conn;
    $result = mysqli_query($conn, "SELECT gambar FROM mahasiswa WHERE id = $id");
    $file = mysqli_fetch_assoc($result);
    // $a = 'file';
    // var_dump($a);
    // var_dump($file);

    $fileName = implode('.', $file);
    // $b = 'filename';
    // var_dump($b);
    // var_dump($fileName);
    $location = "../img/$fileName";
    if (file_exists($location)) {
        unlink('../img/' . $fileName);
    }

    mysqli_query($conn, "DELETE FROM mahasiswa where id = $id");

    return mysqli_affected_rows($conn);
}

function ubah($data, $id)
{
    global $conn;
    $user = query("SELECT * FROM users WHERE id = $id")[0];

    // var_dump($data);
    $namalengkap = htmlspecialchars($data["namalengkap"]);
    $email = htmlspecialchars($data["email"]);
    $provinsi = htmlspecialchars($data["provinsi"]);
    $kota = htmlspecialchars($data["kota"]);
    $kecamatan = htmlspecialchars($data["kecamatan"]);
    $kodepos = htmlspecialchars($data["kodepos"]);
    $nohp = htmlspecialchars($data["nohp"]);
    $password = $user['password'];
    $role = $user['role'];
    $gambar = $user['gambar'];

    // // upload gambar
    // $gambar = upload();
    // if (!$gambar) {
    //     return false;
    // }

    $error = $_FILES['gambar']['error'];
    // cek apakah tidak ada file yang di upload
    if ($error !== 4) {
        $gambar = upload();
    } else if ($error === 4) {
        $gambar = $user['gambar'];
    }


    $query = " UPDATE users SET
                namalengkap = '$namalengkap',
                email = '$email',
                provinsi = '$provinsi',
                kota = '$kota',
                kecamatan = '$kecamatan',
                kodepos = '$kodepos',
                nohp = '$nohp',
                password = '$password',
                role = '$role',
                gambar = '$gambar'
                WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada file yang di upload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
                </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar');
                </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    // if ($ukuranFile > 1000000) {
    //     echo "<script>
    //             alert('Ukuran gambar terlalu besar! maks 1mb');
    //             </script>";
    //     return false;
    // }

    // lolos pengecheckan, gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/img/profil_user/' . $namaFileBaru);
    return $namaFileBaru;
}


function ubahPassword($data, $id)
{
    global $conn;
    $user = query("SELECT * FROM users WHERE id = $id")[0];

    // var_dump($data);
    $namalengkap = $user['namalengkap'];
    $email = $user['email'];
    $provinsi = $user['provinsi'];
    $kota = $user['kota'];
    $kecamatan = $user['kecamatan'];
    $kodepos = $user['kodepos'];
    $nohp = $user['nohp'];
    $password = mysqli_real_escape_string($conn, $data["passwordBaru"]);
    $role = $user['role'];
    $gambar = $user['gambar'];

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    $query = " UPDATE users SET
                namalengkap = '$namalengkap',
                email = '$email',
                provinsi = '$provinsi',
                kota = '$kota',
                kecamatan = '$kecamatan',
                kodepos = '$kodepos',
                nohp = '$nohp',
                password = '$password',
                role = '$role',
                gambar = '$gambar'
                WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updatehome($data)
{
    global $conn;
    // $id = 1;
    $user = query("SELECT * FROM deskripsi WHERE id = 1")[0];

    // echo "<br><br><br>";
    $judul = htmlspecialchars($data["judulhome"]);
    $deskripsi = htmlspecialchars($data["deskripsihome"]);
    $gambar = $user['gambar'];
    // var_dump($data['gambar']);

    // var_dump($user);
    $error = $_FILES['gambar']['error'];
    // cek apakah tidak ada file yang di upload
    if ($error !== 4) {
        $gambar = uploaddeskripsi();
    } else if ($error === 4) {
        $gambar = $user['gambar'];
    }


    $query = " UPDATE deskripsi SET
                judul = '$judul',
                deskripsi = '$deskripsi',
                gambar = '$gambar'
                WHERE id = 1
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateabout($data)
{
    global $conn;
    // $id = 1;
    $user = query("SELECT * FROM about WHERE id = 1")[0];

    $deskripsi = htmlspecialchars($data["deskripsiabout"]);
    $gambar = $user['gambar'];
    // var_dump($data['gambar']);

    // echo "<br><br><br>";
    // var_dump($user);
    // echo "<br><br><br>";
    // var_dump($deskripsi);
    // var_dump($gambar);
    $error = $_FILES['gambar']['error'];
    // cek apakah tidak ada file yang di upload
    if ($error !== 4) {
        $gambar = uploaddeskripsi();
    } else if ($error === 4) {
        $gambar = $user['gambar'];
    }


    $query = " UPDATE about SET
                deskripsi_about = '$deskripsi',
                gambar = '$gambar'
                WHERE id = 1
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updatecontact($data)
{
    global $conn;

    $lokasi = htmlspecialchars($data["lokasi"]);
    $jambuka = htmlspecialchars($data["jambuka"]);
    $nohp = htmlspecialchars($data["nohp"]);

    $query = " UPDATE contact SET
                lokasi = '$lokasi',
                jambuka = '$jambuka',
                nohp = '$nohp'
                WHERE id = 1
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploaddeskripsi()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada file yang di upload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
                </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar');
                </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/img/dashboard/' . $namaFileBaru);
    return $namaFileBaru;
}


function registrasi($data)
{

    global $conn;
    // var_dump($data);
    $username = stripslashes($data["regnamalengkap"]);
    $email = strtolower(stripslashes($data["regemail"]));
    $alamat = strtolower(stripslashes($data["regalamat"]));
    $provinsi = strtolower(stripslashes($data["regprovinsi"]));
    $kota = strtolower(stripslashes($data["regkota"]));
    $kecamatan = strtolower(stripslashes($data["regkecamatan"]));
    $kodepos = strtolower(stripslashes($data["regkodepos"]));
    $nohp = $data["regnohp"];
    $password = mysqli_real_escape_string($conn, $data["regpassword"]);
    $password2 = mysqli_real_escape_string($conn, $data["regpassword2"]);
    $role = 2;
    $gambar = 'defaultprofile.jpg';

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT namalengkap FROM users WHERE namalengkap = '$username'");

    if (mysqli_fetch_row($result)) {
        echo "
        <script> 
            alert('Username sudah terdaftar!');
        </script>
    ";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "
            <script> 
                alert('Konfirmasi password salah!');
            </script>
        ";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO users VALUES ('', '$username', '$email', '$alamat', '$provinsi', '$kota', '$kecamatan', '$kodepos', '$nohp', '$password', '$role', '$gambar')");

    return mysqli_affected_rows($conn);
}

function bukti($data, $id_pembelian)
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $bank = htmlspecialchars($data["bank"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $tanggal = date("Y-m-d");

    // upload gambar
    $gambar = uploadBukti();
    if (!$gambar) {
        return false;
    }

    $query = " INSERT INTO pembayaran
                    VALUES
                    ('','$id_pembelian', '$nama', '$bank', '$jumlah', '$tanggal', '$gambar')
                ";


    mysqli_query($conn, $query);
    mysqli_query($conn, "UPDATE pembelian SET status_pembelian ='Sudah kirim Pembayaran' WHERE id_pembelian = '$id_pembelian'");

    return mysqli_affected_rows($conn);
}

function uploadBukti()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada file yang di upload
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
                </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar');
                </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 2000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar! maks 2mb');
                </script>";
        return false;
    }

    // lolos pengecheckan, gambar siap di upload
    // generate nama gambar baru
    $namaFileBaru = date("YmdHis");
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/img/bukti_pembayaran/' . $namaFileBaru);
    return $namaFileBaru;
}
