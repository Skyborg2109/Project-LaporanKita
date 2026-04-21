<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Syarat & Ketentuan - LaporanKita</title>
    <meta name="description" content="Syarat dan ketentuan penggunaan platform LaporanKita — layanan aspirasi dan pelaporan masyarakat Indonesia."/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300..600,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter','sans-serif'] }, colors: { brand: { 50:'#f0fdfa',100:'#ccfbf1',500:'#14b8a6',600:'#0d9488',800:'#115e59',900:'#0f172a' } } } } }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings:'FILL' 0,'wght' 500,'GRAD' 0,'opsz' 24; }
        .icon-filled { font-variation-settings:'FILL' 1; }
        .prose h2 { @apply text-xl font-extrabold text-slate-900 mt-8 mb-3; }
        .prose p  { @apply text-slate-600 text-sm leading-relaxed mb-4; }
        .prose ul { @apply list-disc pl-5 text-sm text-slate-600 space-y-2 mb-4; }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex flex-col min-h-screen">

    <header class="bg-white/80 backdrop-blur-lg border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="bg-brand-900 text-white p-1.5 rounded flex items-center justify-center">
                    <span class="material-symbols-outlined icon-filled text-lg">maps_ugc</span>
                </div>
                <span class="text-xl font-bold tracking-tight text-brand-900">Laporan<span class="text-brand-600">Kita</span></span>
            </a>
            <a href="{{ route('home') }}" class="text-sm font-medium text-slate-500 hover:text-brand-900 flex items-center gap-1 transition-colors">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali
            </a>
        </div>
    </header>

    <main class="flex-grow">
        <div class="bg-brand-900 text-white py-12 px-4 text-center">
            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined icon-filled text-[24px]">gavel</span>
            </div>
            <h1 class="text-3xl font-extrabold mb-2">Syarat &amp; Ketentuan</h1>
            <p class="text-brand-100 text-sm">Terakhir diperbarui: 1 Januari 2026</p>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 py-12">
            <div class="bg-amber-50 border border-amber-200 rounded-xl p-5 mb-8 flex gap-3">
                <span class="material-symbols-outlined icon-filled text-amber-500 shrink-0 mt-0.5">info</span>
                <p class="text-sm text-amber-800">Dengan menggunakan layanan <strong>LaporanKita</strong>, Anda dianggap telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan berikut.</p>
            </div>

            <div class="prose">
                <h2>1. Penerimaan Syarat</h2>
                <p>Akses dan penggunaan platform LaporanKita tunduk pada syarat dan ketentuan ini. Jika Anda tidak menyetujui syarat ini, harap hentikan penggunaan layanan kami.</p>

                <h2>2. Layanan yang Disediakan</h2>
                <p>LaporanKita menyediakan platform digital untuk masyarakat menyampaikan laporan, aspirasi, dan pengaduan terkait layanan publik dan infrastruktur kepada instansi terkait.</p>

                <h2>3. Kewajiban Pengguna</h2>
                <p>Sebagai pengguna, Anda wajib:</p>
                <ul>
                    <li>Memberikan informasi yang akurat, jujur, dan dapat dipertanggungjawabkan</li>
                    <li>Tidak mengunggah konten berbau SARA, hoaks, atau melanggar hukum</li>
                    <li>Hanya melaporkan kejadian yang benar-benar Anda saksikan atau alami</li>
                    <li>Menghormati privasi pihak lain dalam setiap laporan</li>
                    <li>Tidak menyalahgunakan platform untuk kepentingan pribadi yang merugikan pihak lain</li>
                </ul>

                <h2>4. Konten Laporan</h2>
                <p>Seluruh konten yang diunggah menjadi milik pelapor, namun dengan menyetujui syarat ini, pengguna memberikan izin kepada LaporanKita untuk menggunakan, menampilkan, dan mendistribusikan konten tersebut untuk tujuan pelayanan publik.</p>
                <p>LaporanKita berhak menolak, menyembunyikan, atau menghapus laporan yang dianggap melanggar ketentuan ini tanpa pemberitahuan sebelumnya.</p>

                <h2>5. Akun dan Keamanan</h2>
                <p>Anda bertanggung jawab penuh atas kerahasiaan kata sandi akun Anda. Segera hubungi kami jika menduga terjadi akses tidak sah pada akun Anda.</p>

                <h2>6. Pembatasan Tanggung Jawab</h2>
                <p>LaporanKita berperan sebagai perantara antara masyarakat dan instansi pemerintah. Kami tidak bertanggung jawab langsung atas tindak lanjut atau ketidaktindaklanjutan laporan oleh instansi terkait.</p>

                <h2>7. Perubahan Ketentuan</h2>
                <p>Kami berhak mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan diumumkan melalui halaman ini dengan memperbarui tanggal revisi.</p>

                <h2>8. Hukum yang Berlaku</h2>
                <p>Syarat dan ketentuan ini diatur berdasarkan hukum Negara Kesatuan Republik Indonesia. Setiap perselisihan yang timbul akan diselesaikan melalui jalur yang sesuai dengan ketentuan hukum yang berlaku.</p>
            </div>

            <div class="mt-10 p-6 bg-brand-50 rounded-2xl border border-brand-100 text-center">
                <p class="text-sm text-slate-600 mb-4">Pertanyaan tentang syarat dan ketentuan?</p>
                <a href="mailto:halo@laporankita.id" class="inline-flex items-center gap-2 bg-brand-900 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-slate-800 transition-colors">
                    <span class="material-symbols-outlined text-[16px]">mail</span> Hubungi Kami
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-100 py-6 text-center text-xs text-slate-400">
        © 2026 LaporanKita. <a href="{{ route('home') }}" class="hover:text-brand-600">Beranda</a> ·
        <a href="{{ route('public.privasi') }}" class="hover:text-brand-600">Kebijakan Privasi</a> ·
        <a href="{{ route('public.faq') }}" class="hover:text-brand-600">FAQ</a>
    </footer>
</body>
</html>
