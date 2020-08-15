<?php 

require '../koneksi.php';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Absensi_Siwa.xls");

$tgl = gmdate("d/m/y", time()+60*60*7);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	table {
		margin: 20px auto;
		border-collapse: collapse;
	}

	table th,
	table td {
		padding: 5px;
	}
</style>
<body>
	<center>
		<h2>Daftar Absen Siswa</h2>
		<h3>Tanggal <?= $tgl; ?></h3>
	</center>
	<table border="1">
		<tr>
			<th>Nama</th>
  			<th>Nisn</th>
  			<th>No</th>
  			<th>Kelas</th>
  			<th>Tanggal</th>
  			<th>Waktu</th>
  			<th>Keterangan</th>
		</tr>
		<?php 
			$query = mysqli_query($conn, "SELECT * FROM absensi WHERE tanggal = '$tgl' ORDER BY no ASC ");
			while ($row = mysqli_fetch_array($query)) {
		?>
			<tr>
				<td><?= $row["nama"]; ?></td>
				<td><?= $row["nisn"]; ?></td>
				<td><?= $row["no"]; ?></td>
				<td><?= $row["kelas"]; ?></td>
				<td><?= $row["tanggal"]; ?></td>
				<td><?= $row["waktu"]; ?></td>
				<td><?= $row["keterangan"]; ?></td>
			</tr>
		<?php
			}
		?>
	</table>
</body>
</html>