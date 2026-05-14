<?php
// 1. KONEKSI DATABASE
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_bukutamu";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. LOGIKA HAPUS (Jika ada parameter ID)
    if (isset($_GET['hapus'])) {
        $id_hapus = $_GET['hapus'];
        $sql_delete = "DELETE FROM tamu WHERE id = ?";
        $stmt_del = $pdo->prepare($sql_delete);
        $stmt_del->execute([$id_hapus]);
        header("Location: tampil.php"); // Refresh halaman
        exit;
    }

    // 3. AMBIL DATA
    $stmt = $pdo->query("SELECT * FROM tamu ORDER BY id DESC");
    $data_tamu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total_data = count($data_tamu);

} catch (PDOException $e) {
    die("Koneksi Gagal: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Guestbook - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen p-4 md:p-10">

    <div class="max-w-6xl mx-auto">
        
        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-slate-800">Daftar Guestbook</h2>
                <p class="text-slate-500 mt-1">Total: <span class="font-bold text-emerald-600"><?= $total_data ?> Pesan Terdaftar</span></p>
            </div>
            <a href="index.php" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2.5 rounded-xl font-semibold transition shadow-lg flex items-center gap-2">
                <span>+</span> Tambah Pesan
            </a>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-400">
                            <th class="p-5 text-xs font-bold uppercase w-16 text-center">No</th>
                            <th class="p-5 text-xs font-bold uppercase">Pengunjung</th>
                            <th class="p-5 text-xs font-bold uppercase">Pesan / Komentar</th>
                            <th class="p-5 text-xs font-bold uppercase">Waktu</th>
                            <th class="p-5 text-xs font-bold uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php if ($total_data > 0): ?>
                            <?php $no = 1; foreach ($data_tamu as $row): ?>
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="p-5 text-center text-slate-400 font-medium text-sm"><?= $no++ ?></td>
                                <td class="p-5">
                                    <div class="font-bold text-slate-700 uppercase"><?= htmlspecialchars($row['nama']) ?></div>
                                    <div class="text-xs text-emerald-600 italic"><?= htmlspecialchars($row['email']) ?></div>
                                </td>
                                <td class="p-5">
                                    <p class="text-slate-600 text-sm italic">"<?= nl2br(htmlspecialchars($row['pesan'])) ?>"</p>
                                </td>
                                <td class="p-5 text-xs text-slate-400">
                                    <!-- Menampilkan tanggal jika kolom ada, jika tidak tampilkan '-' -->
                                    <?= isset($row['tanggal']) ? date('d M Y, H:i', strtotime($row['tanggal'])) : '-' ?>
                                </td>
                                <td class="p-5 text-center">
                                    <a href="?hapus=<?= $row['id'] ?>" 
                                       onclick="return confirm('Hapus pesan dari <?= $row['nama'] ?>?')"
                                       class="text-red-400 hover:text-red-600 font-bold text-xs p-2 border border-red-100 rounded-lg transition hover:bg-red-50">
                                       HAPUS
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="p-20 text-center text-slate-400 italic">Belum ada data tamu.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <p class="mt-8 text-center text-xs text-slate-400 uppercase tracking-widest font-semibold">
            © 2026 Admin Panel • Lili Nurhalim
        </p>
    </div>

</body>
</html>