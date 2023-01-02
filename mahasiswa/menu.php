<?php
$id = $_GET['id'];
$nama = $_GET['nama'];
?>

<h1>Menu Toko <?= $nama?> <a href="index.php?halaman=pesanan" class="btn btn-info" 
	style="margin-left: 784px;">Pesanan anda</a></h1> 
<hr>
<div class="row">
	<?php $ambil = query("SELECT * FROM menu WHERE id_toko = $id"); ?>
	
    <?php foreach($ambil as $row): ?>
	<div class="col-md-3">
		<div class="thumbnail">
			<img src="../admin/gambar/<?php echo $row['gambar']; ?>" style="width:200px; height:200px; object-fit: cover;">
			<div class="caption">
				<h4><b><?php echo $row['namaMenu']; ?></b></h4>
				<h5>Rp. <?php echo number_format($row['harga']); ?></h5>
				<a href="index.php?halaman=beli&id=<?php echo $row['id_menu']; ?>&idtoko=<?= $id; ?>" class="btn btn-primary">Beli</a>
			</div>
		</div>
	</div>

    <?php endforeach; ?>

	
</div>