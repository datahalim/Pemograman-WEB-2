<?php
// Koneksi Database
$host = "localhost"; $user = "root"; $pass = ""; $db = "db_bukutamu";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // LOGIKA SIMPAN (Jika ada POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama  = htmlspecialchars($_POST['nama']);
        $email = htmlspecialchars($_POST['email']);
        $pesan = htmlspecialchars($_POST['pesan']);

        $sql  = "INSERT INTO tamu (nama, email, pesan) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $email, $pesan]);

        echo "<script>alert('Data Berhasil Disimpan!'); window.location.href='tampil.php';</script>";
        exit;
    }

    // Ambil Data untuk Ditampilkan
    $stmt = $pdo->query("SELECT * FROM tamu ORDER BY id DESC");
    $data_tamu = $stmt->fetchAll();
    $total_record = count($data_tamu);

} catch (PDOException $e) {
    die("Koneksi Gagal: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku Tamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 p-4 md:p-8">
    <div class="max-w-6xl mx-auto">
        
        <!-- Header & Stats -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-slate-800 flex items-center gap-2">
                    👀 Daftar Buku Tamu
                </h2>
                <p class="text-slate-500 mt-1">Total Data: <span class="font-bold text-emerald-600"><?= $total_record ?> record</span></p>
            </div>
            <a href="index.php" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-lg font-semibold transition shadow-md">
                + Isi Buku Tamu
            </a>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-emerald-500 text-white">
                            <th class="p-4 font-semibold uppercase text-xs tracking-wider">No</th>
                            <th class="p-4 font-semibold uppercase text-xs tracking-wider">Nama</th>
                            <th class="p-4 font-semibold uppercase text-xs tracking-wider">Email</th>
                            <th class="p-4 font-semibold uppercase text-xs tracking-wider">Komentar</th>
                            <th class="p-4 font-semibold uppercase text-xs tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php if ($total_record > 0): ?>
                            <?php $no = 1; foreach ($data_tamu as $row): ?>
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 text-slate-600"><?= $no++ ?></td>
                                <td class="p-4 font-bold text-slate-700"><?= htmlspecialchars($row['nama']) ?></td>
                                <td class="p-4 text-emerald-600 italic"><?= htmlspecialchars($row['email']) ?></td>
                                <td class="p-4 text-slate-600"><?= htmlspecialchars($row['pesan']) ?></td>
                                <td class="p-4 text-slate-400 text-sm"><?= $row['tanggal'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400">Belum ada data tamu.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Placeholder (Sesuai gambar image_9fd5cb.png) -->
        <div class="mt-6 flex items-center gap-2">
            <button class="px-4 py-2 bg-slate-200 text-slate-500 rounded text-sm cursor-not-allowed">« Awal</button>
            <button class="px-4 py-2 bg-emerald-600 text-white rounded text-sm font-bold shadow-sm">1</button>
            <button class="px-4 py-2 bg-slate-200 text-slate-500 rounded text-sm cursor-not-allowed">Akhir »</button>
        </div>

    </div>
</body>
</html>