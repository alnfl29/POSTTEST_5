<?php
require "koneksi.php";
if (isset($_POST["tambah"])) {
    $merk = $_POST["merk"];
    $ukuran = $_POST["ukuran"];
    $warna = $_POST["warna"];
    $harga = $_POST["harga"];
    $result = mysqli_query($conn, "INSERT INTO sepatu (merk, ukuran, warna, harga) VALUES ('$merk', '$ukuran', '$warna', '$harga')");

    if (!$result) {
        echo "<script>alert('Gagal menambahkan data!')</script>";
    } else {
        echo "<script>alert('Sukses menambahkan data!'); document.location = 'sepatu.php'</script>";
    }
}

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

// Fungsi untuk menghapus data
if (isset($_GET["hapus"])) {
    $id = $_GET["hapus"];
    $result = mysqli_query($conn, "DELETE FROM sepatu WHERE id='$id'");

    if (!$result) {
        echo "<script>alert('Gagal menghapus data!')</script>";
    } else {
        echo "<script>alert('Sukses menghapus data!'); document.location = 'sepatu.php'</script>";
    }
}


// Mengambil semua data dari tabel sepatu
$dataSepatu = mysqli_query($conn, "SELECT * FROM sepatu");
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<title>CRUD</title>

    <style>

        header {
            background-color: #333;
            color: white;
            text-align: center;
            background-image: url(toko.jpeg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            padding: 40px 0; /* Mengurangi padding untuk membuat header lebih kecil */
        }

        header::before {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.5);
                    /* Overlay hitam transparan */
                    z-index: 1;
                    /* Pastikan overlay berada di atas gambar tetapi di bawah teks */
                }

        header h1 {
            margin: 0;
            font-size: 1.8em; /* Mengurangi ukuran font */
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            z-index: 2;
            position: relative;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px; /* Mengurangi padding */
            border-radius: 8px; /* Menambahkan border-radius untuk efek melengkung */
        }

        header h1:first-child {
            margin-bottom: 0.1em;
            font-size: 2.5em; /* Mengurangi ukuran font untuk "Selamat Datang" */
            color: #FFD700;
        }

        .btn-index {
            display: inline-block;
            padding: 10px 20px;
            background-color: #7f00ff;
            position: relative;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: xx-large;
            transition: background-color 0.3s;
        }

        .btn-index:hover {
            background-color: #ff4b5c;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url(toko.jpeg);
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            position: relative; /* Menambahkan posisi relatif agar pseudo-element ::before berfungsi dengan benar */
        }

        /* Menambahkan lapisan hitam transparan di atas gambar latar belakang */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Hitam dengan 50% transparansi */
            z-index: -1; /* Memastikan lapisan berada di belakang konten halaman */
        }

        .form-container {
            background-color: #000;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 20px 50px rgba(128, 0, 128, 0.6); /* Purple shadow */
            max-width: 650px;
            margin: 50px auto;
        }

        h2 {
            color: #ffffff;
        }
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 15px;
            font-weight: 600;
            color: #fff;
        }

        input[type="text"], input[type="number"] {
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 16px;
            background-color: #222;
            color: #fff;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        input[type="submit"] {
            margin-top: 25px;
            padding: 12px 20px;
            background-color: #007BFF;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 85%;
            margin: 50px auto;
            border-collapse: collapse;
            background-color: #000;
            box-shadow: 0 20px 50px rgba(128, 0, 128, 0.6); /* Purple shadow */
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px 20px;
            border-bottom: 1px solid #333;
            color: #fff;
        }

        th {
            background-color: #222;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            margin: 0 8px;
            padding: 5px 8px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: rgba(0, 123, 255, 0.1);
        }

        /* Additional color for delete action */
        a[href*="hapus"] {
            color: #ff4b5c;
        }

        a[href*="hapus"]:hover {
            background-color: rgba(255, 75, 92, 0.1);
        }

        /* Efek hover yang ditingkatkan untuk baris tabel */
        table tbody tr:hover {
            background-color: rgba(128, 0, 128, 0.2); /* Semerbak ungu */
            transform: scale(1.02);
            transition: transform 0.3s, background-color 0.3s;
        }

        /* Efek fokus dan hover yang ditingkatkan untuk bidang input */
        input[type="text"]:focus, input[type="number"]:focus, input[type="text"]:hover, input[type="number"]:hover {
            border-color: #7f00ff; /* Ungu yang lebih cerah */
            background-color: #111;
        }

        /* Efek hover yang ditingkatkan untuk tombol kirim */
        input[type="submit"]:hover {
            background-color: #7f00ff; /* Ungu yang lebih cerah */
            box-shadow: 0 4px 10px rgba(128, 0, 128, 0.4); /* Bayangan ungu */
        }

        /* Efek hover yang ditingkatkan untuk tautan */
        a:hover {
            background-color: rgba(128, 0, 128, 0.2); /* Semerbak ungu */
            box-shadow: 0 2px 5px rgba(128, 0, 128, 0.4); /* Bayangan ungu */
        }

        /* Efek hover yang ditingkatkan untuk tindakan hapus */
        a[href*="hapus"]:hover {
            background-color: rgba(255, 75, 92, 0.2);
            box-shadow: 0 2px 5px rgba(255, 75, 92, 0.4); /* Bayangan merah */
        }

        a i.fas {
            font-size: 20px;
            margin: 0 5px;
            transition: color 0.3s, transform 0.3s;
        }

        a i.fa-edit:hover {
            color: #007BFF; /* Warna biru saat di-hover */
            transform: scale(1.2); /* Membuat ikon sedikit membesar saat di-hover */
        }

        a i.fa-trash-alt:hover {
            color: #ff4b5c; /* Warna merah saat di-hover */
            transform: scale(1.2); /* Membuat ikon sedikit membesar saat di-hover */
        }

        footer {
            background-color: #272626;
            color: white;
            text-align: center;
            padding: 3em 0;
            margin-top: 20px;
        }




    </style>

</head>
<body>

<!-- Header -->
<header>
        <h1><i class="fa-solid fa-shoe-prints"></i> Selamat Datang Di Toko Sepatu Matrix <i
                class="fa-solid fa-shoe-prints"></i></h1>

    </header>

<a href="index.php" class="btn-index"><i class="fa-solid fa-shop"></i> Kembali ke Beranda</a>

<div class="form-container">
    <h2>List Produk Sepatu</h2>
	<form action="" method="post">
        <?php if (isset($dataEdit)): ?>
            <input type="hidden" name="id" value="<?php echo $dataEdit['id']; ?>">
        <?php endif; ?>

		<label for="merk">Merk</label>
		<input type="text" name="merk" value="<?php echo isset($dataEdit) ? $dataEdit['merk'] : ''; ?>">

		<label for="ukuran">Ukuran</label>
		<input type="number" name="ukuran" value="<?php echo isset($dataEdit) ? $dataEdit['ukuran'] : ''; ?>">

		<label for="warna">Warna</label>
		<input type="text" name="warna" value="<?php echo isset($dataEdit) ? $dataEdit['warna'] : ''; ?>">

		<label for="harga">Harga</label>
		<input type="number" name="harga" value="<?php echo isset($dataEdit) ? $dataEdit['harga'] : ''; ?>">

        <?php if (isset($dataEdit)): ?>
            <input type="submit" name="update" value="Update">
        <?php else: ?>
		    <input type="submit" name="tambah" value="Tambah">
        <?php endif; ?>
	</form>
</div>

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
                    <a href="sepatu.php?id=<?php echo $row['id']; ?>"><i class="fas fa-edit"></i></a>
                    <!-- Tombol Hapus -->
                    <a href="sepatu.php?hapus=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

 <!-- Footer -->
 <footer>
        PT MATRIX &copy; 2023 Toko Sepatu
    </footer>

</body>
</html>
