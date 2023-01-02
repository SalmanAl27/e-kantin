<?php 

session_start();

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda harus masuk!')</script>";
    echo "<script>location='../login.php';</script>";
    exit();
}

//koneksi database
$conn = mysqli_connect("localhost", "root", "", "project");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function hapus ($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM menu WHERE id_menu = $id");

    return mysqli_affected_rows($conn);
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Kantin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand " style="background-color: #82b8ff;" href="index.php">E-Kantin</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="index.php?halaman=logout" class="btn btn-danger square-btn-adjust" style="background-color: #82b8ff;">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">

                    <?php foreach($_SESSION["user"] as $id_mhs): ?>

                    <?php 
                    $ambil = $conn->query("SELECT * FROM usermhs WHERE id_mhs='$id_mhs'");
                    $row = $ambil->fetch_assoc();
                    ?>

                    <h3 style="color:white;"><?php echo $row['nama']; ?></h3>
                    <h5 style="color:white;"><?php echo $row['nim']; ?></h5>
				    <?php endforeach; ?> 

                </li>
				
                    <li><a href="index.php?halaman=order"><i class="fa fa-reorder fa-2x"></i>&nbsp;&nbsp; Menu </a></li>
                    <li><a href="index.php?halaman=pembayaran"><i class="fa fa-check-square fa-2x"></i>&nbsp;&nbsp; Pembayaran</a></li>
                    <li><a href="index.php?halaman=isisaldo"><i class="fa fa-money fa-2x"></i> Saldo</a></li>
                    <li><a href="index.php?halaman=riwayat"><i class="fa fa-shopping-cart fa-2x"></i>&nbsp; Riwayat Transaksi</a></li>
            
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <?php
                if (isset($_GET['halaman']))
                {
                    if ($_GET['halaman']=="order") {
                        include 'order.php';

                    } elseif($_GET['halaman']=='menu') {
                        include 'menu.php';

                    }elseif ($_GET['halaman']=="pesanan") {
                        include 'pesanan.php';

                    } elseif ($_GET['halaman']=="pembayaran") {
                        include 'bayar.php';

                    } elseif ($_GET['halaman']=="isisaldo") {
                        include 'isisaldo.php';

                    } elseif ($_GET['halaman']=="ceksaldo") {
                        include 'ceksaldo.php';

                    } elseif ($_GET['halaman']=="logout") {
                        include 'logout.php';
                        
                    }  elseif ($_GET['halaman']=="nota") {
                        include 'nota.php';
                        
                    } elseif ($_GET['halaman']=="riwayat") {
                        include 'riwayat.php';
                        
                    } elseif ($_GET['halaman']=="detail") {
                        include 'detail.php';
                        
                    } elseif ($_GET['halaman']=="beli") {
                        include 'beli.php';
                        
                    }
                } 
                else {
                    include 'order.php';
                }
                ?>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
