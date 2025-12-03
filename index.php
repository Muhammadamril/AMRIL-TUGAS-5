<?php
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        img { width: 50px; height: 50px; object-fit: cover; border-radius: 50%; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; }
        .btn-edit { background: #28a745; color: white; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-add { background: #007bff; color: white; padding: 10px 15px; }
    </style>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <a href="create.php" class="btn btn-add">Tambah Data</a>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM mahasiswa ORDER BY nim";
            $result = mysqli_query($conn, $query);
            $no = 1;
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td><img src='gambar/" . $row['gambar'] . "' alt='" . $row['nama'] . "'></td>";
                echo "<td>" . $row['nim'] . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['prodi'] . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td>
                        <a href='update.php?nim=" . $row['nim'] . "' class='btn btn-edit'>Edit</a>
                        <a href='delete.php?nim=" . $row['nim'] . "' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                        </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>