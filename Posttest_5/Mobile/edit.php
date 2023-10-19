<?php
require "koneksi.php";



// Fungsi untuk mengupdate data
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $merk = $_POST["merk"];
    $ukuran = $_POST["ukuran"];
    $warna = $_POST["warna"];
    $harga = $_POST["harga"];
    $result = mysqli_query($conn, "UPDATE sepatu SET merk='$merk', ukuran='$ukuran', warna='$warna', harga='$harga' WHERE id='$id'");

    if (!$result) {
        echo "<script>alert('Gagal memperbarui data!')</script>";
    } else {
        echo "<script>alert('Sukses memperbarui data!'); document.location = 'sepatu.php'</script>";
    }
}

// Jika ada parameter id di URL, tampilkan data untuk diedit
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = mysqli_query($conn, "SELECT * FROM sepatu WHERE id='$id'");
    $dataEdit = mysqli_fetch_assoc($result);
}

// Mengambil semua data dari tabel sepatu
$dataSepatu = mysqli_query($conn, "SELECT * FROM sepatu");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
    <!-- Form untuk menambah atau mengedit data -->
	<form action="" method="post">
        <!-- Jika sedang mode edit, tampilkan input hidden untuk id -->
        <?php if (isset($dataEdit)): ?>
            <input type="hidden" name="id" value="<?php echo $dataEdit['id']; ?>">
        <?php endif; ?>

		<label for="merk">Merk</label>
		<input type="text" name="merk" value="<?php echo isset($dataEdit) ? $dataEdit['merk'] : ''; ?>">
		<br>

		<label for="ukuran">Ukuran</label>
		<input type="number" name="ukuran" value="<?php echo isset($dataEdit) ? $dataEdit['ukuran'] : ''; ?>">
		<br>

		<label for="warna">Warna</label>
		<input type="text" name="warna" value="<?php echo isset($dataEdit) ? $dataEdit['warna'] : ''; ?>">
		<br>

		<label for="harga">harga</label>
		<input type="number" name="harga" value="<?php echo isset($dataEdit) ? $dataEdit['harga'] : ''; ?>">
		<br>

        <!-- Jika sedang mode edit, tampilkan tombol Update, jika tidak tampilkan tombol Tambah -->
        <?php if (isset($dataEdit)): ?>
            <input type="submit" name="update" value="Update">
        <?php else: ?>
		    <input type="submit" name="tambah" value="Tambah">
        <?php endif; ?>
	</form>

	<!-- Menampilkan data sepatu dalam bentuk tabel -->
	<table border="1">
		<thead>
			<tr>
				<th>Merk</th>
				<th>Ukuran</th>
				<th>Warna</th>
				<th>Harga</th>
                <th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = mysqli_fetch_assoc($dataSepatu)): ?>
				<tr>
					<td><?php echo $row['merk']; ?></td>
					<td><?php echo $row['ukuran']; ?></td>
					<td><?php echo $row['warna']; ?></td>
					<td><?php echo $row['harga']; ?></td>
                    <td>
                        <!-- Tombol Edit -->
                        <a href="sepatu.php?id=<?php echo $row['id']; ?>">Edit</a>
                    </td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</body>
</html>
