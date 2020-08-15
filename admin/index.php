<?php 

require '../koneksi.php';

session_start();
if (!isset($_SESSION["admin"])) {
	header("Location: admin.php");
	exit;
}

if (isset($_POST["tambah"])) {
	$nama = htmlspecialchars($_POST["nama"]);
	$password = htmlspecialchars($_POST["password"]);
	$no = htmlspecialchars($_POST["no"]);
	$kelas = htmlspecialchars($_POST["kelas"]);
	$query = mysqli_query($conn, "INSERT INTO user VALUES('', '$nama', '$password', '$no', '$kelas')"); 
	if ($query) {
		echo "<script>alert('Data Berhasil Ditambahkan');document.location='index.php';</script>";
		exit;
	} else {
		echo "<script>alert('Data Gagal Ditambahkan');document.location='index.php.php';</script>";
	}
}

// Jumlah Siswa

$getjumlah = mysqli_query($conn, "SELECT * FROM user");
$jumlahsiswa = mysqli_num_rows($getjumlah);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Siswa</title>
	<link rel="stylesheet" type="text/css" href="../css/materialize.css">
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
	          			<li><a href="account.php">Admin</a></li>
	             		<li><a href="#">Siswa</a></li>
	              		<li><a href="absensi.php">Absensi</a></li>
	              		<li><a href="riwayat.php">Riwayat Absensi</a></li>
	              		<li><a href="logout.php">Keluar</a></li>
	          		</ul>
	        	</div>
	      	</div>
	    </nav>
  	</div>
	<ul class="sidenav" id="mobile-demo">
		<li><a href="account.php">Admin</a></li>
	    <li><a href="#">Siswa</a></li>
	    <li><a href="absensi.php">Absensi</a></li>
	   	<li><a href="riwayat.php">Riwayat Absensi</a></li>
	    <li><a href="logout.php">Keluar</a></li>
  	</ul>
  	<div class="header">
  		<div class="container">
  			<div class="row">
  				<div class="col 4">
  					<button data-target="absen" class="modal-trigger">Tambah Siswa</button>
  				</div>
  				<div class="col 8">
  					<h6>Jumlah Siswa: <?= $jumlahsiswa; ?></h6>
  				</div>
  			</div>
  			
  		</div>
  	</div>
  	<div class="main">
  		<div class="container">
  			<table class="table striped">
  				<thead>
  					<tr>
  						<th>Nama</th>
  						<th>Nisn</th>
  						<th>No Absen</th>
  						<th>Kelas</th>
  						<th>Aksi</th>
  					</tr>
  				</thead>
  				<tbody>
  					<?php  
  						$show = mysqli_query($conn, "SELECT * FROM user ORDER BY no ASC");
  						while ($siswa = mysqli_fetch_array($show)) {

  				 	?>
	  					<tr>
	  						<td><?= $siswa["nama"]; ?></td>
	  						<td><?= $siswa["password"]; ?></td>
	  						<td><?= $siswa["no"]; ?></td>
	  						<td><?= $siswa["kelas"]; ?></td>
	  						<td>
	  							<a onclick="return confirm('Yakin untuk dihapus?');" href="delete.php?id=<?= $siswa["id"]; ?>">Hapus</a> | 
	  							<a href="edit.php?id=<?= $siswa["id"]; ?>">Edit</a>
	  						</td>
	  					</tr>
	  				<?php 
	  					}
	  				?>
  				</tbody>
  			</table>
  		</div>
  	</div

  	<!-- modal -->

	<div id="absen" class="modal">
		<div class="modal-content">
			<h3>Tambah Siswa</h3>
			<form method="post">
				<input type="text" name="nama" placeholder="Nama Siswa" autocomplete="off" required>
				<input type="text" name="password" placeholder="Nisn Siswa" autocomplete="off" required>
				<input type="number" name="no" placeholder="No Absen" autocomplete="off" required> 
				<input type="text" name="kelas" placeholder="Kelas Siswa" autocomplete="off" required>
				<button type="submit" name="tambah" class="button-form">Tambah Data</button>
			</form>
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
