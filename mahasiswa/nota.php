<h1>Nota Pembelian</h1>
<hr>

<?php $ambil = query("SELECT * FROM transaksi JOIN usermhs ON transaksi.id_mhs=usermhs.id_mhs WHERE transaksi.id_transaksi='$_GET[id]'");
?>
<?php foreach($ambil as $detail): ?>

<h3><b><?php echo $detail['nama']; ?></strong> </b></h3>
<p>
	NIM : <?php echo $detail['nim']; ?>
</p>
<p>
	Tanggal : <?php echo $detail['tgl']; ?><br>
	Total : Rp. <?php echo $detail['total']; ?>
</p>
<?php endforeach; ?>

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
 		<?php $ambil = query("SELECT * FROM transaksi_produk JOIN menu ON transaksi_produk.id_menu=menu.id_menu 
 		WHERE transaksi_produk.id_transaksi='$_GET[id]'"); ?>
 		<?php $i = 1; ?>
 		<?php foreach($ambil as $row): ?>

 		<tr>
 			<td><?= $i; ?></td>
 			<td><?php echo $row['namaMenu']; ?></td>
 			<td>Rp. <?php echo $row['harga']; ?></td>
 			<td><?php echo $row['jumlah']; ?></td>
 			<td>Rp. <?php echo $row['harga']*$row['jumlah']; ?></td>
 		</tr>
 		<?php $i++; ?>
 		<?php endforeach; ?>
 	</tbody>
 </table>
