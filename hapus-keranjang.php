<?php
//Memanggil koneksi
include 'koneksi.php';
//Melakukan kueri hapus
$q = mysqli_query($conn, "DELETE FROM tbl_keranjang WHERE id = '$_GET[id]'");
//Cek
if ($q) {
  //Jika ada tampilkan berhasil
  echo '<script>alert("Berhasil menghapus !");window.location.href="index.php"</script>';
} else {
  //Jika tidak tampilkan gagal
  echo '<script>alert("Gagal menghapus !");window.location.href="index.php"</script>';
}
