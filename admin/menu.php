<h1>Data Menu</h1><hr>
<?php $id = $_SESSION['admin']['id_penjual'];?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Gambar</th>
			<th>Nama Menu</th>
			<th>Harga</th>
			<th>Stok</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $menu = query("SELECT * FROM menu WHERE id_toko = $id "); ?>
		<?php $i = 1; ?>
        <?php foreach($menu as $row): ?>
		<tr>
			<td><?= $i; ?></td>
			<td><img src="gambar/<?php echo $row['gambar']; ?>" style="width:100px;height:100px;object-fit:cover;"></td>
			<td><?php echo $row['namaMenu']; ?></td>
			<td>Rp. <?php echo number_format($row['harga']); ?></td>
			<td><?php echo $row['stok']; ?> porsi</td>
			<td><a href="index.php?halaman=ubahmenu&id=<?php echo $row['id_menu']; ?>" 
					class="btn btn-warning">ubah</a>
				<a href="index.php?halaman=hapusmenu&id=<?php echo $row['id_menu']; ?>" 
					class="btn-danger btn">hapus</a></td>
		</tr>
		<?php $i++; ?>
        <?php endforeach; ?>

	</tbody>
</table>

<a href="index.php?halaman=tambahmenu" class="btn btn-primary">Tambah Menu</a>