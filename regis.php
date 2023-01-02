<!DOCTYPE html>
<html>
<head>
	<title>Daftar Sebagai</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- BOOTSTRAP STYLES-->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="admin/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	<style type="text/css">
body{
	font-family: sans-serif;
}
.kotak{
	width: 405px;
	height: 90px;
	margin: auto;
	margin-top: 30px;
	background-color: red;
}
.nav{
	background-color: #82b8ff;
	width: 405px;
	height: 50px;
}
.nav h1{
	margin-top: 0px;
	padding: 5px;
	text-align: center;
	color: white;
}
.menu{
	width: 405px;
	height: 40px;
}
.menu1{
	background-color: #4d4d4d;
	width: 135px;
	height: 40px;	
	float: left;
}
.menu1:hover{
	background-color: #242424;
}
.menu a{
	text-decoration: none;
	color: white;
}
.menu1 h4{
	text-align: center;
	margin-top: 0px;
}
.konten{
	width: 1300px;
	margin: auto;
}
.formInput {
  border: none;
  border-bottom: 1px solid #47868f;
  width: 345px;
  height: 30px;
  font-size: 16px;
  color: #363636;
  margin-bottom: 15px;
  background-color: #dddddd;
}
.submit{
	border: 0px;
	width: 348px;
	height: 40px;
	background-color: #082b59;
	font-size: 16px;
	color: white;
}

	</style>
</head>
<body>
	<div class="kotak">
		<div class="nav">
			<h1>E-Kantin</h1>
		</div>
		<div class="menu">
			<a href="regis.php?halaman=regispenjual"><div class="menu1">
				<h4>Penjual</h4>
			</div></a>
			<a href="regis.php?halaman=regisdosen"><div class="menu1" style="width: 135px;">
				<h4>Dosen</h4>
			</div></a>
			<a href="regis.php?halaman=regismhs"><div class="menu1">
				<h4>Mahasiswa</h4>
			</div></a>
		</div>
		
	</div>
	<div class="konten">
		<?php
                if (isset($_GET['halaman']))
                {
                    if ($_GET['halaman']=="regispenjual") {
                        include 'admin/regispenjual.php';

                    } elseif ($_GET['halaman']=="regisdosen") {
                        include 'regisdosen.php';

                    } elseif ($_GET['halaman']=="regismhs") {
                        include 'regismhs.php';

                    }
                } 
                else {
                    include 'homeregis.php';
                }
        ?>
	</div>

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