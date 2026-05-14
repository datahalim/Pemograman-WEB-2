<?php
// 1. Menghubungkan ke file koneksi
include "koneksi.php";

/**
 * MODIFIKASI: 
 * Menggunakan kolom 'id' sebagai referensi penghapusan karena kolom 'penulis' 
 * tidak terdeteksi di database 'artikel_db' atau 'db_bukutamu'.
 */

// Contoh menghapus artikel dengan ID nomor 1
$id_artikel = 1; 

// 2. Siapkan Query SQL
$sql = "DELETE FROM artikel WHERE id = '$id_artikel'";

// 3. Eksekusi Query
if (mysqli_query($connection, $sql)) {
    // Memberikan feedback sukses seperti pada contoh gambar latihan
    echo "Data berhasil dihapus!";
} else {
    // Menampilkan pesan error jika terjadi kegagalan teknis
    echo "Error: " . mysqli_error($connection);
}

// 4. Menutup koneksi database
mysqli_close($connection);
?>