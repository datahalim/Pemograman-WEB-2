<?php
include "koneksi.php";

// Contoh: Mengubah judul artikel yang memiliki ID 1
$sql = "UPDATE artikel SET judul = 'Judul Baru' WHERE id = 1";

if (mysqli_query($connection, $sql)) {
    echo "Data berhasil diupdate!";
} else {
    echo "Error: " . mysqli_error($connection);
}

mysqli_close($connection);
?>