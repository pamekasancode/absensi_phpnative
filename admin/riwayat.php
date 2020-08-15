<?php 

require '../koneksi.php';

session_start();
if (!isset($_SESSION["admin"])) {
	header("Location: admin.php");
	exit;
}

if (isset($_POST["reset"])) {
	$reset = mysqli_query($conn, "TRUNCATE TABLE absensi");

}

$query = mysqli_query($conn, "SELECT * FROM absensi ORDER BY id ASC ");
$jumlah_absensi = mysqli_num_rows($query);


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Riwayat Absensi</title>
	<link rel="stylesheet" type="text/css" href="../css/materialize.css">
	<link rel="stylesheet" type="text/css" href="css/absensi.css">
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
	          			<li><a href="account.php">Admin</a></li>
	             		<li><a href="index.php">Siswa</a></li>
	              		<li><a href="absensi.php">Absensi</a></li>
	              		<li><a href="#">Riwayat Absensi</a></li>
	              		<li><a href="logout.php">Keluar</a></li>
	          		</ul>
	        	</div>
	      	</div>
	    </nav>
  	</div>
	<ul class="sidenav" id="mobile-demo">
		<li><a href="account.php">Admin</a></li>
	    <li><a href="index.php">Siswa</a></li>
	    <li><a href="#">Absensi</a></li>
	   	<li><a href="riwayat.php">Riwayat Absensi</a></li>
	    <li><a href="logout.php">Keluar</a></li>
  	</ul>
  	<div class="header">
  		<div class="container">
  			<form method="post">
	  			<button type="submit" name="reset" class="reset" onclick="return confirm('Yakin untuk mereset Database?');">Reset Database</button>
	  		</form> 
  		</div>
  	</div>
  	<div class="main">
  		<div class="container">
  			<div class="row">
  				<div class="col">
  					<p>Jumlah Keseluruhan Absensi: <?= $jumlah_absensi; ?></p>
  				</div>
  			</div>
  			<table class="table striped">
  				<thead>
  					<tr>
  						<th>Nama</th>
  						<th>Nisn</th>
  						<th>No</th>
  						<th>Kelas</th>
  						<th>Tanggal</th>
  						<th>Waktu</th>
  						<th>Keterangan</th>
  					</tr>
  				</thead>
  				<tbody>
  					<?php  
  						while ($siswa = mysqli_fetch_array($query)) {

  				 	?>
	  					<tr>
	  						<td><?= $siswa["nama"]; ?></td>
	  						<td><?= $siswa["nisn"]; ?></td>
	  						<td><?= $siswa["no"]; ?></td>
	  						<td><?= $siswa["kelas"]; ?></td>
	  						<td><?= $siswa["tanggal"]; ?></td>
	  						<td><?= $siswa["waktu"]; ?></td>
	  						<td><?= ucfirst($siswa["keterangan"]); ?></td>
	  					</tr>
	  				<?php 
	  					}
	  				?>
  				</tbody>
  			</table>
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
