<?php 

require '../koneksi.php';

session_start();
if (!isset($_SESSION["admin"])) {
	header("Location: admin.php");
	exit;
}

$username = $_SESSION["username"];
$getData = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' ");
$passwordLama = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' "))["password"];

if (isset($_POST["ubah"])) {
	$username = htmlspecialchars($_POST["username"]);
	$pass = htmlspecialchars($_POST["password"]);
	$password = htmlspecialchars($_POST["newpass"]);
	if ($pass == $passwordLama) {
		$query = mysqli_query($conn, "UPDATE admin SET username = '$username', password = '$password' ");
		echo "<script>alert('Account Berhasil Diupdate');document.location='index.php';</script>";
		exit;
	} else if ($pass != $passwordLama) {
		echo "<script>alert('Password lama yang anda masukkan tidak sesuai');document.location='index.php';</script>";
		exit;
	} else {
		echo "<script>alert('Account Gagal Diupdate');document.location='index.php';</script>";
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="../css/materialize.css">
	<link rel="stylesheet" type="text/css" href="css/account.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	<div class="navbar-fixed">
	    <nav>
	      	<div class="container">
	        	<div class="nav-wrapper">
	          		<a href="#!" class="brand-logo left">Absensi</a>
	          		<a href="#" data-target="mobile-demo" class="sidenav-trigger right"><i class="material-icons black-text right">menu</i></a>
	          		<ul class="right hide-on-med-and-down">
	          			<li><a href="#">Admin</a></li>
	             		<li><a href="index.php">Siswa</a></li>
	              		<li><a href="absensi.php">Absensi</a></li>
	              		<li><a href="riwayat.php">Riwayat Absensi</a></li>
	              		<li><a href="logout.php">Keluar</a></li>
	          		</ul>
	        	</div>
	      	</div>
	    </nav>
  	</div>
	<ul class="sidenav" id="mobile-demo">
		<li><a href="#">Admin</a></li>
	    <li><a href="index.php">Siswa</a></li>
	    <li><a href="absensi.php">Absensi</a></li>
	    <li><a href="riwayat.php">Riwayat Absensi</a></li>
	    <li><a href="logout.php">Keluar</a></li>
  	</ul>
  	<div class="header">
  		<div class="container">
  			<h3>Account Admin</h3>
  		</div>
  	</div>
  	<div class="main">
  		<div class="container">
  			<div class="row">
	  			<div class="col 6">
	  				<form method="post">
	  					<?php 
	  						while ($showData = mysqli_fetch_array($getData)) {
	  					?>
			  				<input type="text" name="username" placeholder="Username" value="<?= $showData["username"]; ?>" autocomplete="off">
		  					<input type="password" name="password" placeholder="Masukkan Password Yang Lama" required autocomplete="off">
		  					<input type="password" name="newpass" placeholder="Masukkan Password Yang Baru" required autocomplete="off">
		  					<button type="submit" name="ubah">Ubah</button>
		  				<?php
	  						}
	  					?>
	  				</form>
  				</div>
	  		</div>
  		</div>
  	</div>
	<footer>
		<p>Copyright Pamekasancode 2020</p>
		<p>Created By Firmansyah</p>
	</footer>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/materialize.js"></script>
	<script>
		$(document).ready(function(){
			$('.sidenav').sidenav();
		});

		$(document).ready(function(){
			$('.modal').modal({
				opacity: 0.3
			});
		});
	</script>
</body>
</html>
