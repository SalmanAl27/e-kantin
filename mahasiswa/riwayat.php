<?php
$id_mhs = $_SESSION['user']['id_mhs'];
?>

<h1>Riwayat Transaksi</h1>
<hr>

<table class="table table-bordered">
	<thead>
		<tr>
			<td>No</td>
			<td>ID Transaksi</td>
			<td>Tanggal</td>
			<td>Total</td>
			<td>aksi</td>
		</tr>
	</thead>
	<tbody>
		<?php $ambil = query("SELECT * FROM transaksi JOIN usermhs ON transaksi.id_mhs=usermhs.id_mhs WHERE transaksi.id_mhs = $id_mhs"); ?>
		<?php $i = 1; ?>
        <?php foreach($ambil as $row): ?>
		<tr>
			<td><?= $i; ?></td>
			<td><?php echo $row['id_transaksi']; ?></td>
			<td><?php echo $row['tgl']; ?></td>
			<td><?php echo $row['total']; ?></td>
			<td><a href="index.php?halaman=detail&id=<?php echo $row['id_transaksi']; ?>" class="btn btn-info">detail</a></td>
		</tr>
		<?php $i++; ?>
        <?php endforeach; ?>
	</tbody>
</table>

