<?php 
$id_penjual = $_SESSION['admin']['id_penjual'];?>

<?php 
$ambil = $conn->query("SELECT * FROM saldo WHERE id_penjual='$id_penjual'");
$row = $ambil->fetch_assoc();
?>


<h1>Saldo</h1>
<hr>
<h3>Saldo anda :</h3> 
<h4>Rp. <?php echo number_format($row['saldo']); ?></h4>
<br><br>
<h3>Ambil saldo</h3>
<h5 class="alert alert-info">Silahkan ambil melalui Bank / OVO / Dana</h5>