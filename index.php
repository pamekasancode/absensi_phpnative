<?php 

require 'koneksi.php';

session_start();
if (!$_SESSION["masuk"]) {
	header("Location: login.php");
	exit;
}

$nama = $_SESSION["nama"];
$nisn = $_SESSION["nisn"];
$getUser = mysqli_query($conn, "SELECT * FROM user WHERE nama = '$nama' ");
while ($siswa = mysqli_fetch_array($getUser)) {
	$no = $siswa["no"];
	$kelas = $siswa["kelas"];
}

if (isset($_POST["absen"])) {
	date_default_timezone_set('Asia/Jakarta');
	$waktu = date("H:i");
	$tanggal = gmdate("d/m/y", time()+60*60*7);
	$keterangan = htmlspecialchars($_POST["keterangan"]);
	$cek = mysqli_query($conn, "SELECT * FROM absensi WHERE nisn = '$nisn' and tanggal = '$tanggal' ");
	$limit = "12:00";
	if ($waktu > $limit) {
		echo "<script>alert('Absensi gagal karena anda melewati batas waktu jam ');document.location='index.php';</script>";	
	} else if (strlen($keterangan) > 8) {
		echo "<script>alert('Keterangan tidak boleh lebih dari 8 kata');document.location='index.php';</script>";
	} else if (mysqli_num_rows($cek) === 1) {
		echo "<script>alert('Absensi hanya bisa dilakukan satu kali sehari');document.location='index.php';</script>";
	} else {
		$query = mysqli_query($conn, "INSERT INTO absensi VALUES('', '$nama', '$nisn', '$no', '$kelas', '$waktu', '$tanggal', '$keterangan')");
		echo "<script>alert('Absensi Berhasil');document.location='index.php';</script>";
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Absensi</title>
	<link rel="stylesheet" type="text/css" href="css/materialize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
	             		<li><a href="">Absensi</a></li>
	              		<li><a href="logout.php">Keluar</a></li>
	          		</ul>
	        	</div>
	      	</div>
	    </nav>
  	</div>
	<ul class="sidenav" id="mobile-demo">
		<li><a href="">Absensi</a></li>
	    <li><a href="logout.php">Keluar</a></li>
  	</ul>
  	<div class="header">
  		<div class="container">
  			<button data-target="absen" class="modal-trigger">Tambah Absensi</button>
  		</div>
  	</div>
  	<div class="main">
  		<div class="container">
  			<table class="table">
  				<thead>
  					<tr>
  						<th>Nama</th>
  						<th>Tanggal</th>
  						<th>Waktu</th>
  						<th>Keterangan</th>
  					</tr>
  				</thead>
  				<tbody>
  					<?php 
  						$showData = mysqli_query($conn, "SELECT * FROM absensi WHERE nama = '$nama' ");
  						while ($absensi = mysqli_fetch_array($showData)) {
  					?>
	  					<tr>
	  						<td><?= $absensi["nama"]; ?></td>
	  						<td><?= $absensi["tanggal"]; ?></td>
	  						<td><?= $absensi["waktu"]; ?> WIB</td>
	  						<td><?= ucfirst($absensi["keterangan"]); ?></td>
	  					</tr>
	  				<?php
  						}
  					?>
  				</tbody>
  			</table>
  		</div>
  	</div

  	<!-- modal --!>

	<div id="absen" class="modal">
		<div class="modal-content">
			<p>Masukkan keterangan absen dibawah ini</p>
			<form method="post">
				<input type="text" name="keterangan" placeholder="Keterangan hadir/sakit/izin/dll">
				<button class="cancel">Batal</button>
				<button class="accept" type="submit" name="absen">Absen</button>
			</form>
		</div>
	</div>

	<footer>
		<p>Copyright Pamekasancode 2020</p>
		<p>Created By Firmansyah</p>
	</footer>

	<script src="js/jquery.min.js"></script>
	<script src="js/materialize.js"></script>
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
