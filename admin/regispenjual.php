<?php

$conn = mysqli_connect("localhost", "root", "", "project");

function registrasipenjual($data){
    global $conn;

    $nama =  strtolower(stripcslashes($data["nama_penjual"])); 
    $toko =  strtolower(stripcslashes($data["nama_toko"])); 
    $nik = strtolower(stripcslashes($data["nik"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $gambar = upload();
    
    //cek sudah ada atau blm
    $result = mysqli_query($conn, "SELECT nik FROM userpenjual
        WHERE nik = '$nik'");

    if (mysqli_fetch_assoc($result) ) {
        echo "<script> 
                alert ('NIK sudah terdaftar');
            </script>";
        return false;
    }

    if (!$gambar){
        return false;
    }

    //cek konfirm password
    if($password !== $password2){
        echo "<script>
                alert ('konfirmasi tidak sesuai');
            </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO userpenjual VALUES('', '$nik', '$nama', '$toko', '$gambar',  '$password')");

    return mysqli_affected_rows($conn);
}

function upload(){

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tdk ada gambar yg diupload
    if($error === 4){
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>
        ";
        return false;
    }

    // apa yg diupload user hanya gambar
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>
        ";
        return false;
    }

    // nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar; 

    // lolos pengecekan
    move_uploaded_file($tmpName, 'admin/gambar/'.$namaFileBaru);

    return $namaFileBaru;

}

?>

<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>  Daftar sebagai Penjual</strong>  
        </div>
        <div class="panel-body">
            <form role="form" method="post" enctype="multipart/form-data">
            <br/>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                    <input type="text" name="nama_penjual" id="nik" class="form-control" placeholder="Nama Lengkap" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                    <input type="text" name="nama_toko" id="nik" class="form-control" placeholder="Nama Toko" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                    <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <label>Gambar</label>
                    <input type="file" class="form-control" name="gambar">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="password">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                    <input type="password" name="password2" id="password2" class="form-control" placeholder="konfirm password">
                </div>
                                         
                <button type="submit" name="daftar" class="btn btn-success">Daftar</button>
                <hr />
                Sudah punya akun ?  <a href="login.php?halaman=loginpenjual" >Masuk</a>
            </form>
            <?php 

            if (isset($_POST["daftar"]) ) {

                if(registrasipenjual($_POST) > 0) {
                    echo "<div class='alert alert-info'> User berhasil ditambahkan </div>";
                    echo "<script>
                        document.location.href = 'login.php?halaman=loginpenjual';
                    </script>";
                } else {
                    echo mysqli_error($conn);
                }
            }
            ?>
        </div>
                           
    </div>
</div>