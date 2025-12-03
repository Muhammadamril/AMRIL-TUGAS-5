<?php
function uploadGambar() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    
    // Cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        return 'default.jpg';
    }
    
    // Cek ekstensi file
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if (!in_array($ekstensiGambar, $ekstensiValid)) {
        echo "<script>alert('Yang anda upload bukan gambar!');</script>";
        return false;
    }
    
    // Cek ukuran file
    if ($ukuranFile > 2000000) {
        echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
        return false;
    }
    
    // Generate nama file baru
    $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
    
    // Pindahkan file ke folder gambar
    move_uploaded_file($tmpName, 'gambar/' . $namaFileBaru);
    
    return $namaFileBaru;
}
?>