<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Kebijakan Privasi - LaporanKita</title>
    <meta name="description" content="Kebijakan privasi LaporanKita — bagaimana kami melindungi data pribadi Anda."/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300..600,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter','sans-serif'] }, colors: { brand: { 50:'#f0fdfa',100:'#ccfbf1',500:'#14b8a6',600:'#0d9488',900:'#0f172a' } } } } }
    </script>
    <style>.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 500,'GRAD' 0,'opsz' 24}.icon-filled{font-variation-settings:'FILL' 1}</style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex flex-col min-h-screen">
    <header class="bg-white/80 backdrop-blur-lg border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="bg-brand-900 text-white p-1.5 rounded"><span class="material-symbols-outlined icon-filled text-lg">maps_ugc</span></div>
                <span class="text-xl font-bold text-brand-900">Laporan<span class="text-brand-600">Kita</span></span>
            </a>
            <a href="{{ route('home') }}" class="text-sm font-medium text-slate-500 hover:text-brand-900 flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali
            </a>
        </div>
    </header>

    <main class="flex-grow">
        <div class="bg-brand-900 text-white py-12 px-4 text-center">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined icon-filled text-[24px]">shield</span>
            </div>
            <h1 class="text-3xl font-extrabold mb-2">Kebijakan Privasi</h1>
            <p class="text-brand-100 text-sm">Terakhir diperbarui: 1 Januari 2026</p>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 py-12 space-y-6">
            <div class="bg-brand-50 border border-brand-100 rounded-xl p-5 flex gap-4">
                <span class="material-symbols-outlined icon-filled text-brand-600 text-[28px] shrink-0">verified_user</span>
                <p class="text-sm text-slate-600 leading-relaxed">LaporanKita berkomitmen melindungi privasi Anda. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.</p>
            </div>

            @foreach([
                ['icon'=>'database','title'=>'1. Data yang Kami Kumpulkan','items'=>['Nama, email, dan kata sandi terenkripsi saat registrasi','Data profil opsional: nomor telepon, alamat, foto profil','Konten laporan: judul, deskripsi, lokasi, dan foto','Data teknis: alamat IP dan jenis perangkat untuk keamanan']],
                ['icon'=>'manage_accounts','title'=>'2. Cara Kami Menggunakan Data','items'=>['Memproses dan meneruskan laporan ke instansi terkait','Mengirim notifikasi pembaruan status laporan Anda','Meningkatkan kualitas dan keamanan layanan','Menampilkan statistik anonim untuk kepentingan publik']],
                ['icon'=>'lock','title'=>'3. Keamanan Data','items'=>['Enkripsi HTTPS/TLS untuk semua komunikasi data','Kata sandi disimpan dalam format hash yang tidak dapat dibaca','Akses data dibatasi hanya untuk personel terotorisasi','Pemantauan keamanan sistem secara berkelanjutan']],
                ['icon'=>'person_off','title'=>'4. Hak Anda','items'=>['Akses dan unduh data pribadi yang kami simpan','Perbarui atau koreksi informasi akun kapan saja','Minta penghapusan akun dan seluruh data terkait','Tarik persetujuan penggunaan data Anda']],
            ] as $sec)
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[18px]">{{ $sec['icon'] }}</span>
                    </div>
                    <h2 class="text-base font-extrabold text-slate-900">{{ $sec['title'] }}</h2>
                </div>
                <ul class="space-y-2">
                    @foreach($sec['items'] as $item)
                    <li class="flex items-start gap-2 text-sm text-slate-600">
                        <span class="material-symbols-outlined text-brand-500 text-[14px] mt-0.5 shrink-0">check_circle</span>{{ $item }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[18px]">share</span>
                    </div>
                    <h2 class="text-base font-extrabold text-slate-900">5. Berbagi Informasi</h2>
                </div>
                <p class="text-sm text-slate-600 leading-relaxed">Kami tidak menjual atau menyewakan data pribadi Anda. Data laporan hanya diteruskan kepada instansi pemerintah yang berwenang. Akses publik hanya mencakup judul, kategori, lokasi, dan status laporan — data identitas pribadi tidak dipublikasikan.</p>
            </div>

            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 text-center">
                <p class="text-sm text-slate-600 mb-3">Pertanyaan tentang kebijakan privasi?</p>
                <a href="mailto:halo@laporankita.id" class="inline-flex items-center gap-2 bg-brand-900 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-slate-800 transition-colors">
                    <span class="material-symbols-outlined text-[16px]">mail</span> halo@laporankita.id
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-100 py-6 text-center text-xs text-slate-400">
        © 2026 LaporanKita. <a href="{{ route('home') }}" class="hover:text-brand-600">Beranda</a> ·
        <a href="{{ route('public.syarat') }}" class="hover:text-brand-600">Syarat &amp; Ketentuan</a> ·
        <a href="{{ route('public.faq') }}" class="hover:text-brand-600">FAQ</a>
    </footer>
</body>
</html>
