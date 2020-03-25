<html>
<head>
		<title> CRUD PHP dan MySQLi
</title>
</head>
<body>

	<h2>CRUD DATA MAHASISWA</h2>
	<br/>
	<a href="form.php">+TAMBAH MAHASISWA</a>
	<br/>
	<br/>
	<table border="1">
		<tr>
			<th>NO</th>
			<th>NIM</th>
			<th>NAMA</th>
			<th>TELP</th>
			<th>ALAMAT</th>
			<th>Opsi</th>
		</tr>
		<?php
		require_once "koneksi.php";
		$no = 1;
		$data = mysqli_query($koneksi,"select * from mahasiswa");
		while($d=mysqli_fetch_array($data)){
			?>
				<tr>
					<td width="50px" style="text-align-last: center;"><?php echo $no++;?></td>
					<td width="100px" style="padding-left: 5px;"><?php echo $d['NIM'];?></td>
					<td width="150px" style="padding-left: 5px;"><?php echo $d['NAMA'];?></td>
					<td width="150px" style="padding-left: 5px;"><?php echo $d['TELP'];?></td>
					<td width="500px" style="padding-left: 5px;"><?php echo $d['ALAMAT'];?></td>
					<td style="padding-left: 5px;">
						<a href="form.php?id=<?php echo $d['NIM'];?>">EDIT</a> | 
						<a href="index.php?id=<?php echo $d['NIM'];?>">HAPUS</a>

					</td>
				</tr>
		<?php
		}
		?>
	</table>
	</body>
	</html>

	<?php


	if(isset($_GET['id'])){
		$sql = "DELETE FROM mahasiswa WHERE NIM= ".$_GET['id'];
        if ($koneksi->query($sql) === TRUE) {
            echo "<script>alert('Success Delete Data');location.href='index.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
            echo "<script>alert('Error')</script>";
        }
	}
	?>