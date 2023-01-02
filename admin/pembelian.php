<?php
$id = $_SESSION['admin']['id_penjual'];
?>
<h1>Riwayat Transaksi</h1>
<br>
<h3>Dosen</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>No</td>
			<td>Nama User</td>
			<td>Tanggal</td>
			<td>Total</td>
			<td>aksi</td>
		</tr>
	</thead>
	<tbody>
		<?php $ambil = query("SELECT * FROM transaksi JOIN userdosen ON transaksi.id_dosen=userdosen.id_dosen WHERE id_toko = $id"); ?>
		<?php $i = 1; ?>
        <?php foreach($ambil as $row): ?>
		<tr>
			<td><?= $i; ?></td>
			<td><?php echo $row['nama']; ?></td>
			<td><?php echo $row['tgl']; ?></td>
			<td><?php echo $row['total']; ?></td>
			<td><a href="index.php?halaman=detail&id=<?php echo $row['id_transaksi']; ?>" class="btn btn-info">detail</a></td>
		</tr>
		<?php $i++; ?>
        <?php endforeach; ?>
	</tbody>
</table>

<h3>Mahasiswa</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>No</td>
			<td>Nama User</td>
			<td>Tanggal</td>
			<td>Total</td>
			<td>aksi</td>
		</tr>
	</thead>
	<tbody>
		<?php $ambil = query("SELECT * FROM transaksi JOIN usermhs ON transaksi.id_mhs=usermhs.id_mhs WHERE id_toko = $id"); ?>
		<?php $i = 1; ?>
        <?php foreach($ambil as $row): ?>
		<tr>
			<td><?= $i; ?></td>
			<td><?php echo $row['nama']; ?></td>
			<td><?php echo $row['tgl']; ?></td>
			<td><?php echo $row['total']; ?></td>
			<td><a href="index.php?halaman=detail&id=<?php echo $row['id_transaksi']; ?>" class="btn btn-info">detail</a></td>
		</tr>
		<?php $i++; ?>
        <?php endforeach; ?>
	</tbody>
</table>

