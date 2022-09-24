<?php  
//Memanggil koneksi
include 'koneksi.php';
//Melakukan kueri untuk memilih penjualan dengan status 0 atau belum selesai
$cek = mysqli_query($conn,"SELECT * FROM tbl_penjualan WHERE status = '0'");
//Menampung data penjualan
$penjualan = mysqli_fetch_assoc($cek);
//Melakukan kueri untuk memilih keranjang dengan id penjualan
$cek_keranjang = mysqli_query($conn,"SELECT * FROM tbl_keranjang WHERE id_penjualan = '$penjualan[id_penjualan]'");
while ($keranjang = mysqli_fetch_assoc($cek_keranjang)) {
  //Melakukan kueri select ke tbl_produk untuk mengambil stok
  $produk = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM tbl_produk WHERE id_produk = '$keranjang[id_produk]'"));
  $jumlah_sementara = $produk['stok'];
  $jumlah = $jumlah_sementara - $keranjang['jumlah'];
  //Melakukan kueri update produk berdasarkan data keranjang
  mysqli_query($conn,"UPDATE tbl_produk SET stok = '$jumlah' WHERE id_produk = '$keranjang[id_produk]'");
}
//Melakukan kueri update penjualan menjadi status 1 atau selesai
$q = mysqli_query($conn,"UPDATE tbl_penjualan SET status = '1' WHERE id_penjualan = '$penjualan[id_penjualan]'");
if ($q) {
  echo '<script>alert("Berhasil memproses penjualan !");window.location.href="index.php"</script>';
}else{
  echo '<script>alert("Gagal memproses penjualan !");window.location.href="index.php"</script>';
}
