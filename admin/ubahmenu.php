<?php
$id = $_GET["id"];
$menu = query("SELECT * FROM menu WHERE id_menu = $id")[0];
?>
<h2>Ubah Menu</h2>

<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?= $menu["id_menu"]; ?>">
    <input type="hidden" name="gambarLama" value="<?= $menu["gambar"]; ?>">
	<div class="form-group">
		<label>Nama Menu</label>
		<input type="text" class="form-control" name="nama" 
				value="<?= $menu["namaMenu"]; ?>">
	</div>
	<div class="form-group">
		<label>Harga</label>
		<input type="number" class="form-control" name="harga"
				value="<?= $menu["harga"]; ?>">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok"
				value="<?= $menu["stok"]; ?>">
	</div>
	<div class="form-group">
		<label>Gambar</label><br>
		<img src="gambar/<?= $menu['gambar']; ?>" width="100px">
		<input type="file" class="form-control" name="gambar">
	</div>
	<button class="btn btn-primary" type="submit" name="submit">Ubah</button>
</form>

<?php 
if (isset($_POST["submit"]) ){

	//cek apakah data berhasil diubah atau tidak
	if (ubah($_POST) > 0){
		echo "<div class='alert alert-info'> Data Berhasil Diubah </div>";
		echo "
			<script>
				document.location.href = 'index.php?halaman=menu';
			</script>
		";
	} else{
		echo "<script>
				alert('data gagal diubah');
				document.location.href = 'index.php?halaman=menu';
			</script>";
	}

}

?>