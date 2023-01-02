<?php
session_start();

$id_menu = $_GET["id"];
unset($_SESSION["keranjang"][$id_menu]);

echo "<script>alert('menu telah dihapus dari pesanan anda');</script>";
echo "<script>location='index.php';</script>";

?>