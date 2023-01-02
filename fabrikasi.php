<?php 
session_start();

if ( !isset($_SESSION['login'])){
  header("Location: landingpage.php");
  exit;
}

require 'konekdb.php';
$header = ["C1","C2","C3","C4","C5","C6","C7","C8"];

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />

    <link rel="stylesheet" href="bootstrap/css/fabrikasi.css" />

    <style>
      body {
        background-image: url(img/bg.jpg);
        background-size: cover;
        background-repeat: no-repeat;
      }

    </style>

    <title>Fabrikasi | ManTotal</title>
  </head>
  <body>
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
        <a class="navbar-brand" href="index.php">ManTotal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="btn btn-primary" href="logout.php">Logout<span class="sr-only">(current)</span></a>
            </li>
            </ul>
        </div>
        </div>
    </nav>
  <!-- End Navbar -->
  <div class="display-4 text-center">
    Data Operator per Bagian
  </div>
  <!-- Start Body -->
  <div class="container justify-content-center main">
    
    <div class="row text-center">
      <!-- Start Kolom 1 -->
      <?php for ($i=0; $i < 8; $i++) : ?>
      <div class="col-lg info">
      
      <form action="print_fabrikasi.php" method="post">
        <button name="header" type="submit" value="<?= $header[$i] ?>" class="ingfo">
      
        <div class="contain"><img src="img/<?= $header[$i] ?>.png" alt="perakitan"> <div class="overlay">
          <div class="text">
            <h4>Daftar Operator</h4> <br>
            <?php 
            $karyawan = mysqli_query($konek, "SELECT karyawan.nama FROM karyawan INNER JOIN operational ON karyawan.no_karyawan = operational.no_karyawan WHERE operational.ID='$header[$i]'");
            $rows = [];
            while ($data = mysqli_fetch_assoc($karyawan)){
                $rows[] = $data;
            }
            foreach($rows as $nama) : ?> 
              <?= $nama['nama'];?> <br>
            <?php endforeach;?>
            </div>
          </div> 
        </div>
        </button>
      </form>
      </div>
      <?php endfor;?>
      <!-- End Kolom 1 -->
      <!-- Start Kolom 2 -->
      
      <!-- End Kolom 2 -->
  </div>
  <!-- End Body -->
    <script src="bootstrap/jquery/jquery.slim.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrasp/js/bootstrap.min.js"></script>
  </body>
</html>