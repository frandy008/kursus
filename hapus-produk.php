<?php
//Memanggil koneksi
include 'koneksi.php';
//Melakukan kueri hapus
$q = mysqli_query($conn, "DELETE FROM tbl_produk WHERE id_produk = '$_GET[id]'");
//Cek
if ($q) {
  //Jika ada tampilkan berhasil
  echo '<script>alert("Berhasil menghapus !");window.location.href="produk.php"</script>';
} else {
  //Jika tidak tampilkan gagal
  echo '<script>alert("Gagal menghapus !");window.location.href="produk.php"</script>';
}
