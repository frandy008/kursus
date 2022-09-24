<?php
//Meload file koneksi
include 'koneksi.php';
//Melakukan kueri ke tabel tbl_users berdasarkan username dan password
$q = mysqli_query($conn, "SELECT * FROM tbl_users WHERE username = '$_POST[username]' AND password = '$_POST[password]'");
//Cek
if (mysqli_num_rows($q) > 0) {
  //Jika ada
  //Menampung data
  $data = mysqli_fetch_assoc($q);
  //Memulai sesi
  session_start();
  //Mendaftarkan sesi username
  $_SESSION['username'] = $data['username'];
  //Mengalihkan ke halaman utama
  echo '<script>alert("Berhasil login !");window.location.href="./index.php"</script>';
} else {
  //Jika tidak ada
  echo '<script>alert("Kombinasi username dan password tidak cocok !");window.location.href="./login.php"</script>';
}
