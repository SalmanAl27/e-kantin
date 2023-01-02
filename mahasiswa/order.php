<h1>Menu <a href="index.php?halaman=pesanan" class="btn btn-info" 
	style="margin-left: 784px;">Pesanan anda</a></h1> 
<hr>
<div class="row">
	<?php $ambil = query("SELECT * FROM userpenjual"); ?>
	
    <?php foreach($ambil as $row): ?>
	<div class="col-md-3">
		<div class="thumbnail">
			<img src="../admin/gambar/<?php echo $row['gambar']; ?>"  style="width:200px; height:200px; object-fit: cover; ">
			<div class="caption">
				<h4><b><?php echo $row['nama_toko']; ?></b></h4>
				
				<a href="index.php?halaman=menu&id=<?php echo $row['id_penjual']; ?>&nama=<?= $row['nama_toko']; ?>" class="btn btn-primary">Lihat Toko</a>
			</div>
		</div>
	</div>

    <?php endforeach; ?>

	
</div>