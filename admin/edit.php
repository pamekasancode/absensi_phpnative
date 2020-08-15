<?php 

require '../koneksi.php';

session_start();
if (!isset($_SESSION["admin"])) {
	header("Location: admin.php");
	exit;
}


$get_id = $_GET["id"];

if (!is_numeric($get_id)) {
	header("Location: index.php");
	exit;
}

if (isset($_POST["edit"])) {
	$nama = htmlspecialchars($_POST["nama"]);
	$password = htmlspecialchars($_POST["password"]);
	$no = htmlspecialchars($_POST["no"]);
	$kelas = htmlspecialchars($_POST["kelas"]);
	$query = mysqli_query($conn, "UPDATE user SET nama = '$nama', password = '$password', no = '$no', kelas = '$kelas' WHERE id = $get_id"); 
	if ($query) {
		echo "<script>alert('Data Berhasil Diedit');document.location='index.php';</script>";
		exit;
	} else {
		echo "<script>alert('Data Gagal Diedit');document.location='index.php';</script>";
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Edit Data Siswa</title>
	<link rel="stylesheet" type="text/css" href="../css/materialize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="main">
		<div class="container">
			<header>
				<h3>Edit Data Siswa</h3>
			</header>
			<form method="post">
				<?php 
					$getData = mysqli_query($conn, "SELECT * FROM user WHERE id = '$get_id' ");
					while ($siswa = mysqli_fetch_array($getData)) {
				?>
					<input type="text" name="nama" placeholder="Nama Siswa" autocomplete="off" value="<?= $siswa["nama"]; ?>">
					<input type="text" name="password" placeholder="Nisn Siswa" autocomplete="off" value="<?= $siswa["password"]; ?>">
					<input type="number" name="no" placeholder="No Absen" autocomplete="off" value="<?= $siswa["no"]; ?>"> 
					<input type="text" name="kelas" placeholder="Kelas Siswa" autocomplete="off" value="<?= $siswa["kelas"]; ?>">
					<button type="submit" name="edit" class="button-form">Edit Data</button>
				<?php
					}
				?>
			</form>
		</div>
	</div>
</body>
</html>