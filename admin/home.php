<?php
$id = $_SESSION['admin']['id_penjual'];
$semuadata = array();
$tgl_mulai = "-";
$tgl_selesai = "-";
if (isset($_POST['kirim'])) {
	$tgl_mulai = $_POST['tglm'];
	$tgl_selesai = $_POST['tgls'];
	$ambil = $conn->query("SELECT * FROM transaksi JOIN usermhs ON transaksi.id_mhs=usermhs.id_mhs WHERE tgl BETWEEN '$tgl_mulai' AND '$tgl_selesai' AND id_toko = $id");
	while ($pecah = $ambil->fetch_assoc()) {
	 	$semuadata[]=$pecah;
	}
	$ambil2 = $conn->query("SELECT * FROM transaksi JOIN userdosen ON transaksi.id_dosen=userdosen.id_dosen WHERE tgl BETWEEN '$tgl_mulai' AND '$tgl_selesai' AND id_toko = $id ");
	while ($pecah2 = $ambil2->fetch_assoc()) {
		$semuadata[]=$pecah2;
	}
	

}

?>
<!-- <pre><?php print_r($semuadata); ?></pre> -->


<h1>Laporan Pembelian </h1><hr>

<h3>Laporan Pembelian dari <?php echo $tgl_mulai ?> hingga <?php echo $tgl_selesai ?></h3>
<!-- <pre><?php print_r($_SESSION['admin']); ?></pre> -->
<br>
<form method="post">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label>Tanggal Mulai</label>
				<input type="date" class="form-control" name="tglm" value="<?php echo $tgl_mulai ?>">
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label>Tanggal Selesai</label>
				<input type="date" class="form-control" name="tgls" value="<?php echo $tgl_selesai ?>">
			</div>
		</div>
		<div class="col-md-4">
			<label>&nbsp</label><br>
			<button class="btn btn-primary" name="kirim">Lihat</button>
		</div>
	</div>
</form>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>ID Transaksi</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Jumlah</th>
		</tr>
	</thead>
	<tbody>
		<?php $totaltransaksi = 0;
			$nomer = 1; ?>
		<?php foreach ($semuadata as $key => $value): {
			$totaltransaksi += $value['total'];
		} ?>
		<tr>
			<td><?php echo $nomer; ?></td>
			<td></td>
			<td><?php echo $value['nama']; ?></td>
			<td><?php echo $value['tgl']; ?></td>
			<td>Rp. <?php echo number_format($value['total']); ?></td>
		</tr>
		<?php $nomer++ ?>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="4">Total</th>
			<th>Rp. <?php echo number_format($totaltransaksi); ?></th>
		</tr>
	</tfoot>
</table>