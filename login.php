<?php 

error_reporting(0);

require 'koneksi.php';

session_start();

if (isset($_POST["masuk"])) {
	$nama = addslashes($_POST["user"]);
	$password = addslashes($_POST["pass"]);
	$query = mysqli_query($conn, "SELECT * FROM user WHERE nama = '$nama' and password = '$password' ");
	if (mysqli_num_rows($query) === 1) {
		$_SESSION["masuk"] = true;
		$_SESSION["nama"] = $nama;
		$_SESSION["nisn"] = $password;
		header("Location: index.php");
		exit;
	} else {
		$error = true;
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Masuk Siswa</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
	<div class="box">
		<header>
			<h1>Masuk Absensi</h1>
		</header>
		<form method="post">
			<?php if(isset($error)) : ?> 
				<p class="alert">Username / password salah!</p>
			<?php endif; ?>
			<div class="input">
				<input type="text" name="user" placeholder="Username" autocomplete="off" required>	
			</div>
			<div class="input">
				<input type="password" name="pass" placeholder="Password" autocomplete="off" required>	
			</div>
			<div class="input">
				<button type="submit" name="masuk">Masuk</button><a href="admin/admin.php">Masuk sebagai admin</a>
			</div>
		</form>
	</div>
	<footer>
		<p>Copyright Pamekasancode 2020</p>
		<p>Created By Firmansyah</p>
	</footer>
</body>
</html>