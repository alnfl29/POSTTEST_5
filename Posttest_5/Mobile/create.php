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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Form Desain</title>

	<style>
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

	</style>
</head>
<body>
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
</html>

