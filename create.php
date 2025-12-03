<?php
include 'config.php';
include 'upload.php';

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $alamat = $_POST['alamat'];
    
    // Upload gambar
    $gambar = uploadGambar();
    if (!$gambar) {
        return false;
    }
    
    $query = "INSERT INTO mahasiswa (nim, nama, prodi, alamat, gambar) 
            VALUES ('$nim', '$nama', '$prodi', '$alamat', '$gambar')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .kembali { background: #ff0000ff; color: white; padding: 9px 19px; border: none; border-radius: 3.5px; cursor: pointer; }
        .kembali:hover { background: #aa0000ff; }
    </style>
</head>
<body>
    <h2>Tambah Data Mahasiswa</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>NIM:</label>
            <input type="text" class="form-control" name="nim" required>
        </div>
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" class="form-control" name="nama" required>
        </div>
        <div class="form-group">
            <label>Prodi:</label>
            <input type="text" class="form-control" name="prodi" required>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea class="form-control" name="alamat" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Gambar:</label>
            <input type="file" class="form-control" name="gambar">
        </div>
        <button type="submit" name="submit">Simpan</button>
        <a href="index.php" style="margin-left: 10px;" class="kembali">Kembali</a>
    </form>

    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>