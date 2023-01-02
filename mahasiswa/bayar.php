<?php
if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])) {
    echo "<script>alert('pesanan kosong')</script>";
    echo "<script>location='index.php';</script>";
    exit();
}
$idtoko = $_SESSION['idtoko'];
?>

<h1>Pembayaran</h1>
<hr>
<table class="table table-bordered">
 	<thead>
 		<tr>
 			<th>No</th>
 			<th>Nama Produk</th>
 			<th>Harga</th>
 			<th>Jumlah</th>
 			<th>Subtotal</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php $i = 1; ?>
 		<?php $total=0; ?>
 		<?php foreach($_SESSION["keranjang"] as $id_menu => $jumlah): ?>

 		<?php 
 		$ambil = $conn->query("SELECT * FROM menu WHERE id_menu='$id_menu'");
 		$row = $ambil->fetch_assoc();
 		$subharga = $row['harga']*$jumlah;
 		?>
 		
 		<tr>
 			<td><?= $i; ?></td>
 			<td><?php echo $row['namaMenu']; ?></td>
 			<td>Rp. <?php echo number_format($row['harga']); ?></td>
 			<td><?php echo $jumlah; ?></td>
 			<td>Rp. <?php echo number_format($subharga); ?></td>
 			</td>
 		</tr>
 		<?php $i++; ?>
 		<?php $total+=$subharga ?>
 		<?php endforeach; ?>
 	</tbody>
 	<tfoot>
 		<th colspan="4">Total</th>
 		<th>Rp. <?php echo number_format($total) ?></th>
 	</tfoot>
</table>
<form method="post">
<button class="btn btn-primary" name="bayar">Bayar</button></form>

<?php $id_mhs = $_SESSION['user']['id_mhs'];?>

<?php 
$ambil = $conn->query("SELECT * FROM saldo WHERE id_mhs='$id_mhs'");
$row = $ambil->fetch_assoc();
$saldo = $row['saldo'];
?>

<?php 
$ambiladmin = $conn->query("SELECT * FROM saldo JOIN userpenjual 
	ON saldo.id_penjual=userpenjual.id_penjual");
$pecah = $ambiladmin->fetch_assoc();
$saldoadmin = $pecah['saldo'];
$id_penjual = $pecah['id_penjual'];
?>


<?php

$id_mhs = $_SESSION['user']['id_mhs'];
$tgl = date("Y-m-d");
$bayar = $saldo - $total;
$masukadmin = $saldoadmin + $total;

if (isset($_POST["bayar"])) {
	mysqli_query($conn, "INSERT INTO transaksi VALUES('', '0','$id_mhs', $idtoko, '$tgl','$total')");
	
	$id_transaksibaru = mysqli_insert_id($conn);

	mysqli_query($conn, "UPDATE saldo SET
                saldo = '$bayar' WHERE id_mhs='$id_mhs'");

	mysqli_query($conn, "UPDATE saldo SET
                saldo = '$masukadmin' WHERE id_penjual='$id_penjual'");

	foreach ($_SESSION['keranjang'] as $id_menu => $jumlah) {
		mysqli_query($conn, "INSERT INTO transaksi_produk VALUES('', '$id_transaksibaru','$id_menu', $idtoko, '$jumlah')");
		mysqli_query($conn, "UPDATE menu SET stok = stok - $jumlah WHERE id_menu='$id_menu' ");
	}

	unset($_SESSION['keranjang']);

	//tampilan ke nota
	echo"<script>alert ('pembelian sukses');</script>";
	echo"<script>location = 'index.php?halaman=nota&id=$id_transaksibaru';</script>";
}

?>