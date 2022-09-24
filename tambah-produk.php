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
  <?php
  include 'koneksi.php';
  if (isset($_GET['id'])) {
    $q = mysqli_query($conn, "SELECT * FROM tbl_produk WHERE id_produk = '$_GET[id]'");
    $data = mysqli_fetch_assoc($q);
    $id_produk = $data['id_produk'];
    $nama_produk = $data['nama_produk'];
    $harga = $data['harga'];
    $stok = $data['stok'];
  } else {
    $id_produk = '';
    $nama_produk = '';
    $harga = '';
    $stok = '';
  }
  ?>
  <div class="container">
    <div class="row mt-5">
      <div class="col-md-4 offset-md-4">
        <form action="simpan-produk.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $id_produk ?>">
          <div class="mb-3">
            <label for="">Nama Produk</label>
            <input type="text" name="nama_produk" value="<?php echo $nama_produk ?>" class="form-control">
          </div>
          <div class="mb-3">
            <label for="">Harga</label>
            <input type="number" name="harga" value="<?php echo $harga ?>" class="form-control">
          </div>
          <div class="mb-3">
            <label for="">Stok</label>
            <input type="number" name="stok" value="<?php echo $stok ?>" class="form-control">
          </div>
          <div class="mb-3">
            <button class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>