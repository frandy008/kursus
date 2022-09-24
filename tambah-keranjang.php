<?php
//Memanggil koneksi
include 'koneksi.php';
//Melakukan kueri ke tabel penjualan berdasarkan status belum selesai 0/1
$cek = mysqli_query($conn, "SELECT * FROM tbl_penjualan WHERE status = 0");
//Cek Penjualan
if (mysqli_num_rows($cek) > 0) {
  //Jika ada penjualan dengan status 0, kita ambil id_penjualan nya
  $data = mysqli_fetch_assoc($cek);
  $id_penjualan = $data['id_penjualan'];
} else {
  //Jika tidak ada, kita akan melakukan kueri insert ke tabel penjualan, kemudian kueri lagi dan ambil id_penjualan nya
  $tanggal = date('Y-m-d');
  $insert = mysqli_query($conn, "INSERT INTO tbl_penjualan(tanggal) VALUES('$tanggal')");
  $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbl_penjualan WHERE status = 0"));
  $id_penjualan = $data['id_penjualan'];
}

//Cek produk apakah ada produk dengan id yang di kirimkan
$cek_produk = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE id_produk = '$_POST[id_produk]'");
if (mysqli_num_rows($cek_produk) > 0) {
  //Jika ada maka cek lagi, apakah stok nya jika di kurangi 1 tidak sama dengan minus
  $produk = mysqli_fetch_assoc($cek_produk);
  $cek_keranjang = mysqli_query($conn, "SELECT * FROM tbl_keranjang WHERE id_penjualan = '$id_penjualan' AND id_produk ='$produk[id_produk]'");
  $keranjang = mysqli_fetch_assoc($cek_keranjang);
  if (($produk['stok'] - $keranjang['jumlah'] - 1) > -1) {
    //Jika berhasil simpan/insert ke keranjang

    if (mysqli_num_rows($cek_keranjang) < 1) {
      //Jika di keranjang tidak ada id pesanan dan id produk maka insert/tambahkan
      $q = mysqli_query($conn, "INSERT INTO tbl_keranjang(id_penjualan,id_produk,jumlah,total_harga) VALUES('$id_penjualan','$produk[id_produk]','1','$produk[harga]')");
    } else {
      $jumlah_sementara = $keranjang['jumlah'];
      $jumlah = $jumlah_sementara + 1;
      $total_harga = $jumlah * $produk['harga'];
      //Jika ada maka update jumlah dan total harga nya
      $q = mysqli_query($conn, "UPDATE tbl_keranjang SET jumlah = '$jumlah', total_harga = '$total_harga' WHERE id = '$keranjang[id]'");
    }

    if ($q) {
      echo '<script>alert("Berhasil menambahkan keranjang !");window.location.href="index.php"</script>';
    } else {
      echo '<script>alert("Gagal menambahkan keranjang !");window.location.href="index.php"</script>';
    }
  } else {
    echo '<script>alert("Stok tidak cukup !");window.location.href="index.php"</script>';
  }
} else {
  //Jika tidak ada produk dengan id yang di kirimkan
  echo '<script>alert("Produk tidak di temukan !");window.location.href="index.php"</script>';
}

//Jika gagal tampilkan gagal 
