<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Kursus</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="produk.php">Produk</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_SESSION['username']; ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row mt-2">
      <div class="col-md-4">
        <form action="tambah-keranjang.php" method="POST">
          <div class="mb-3">
            <input type="text" name="id_produk" placeholder="ID Produk" class="form-control">
          </div>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <table class="table">
          <thead>
            <tr>
              <th>Nama Produk</th>
              <th>Jumlah</th>
              <th>Total Harga</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            include 'koneksi.php';
            $total = 0;
            $q = mysqli_query($conn, "SELECT * FROM tbl_penjualan WHERE status = '0'");
            if (mysqli_num_rows($q) > 0) {
              $penjualan = mysqli_fetch_assoc($q);
              $keranjang = mysqli_query($conn, "SELECT * FROM tbl_keranjang k JOIN tbl_produk p ON p.id_produk = k.id_produk WHERE id_penjualan = '$penjualan[id_penjualan]'");
              while ($data = mysqli_fetch_assoc($keranjang)) {
                $total = $total + $data['total_harga'];
            ?>
                <tr>
                  <td><?php echo $data['nama_produk'] ?></td>
                  <td><?php echo $data['jumlah'] ?></td>
                  <td><?php echo $data['total_harga'] ?></td>
                  <td>
                    <a href="hapus-keranjang.php?id=<?php echo $data['id'] ?>"><button class="btn btn-danger">Hapus</button></a>
                  </td>
                </tr>
              <?php } ?>
              <tr>
                <td colspan="2">Total</td>
                <td colspan="2"><?php echo $total ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>

    <div class="row">
      <div class="col-12">
        <a href="proses-penjualan.php"><button class="btn btn-primary">Proses</button></a>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>