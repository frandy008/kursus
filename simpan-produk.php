<?php
//Memanggil koneksi
include 'koneksi.php';
//Melakukan kueri 
//Jika id kosong maka kita akan insert/tambahkan data nya
if ($_POST['id'] == '') {
  $q = mysqli_query($conn, "INSERT INTO tbl_produk(nama_produk,harga,stok) VALUES('$_POST[nama_produk]','$_POST[harga]','$_POST[stok]')");
} else {
  //Jika id tidak kosong kita akan update/perbarui data nya
  $q = mysqli_query($conn, "UPDATE tbl_produk SET nama_produk = '$_POST[nama_produk]', harga = '$_POST[harga]', stok = '$_POST[stok]' WHERE id_produk = '$_POST[id]'");
}
//Cek
if ($q) {
  //Jika berhasil tampilkan pesan berhasil
  echo '<script>alert("Berhasil menyimpan !");window.location.href="produk.php"</script>';
} else {
  //Jika gagal tampilkan pesan gagal
  echo '<script>alert("Gagal menyimpan ! ' . mysqli_error($conn) . '");window.location.href="produk.php"</script>';
}
