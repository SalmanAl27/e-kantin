<?php 

if (empty($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])) {
    echo "<script>alert('pesanan kosong')</script>";
    echo "<script>location='index.php';</script>";
    exit();
}

?>

<h1>Pesanan</h1>
<hr>
<table class="table table-bordered">
 	<thead>
 		<tr>
 			<th>No</th>
 			<th>Nama Produk</th>
 			<th>Harga</th>
 			<th>Jumlah</th>
 			<th>Subtotal</th>
 			<th>Aksi</th>
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
 			<td>
 				<a href="hapuspesanan.php?id=<?php echo $id_menu ?>" class="btn btn-danger" >Hapus</a>
 			</td>
 		</tr>
 		<?php $i++; ?>
 		<?php $total+=$subharga ?>
 		<?php endforeach; ?>
 	</tbody>
 	<tfoot>
 		<th colspan="4">Total</th>
 		<th>Rp. <?php echo number_format($total) ?></th>
 		<td></td>
 	</tfoot>
 </table>

 <a href="index.php?halaman=order" class="btn btn-warning">Lanjut Pesan</a> <a href="index.php?halaman=pembayaran" class="btn btn-primary">Bayar</a>