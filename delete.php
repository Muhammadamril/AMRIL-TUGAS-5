<?php
include 'config.php';

$nim = $_GET['nim'];

// Ambil data gambar sebelum menghapus
$query_select = "SELECT gambar FROM mahasiswa WHERE nim='$nim'";
$result = mysqli_query($conn, $query_select);
$data = mysqli_fetch_assoc($result);

// Hapus data dari database
$query = "DELETE FROM mahasiswa WHERE nim='$nim'";

if (mysqli_query($conn, $query)) {
    // Hapus file gambar jika bukan default
    if ($data['gambar'] != ' ') {
        unlink('gambar/' . $data['gambar']);
    }
    echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>