<?php
include 'config.php';
include 'upload.php';

$nim = $_GET['nim'];
$query = "SELECT * FROM mahasiswa WHERE nim='$nim'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $alamat = $_POST['alamat'];
    
    // Handle gambar
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $data['gambar'];
    } else {
        $gambar = uploadGambar();
        // Hapus gambar lama jika bukan default
        if ($data['gambar'] != 'default.jpg') {
            unlink('gambar/' . $data['gambar']);
        }
    }
    
    $query = "UPDATE mahasiswa SET 
                nama='$nama', 
                prodi='$prodi', 
                alamat='$alamat', 
                gambar='$gambar' 
                WHERE nim='$nim'";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, textarea, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #218838; }
        .kem { background: #ff0000ff; color: white; padding: 9px 19px; border: none; border-radius: 4px; cursor: pointer; }
        .kem :hover { background: #940000ff; }
        .current-image { width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin: 10px 0; }
    </style>
</head>
    <h2>Edit Data Mahasiswa</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>NIM:</label>
            <input type="text" class="form-control" name="nim" value="<?php echo $data['nim']; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" class="form-control" name="nama" value="<?php echo $data['nama']; ?>" required>
        </div>
        <div class="form-group">
            <label>Prodi:</label>
            <input type="text" class="form-control" name="prodi" value="<?php echo $data['prodi']; ?>" required>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" rows="3" class="form-control"><?php echo $data['alamat']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Gambar Saat Ini:</label><br>
            <img src="gambar/<?php echo $data['gambar']; ?>" class="current-image" alt="Current Image">
        </div>
        <div class="form-group">
            <label>Gambar Baru:</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <button type="submit" name="submit">Update</button>
        <a href="index.php" style="margin-left: 10px;" class="kem">Kembali</a>
    </form>

    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>