<?php 

include '../koneksi.php';

session_start();
if (!isset($_SESSION["admin"])) {
	header("Location: admin.php");
	exit;
}

$id = $_GET["id"];
if (isset($_GET["id"])) {
	$hapus = mysqli_query($conn, "DELETE FROM user WHERE id  = $id");
	echo "<script>
			alert('Data berhasil di hapus');
				document.location='index.php';
		 </script>";
		exit;
	return mysqli_affected_rows($conn);
}

?>