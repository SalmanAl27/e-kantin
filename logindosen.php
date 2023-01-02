<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "project");

?>


<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
  <div class="panel panel-default">
      <div class="panel-heading">
        <strong>  Masuk sebagai Dosen</strong>  
      </div>
      <div class="panel-body">
        <form role="form" method="post"><br />
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
            <input type="text" class="form-control" name="nip" placeholder="NIP " />
          </div>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
            <input type="password" class="form-control" name="password" placeholder="Password" />
          </div>
          <br><br>
                                       
          <button type="submit" class="btn btn-primary" name="masuk">Masuk</button>
          <hr />
          <a href="regis.php?halaman=regisdosen" > Buat akun </a> 
        </form>
        <?php
        if (isset($_POST["masuk"]) ) {

          $nip = $_POST["nip"];
          $password = $_POST["password"];

          $result = mysqli_query($conn, "SELECT * FROM userdosen WHERE nip = '$nip'");

          if (mysqli_num_rows($result) === 1) {

            $_SESSION['user'] = mysqli_fetch_assoc($result);
            if (password_verify($password,  $_SESSION['user']["password"]) ){
              echo "<div class='alert alert-info'> Sukses </div>";
              echo "<script>
                    document.location.href = 'dosen/index.php';
              </script>";
            }
          } else {
            echo "<div class='alert alert-danger'> NIP atau password salah </div>";
          }

        }
        ?>
      </div>
  </div>
</div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
