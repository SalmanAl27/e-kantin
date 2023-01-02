<?php

$conn = mysqli_connect("localhost", "root", "", "project");

function registrasi($data){
    global $conn;

    $nama = stripcslashes($data["nama"]);
    $nim = strtolower(stripcslashes($data["nim"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek sudah ada atau blm
    $result = mysqli_query($conn, "SELECT nim FROM usermhs
        WHERE nim = '$nim'");

    if (mysqli_fetch_assoc($result) ) {
        echo "<script> 
                alert ('NIM sudah terdaftar');
            </script>";
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
    mysqli_query($conn, "INSERT INTO usermhs VALUES('', '$nama','$nim', '$password')");

    return mysqli_affected_rows($conn);
}

?>

<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>  Daftar sebagai Mahasiswa</strong>  
        </div>
        <div class="panel-body">
            <form role="form" method="post">
            <br/>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" autocomplete="off">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                    <input type="text" name="nim" id="nim" class="form-control" placeholder="NIM" autocomplete="off">
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
                Sudah punya akun ?  <a href="login.php?halaman=loginmhs" >Masuk</a>
            </form>
            <?php 

            if (isset($_POST["daftar"]) ) {

                if(registrasi($_POST) > 0) {
                    echo "<div class='alert alert-info'> User berhasil ditambahkan </div>";
                    echo "<script>
                        document.location.href = 'login.php?halaman=loginmhs';
                    </script>";
                } else {
                    echo mysqli_error($conn);
                }
            }

            ?>
        </div>
                           
    </div>
</div>