<h1>Pelanggan</h1><br>

<h3>User Dosen</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>No</td>
			<td>Nama User</td>
			<td>NIP</td>
			<td>aksi</td>
		</tr>
	</thead>
	<tbody>
		<?php $ambil = query("SELECT * FROM userdosen"); ?>
		<?php $i = 1; ?>
        <?php foreach($ambil as $row): ?>
		<tr>
			<td><?= $i; ?></td>
			<td><?php echo $row['nama']; ?></td>
			<td><?php echo $row['nip']; ?></td>
			<td><a href="" class="btn btn-danger">hapus</a></td>
		</tr>
		<?php $i++; ?>
        <?php endforeach; ?>
	</tbody>
</table>

<h3>User Mahasiswa</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>No</td>
			<td>Nama User</td>
			<td>NIM</td>
			<td>aksi</td>
		</tr>
	</thead>
	<tbody>
		<?php $ambil = query("SELECT * FROM usermhs"); ?>
		<?php $i = 1; ?>
        <?php foreach($ambil as $row): ?>
		<tr>
			<td><?= $i; ?></td>
			<td><?php echo $row['nama']; ?></td>
			<td><?php echo $row['nim']; ?></td>
			<td><a href="" class="btn btn-danger">hapus</a></td>
		</tr>
		<?php $i++; ?>
        <?php endforeach; ?>
	</tbody>
</table>