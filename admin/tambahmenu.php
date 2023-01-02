<?php 
$id = $_SESSION['admin']['id_penjual'];
?>

<h2>Tambah Menu</h2>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Nama Menu</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>Harga</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>Stok</label>
		<input type="number" class="form-control" name="stok">
	</div>
	<div class="form-group">
		<label>Gambar</label>
		<input type="file" class="form-control" name="gambar">
	</div>
	<button class="btn btn-primary" type="submit" name="submit">Tambah</button>
</form>

<?php 
if (isset($_POST["submit"]) ){

  //cek apakah data berhasil ditambahkan atau tidak
  if (tambah($_POST, $id) > 0){
    echo "<div class='alert alert-info'> Data Tersimpan </div>";
    echo "
		<script>
			document.location.href = 'index.php?halaman=menu';
		</script>

	";
  } 

}

?>