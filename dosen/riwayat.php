<?php
$id_dosen = $_SESSION['user']['id_dosen'];
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
		<?php $ambil = query("SELECT * FROM transaksi JOIN userdosen ON transaksi.id_dosen=userdosen.id_dosen WHERE transaksi.id_dosen = $id_dosen"); ?>
		<?php $i = 1; ?>
        <?php foreach($ambil as $row): ?>
		<tr>
			<td><?= $i; ?></td>
			<td><?php echo $row['id_transaksi']; ?></td>
			<td><?php echo $row['tgl']; ?></td>
			<td><?php echo number_format($row['total']); ?></td>
			<td><a href="index.php?halaman=detail&id=<?php echo $row['id_transaksi']; ?>" class="btn btn-info">detail</a></td>
		</tr>
		<?php $i++; ?>
        <?php endforeach; ?>
	</tbody>
</table>

