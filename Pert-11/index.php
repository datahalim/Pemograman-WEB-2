<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Modern - Input</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Inter untuk tampilan lebih profesional -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-slate-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-slate-800">Daftar Buku Tamu</h2>
            <p class="text-slate-500 text-sm mt-2">Silakan tinggalkan pesan Anda di bawah ini.</p>
        </div>
        
        <form action="simpan.php" method="POST" class="space-y-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" required 
                    value="LILI NURHALIM"
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all duration-200 bg-slate-50"
                    placeholder="Masukkan nama Anda">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                <input type="email" name="email" required
                    value="lnurhalim01@gmail.com"
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all duration-200 bg-slate-50"
                    placeholder="nama@email.com">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Pesan / Komentar</label>
                <textarea name="pesan" required rows="4"
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all duration-200 bg-slate-50"
                    placeholder="Tulis pesan Anda di sini..."></textarea>
            </div>

            <button type="submit" 
                class="w-full bg-emerald-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-emerald-700 transform active:scale-95 transition-all duration-200 shadow-lg shadow-emerald-200">
                Kirim Pesan
            </button>
        </form>
        
        <div class="mt-8 pt-6 border-t border-slate-100 flex justify-between items-center">
            <a href="tampil.php" class="text-emerald-600 hover:text-emerald-700 text-sm font-medium transition">View Guestbook →</a>
            <p class="text-xs text-slate-400">© 2026 Admin Panel</p>
        </div>
    </div>

</body>
</html>