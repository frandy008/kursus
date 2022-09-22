<?php
include 'koneksi.php';

//Cari data di tabel tbl_users Berdasarkan username dan password
$q = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$_POST[username]' AND password = '$_POST[password]'");

//Cek
if (mysqli_num_rows($q) > 0) {
  //Jika ada
  //Masukan data nya ke variable data
  $data = mysqli_fetch_assoc($q);

  //Mulai sesi
  session_start();
  //Daftarkan sesi dengan nama username
  $_SESSION['username'] = $data['username'];

  //Tampilkan pesan berhasil & Arahkan ke halaman index.php
  echo '<script>alert("Berhasil login !");window.location.href="./index.php"</script>';
} else {
  //Jika tidak ada
  //Tampilkan pesan gagal & arahkan ke halaman login.php
  echo '<script>alert("Gagal login !");window.location.href="./login.php"</script>';
}
