<?php 
$id_dosen = $_SESSION['user']['id_dosen'];?>

<?php 
$ambil = $conn->query("SELECT * FROM saldo WHERE id_dosen='$id_dosen'");
$row = $ambil->fetch_assoc();
?>


<h1>Saldo</h1>
<hr>
<h3>Saldo anda :</h3> 
<h4>Rp. <?php echo number_format($row['saldo']); ?></h4>
<br><br>
<h3>Isi saldo</h3>
<h5 class="alert alert-info">Silahkan transfer melalui Bank / OVO / Dana</h5>