<?php 

session_start();

if (!isset($_SESSION['admin'])) {
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

function tambah($data, $id){
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);

    // upload gamabr
    $gambar = upload();
    if( !$gambar) {
        return false;
    }

    $query = "INSERT INTO menu
                VALUES
            ('', '$id' , '$nama', '$harga','$gambar','$stok')
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload(){

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tdk ada gambar yg diupload
    if($error === 4){
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>
        ";
        return false;
    }

    // apa yg diupload user hanya gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>
        ";
        return false;
    }

    // nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar; 

    // lolos pengecekan
    move_uploaded_file($tmpName, 'gambar/'.$namaFileBaru);

    return $namaFileBaru;

}

function ubah($data){
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah piloh
    if( $_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE menu SET
                namaMenu = '$nama',
                harga = '$harga',
                gambar = '$gambar',
                stok = '$stok' 

            WHERE id_menu = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
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
                <a class="navbar-brand" style="background-color: #82b8ff;" href="index.html">E-Kantin</a> 
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
                    <img src="gambar/<?= $_SESSION['admin']['gambar']?>" class="user-image img-responsive" style="object-fit: cover;width:200px;height:200px;border-radius: 50%"/>
                    <?php foreach($_SESSION["admin"] as $id_penjual): ?>

                    <?php 
                    $ambil = $conn->query("SELECT * FROM userpenjual WHERE id_penjual='$id_penjual'");
                    $row = $ambil->fetch_assoc();
                    ?>

                    <h3 style="color:white;"><?php echo $row['nama_toko']; ?></h3>
                    <?php endforeach; ?>
					</li>
                    
					
                    <li><a href="index.php"><i class="fa fa-file fa-2x"></i> &nbsp; Laporan </a></li>
                    <li><a href="index.php?halaman=menu"><i class="fa fa-cutlery fa-2x"></i> &nbsp; Data Menu</a></li>
                    <li><a href="index.php?halaman=pelanggan"><i class="fa fa-user fa-2x"></i> &nbsp; Pelanggan</a></li>
                    <li><a href="index.php?halaman=ceksaldo"><i class="fa fa-money fa-2x"></i> Cek Saldo</a></li>
                    <li><a href="index.php?halaman=pembelian"><i class="fa fa-shopping-cart fa-2x"></i>&nbsp; Riwayat Transaksi</a></li>
                    
            
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <?php
                if (isset($_GET['halaman']))
                {
                    if ($_GET['halaman']=="menu") {
                        include 'menu.php';

                    } elseif ($_GET['halaman']=="pembelian") {
                        include 'pembelian.php';

                    } elseif ($_GET['halaman']=="pelanggan") {
                        include 'pelanggan.php';

                    } elseif ($_GET['halaman']=="ceksaldo") {
                        include 'saldo.php';

                    } elseif ($_GET['halaman']=="detail") {
                        include 'detail.php';

                    } elseif ($_GET['halaman']=="tambahmenu") {
                        include 'tambahmenu.php';

                    } elseif ($_GET['halaman']=="hapusmenu") {
                        include 'hapusmenu.php';

                    } elseif ($_GET['halaman']=="ubahmenu") {
                        include 'ubahmenu.php';
                        
                    } elseif ($_GET['halaman']=="logout") {
                        include 'logout.php';
                        
                    }
                } 
                else {
                    include 'home.php';
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
