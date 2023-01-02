<!-- <?php
session_start();
$id_menu = $_GET['id'];


if(isset($_SESSION['keranjang'][$id_menu])) {
	$_SESSION['keranjang'][$id_menu]+=1;
}
else {
	$_SESSION['keranjang'][$id_menu] = 1;
}

echo "<script> alert('produk telah masuk ke pesanan');</script>";
echo "<script>location = 'index.php?halaman=pesanan'</script>";
?> -->

<h3>Beli Menu</h3><hr>
<?php  
 // mendapatkan id produk dari url
$id_menu = $_GET['id'];

$conn = mysqli_connect("localhost", "root", "", "project");

$ambil = $conn->query("SELECT * FROM menu WHERE id_menu='$id_menu' ");
$detail = $ambil->fetch_assoc();

?>
<!-- <pre><?php print_r($detail) ?></pre> -->

<section class="kontent">
	<div class="row">
		<div class="col-md-6">
			<img src="../admin/gambar/<?php echo $detail['gambar']; ?>" width='400px'>
		</div>
		<div class="col-md-6">
			<h3><?php echo $detail['namaMenu']; ?></h3>
			<h4>Rp. <?php echo number_format($detail['harga']); ?></h4>
			<h5>Stok : <?php echo $detail['stok']; ?> Porsi</h5><br><br>
			<form method="post">
				<div class="form-group">
					<div class="input-group">
						<input type="number" min="1"  max="<?php echo $detail['stok']; ?>"name="jumlah" class="form-control">
						<div class="input-group-btn">
							<button class="btn btn-primary" name="beli"> Beli </button>
						</div>
					</div>
				</div>
			</form>
			<?php

			if (isset($_POST['beli'])) {
				// mendapatkan jumlah yang diimputkan

				$jumlah = $_POST['jumlah'];

				$_SESSION['keranjang'][$id_menu] = $jumlah;
				$_SESSION['idtoko'] = $_GET['idtoko'];

				echo "<script> alert('produk telah masuk ke pesanan');</script>";
				echo "<script>location = 'index.php?halaman=pesanan'</script>";
			}


			?>



		</div>
	</div>
</section>