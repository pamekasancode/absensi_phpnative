<?php 


error_reporting(0);

require '../koneksi.php';

session_start(); 

if (isset($_POST["admin"])) {
	$username = addslashes($_POST["user"]);
	$password = addslashes($_POST["pass"]);
	$query = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' and password = '$password' ");
	if (mysqli_num_rows($query) === 1) {
		$_SESSION["admin"] = true;
		$_SESSION["username"] = $username;
		$_SESSION["password"] = $password;
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
	<title>Masuk Admin</title>
	<link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
	<div class="box">
		<header>
			<h1>Masuk Admin</h1>
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
				<button type="submit" name="admin">Masuk</button><a href="../login.php">Siswa?</a>
			</div>
		</form>
	</div>
	<footer>
		<p>Copyright Pamekasancode 2020</p>
		<p>Created By Firmansyah</p>
	</footer>
</body>
</html>
