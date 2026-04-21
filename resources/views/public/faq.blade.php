<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FAQ / Bantuan - LaporanKita</title>
    <meta name="description" content="Pertanyaan yang sering ditanyakan seputar penggunaan platform LaporanKita."/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300..600,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter','sans-serif'] }, colors: { brand: { 50:'#f0fdfa',100:'#ccfbf1',500:'#14b8a6',600:'#0d9488',900:'#0f172a' } } } } }
    </script>
    <style>
        .material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 500,'GRAD' 0,'opsz' 24}
        .icon-filled{font-variation-settings:'FILL' 1}
        details summary { cursor: pointer; list-style: none; }
        details summary::-webkit-details-marker { display: none; }
        details[open] .faq-icon { transform: rotate(180deg); }
        .faq-icon { transition: transform 0.25s ease; }
        details[open] > div { animation: fadeIn 0.2s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-4px); } to { opacity: 1; transform: translateY(0); } }
    </style>
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
                <span class="material-symbols-outlined icon-filled text-[24px]">contact_support</span>
            </div>
            <h1 class="text-3xl font-extrabold mb-2">FAQ / Bantuan</h1>
            <p class="text-brand-100 text-sm">Temukan jawaban atas pertanyaan yang sering ditanyakan</p>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 py-12 space-y-10">

            @php
            $faqs = [
                [
                    'category' => 'Akun & Registrasi',
                    'icon' => 'person',
                    'items' => [
                        ['q' => 'Apakah saya wajib daftar untuk membuat laporan?', 'a' => 'Ya, Anda perlu membuat akun terlebih dahulu untuk membuat laporan. Ini memastikan laporan dapat dilacak dan Anda mendapat notifikasi pembaruan status.'],
                        ['q' => 'Bagaimana cara mendaftar di LaporanKita?', 'a' => 'Klik tombol "Login / Register" di halaman beranda, lalu pilih tab "Daftar". Isi nama, email, dan kata sandi Anda. Akun langsung aktif tanpa perlu verifikasi email.'],
                        ['q' => 'Saya lupa kata sandi, bagaimana?', 'a' => 'Saat ini fitur reset kata sandi melalui email sedang dalam pengembangan. Hubungi kami di halo@laporankita.id dengan menyertakan nama dan email akun Anda untuk bantuan manual.'],
                    ]
                ],
                [
                    'category' => 'Membuat Laporan',
                    'icon' => 'edit_document',
                    'items' => [
                        ['q' => 'Jenis laporan apa saja yang bisa dibuat?', 'a' => 'Anda dapat melaporkan masalah infrastruktur (jalan rusak, drainase), fasilitas publik (taman, fasilitas umum), layanan publik yang tidak berjalan, dan berbagai pengaduan non-darurat lainnya.'],
                        ['q' => 'Berapa banyak foto yang bisa dilampirkan?', 'a' => 'Anda dapat melampirkan hingga beberapa foto sekaligus. Pastikan setiap foto berukuran maksimal 5MB dan berformat JPEG atau PNG.'],
                        ['q' => 'Apakah lokasi wajib diisi?', 'a' => 'Lokasi sangat direkomendasikan untuk diisi agar laporan dapat diteruskan ke instansi yang tepat dan penanganan lebih cepat. Namun secara teknis, kolom ini bersifat opsional.'],
                        ['q' => 'Bisakah saya mengedit laporan setelah dikirim?', 'a' => 'Laporan yang sudah terkirim tidak dapat diedit untuk menjaga integritas data. Jika ada kesalahan kritis, hubungi admin kami.'],
                    ]
                ],
                [
                    'category' => 'Status Laporan',
                    'icon' => 'track_changes',
                    'items' => [
                        ['q' => 'Apa arti status "Baru", "Diproses", dan "Selesai"?', 'a' => '"Baru" berarti laporan baru diterima dan menunggu verifikasi admin. "Diproses" berarti laporan telah diverifikasi dan diteruskan ke instansi terkait yang sedang menanganinya. "Selesai" berarti masalah telah ditindaklanjuti dan laporan ditutup.'],
                        ['q' => 'Berapa lama waktu respons untuk setiap laporan?', 'a' => 'Verifikasi admin dilakukan dalam 1×24 jam kerja. Waktu penanganan oleh instansi bervariasi tergantung kompleksitas masalah, biasanya antara 3-14 hari kerja.'],
                        ['q' => 'Bagaimana cara memantau perkembangan laporan saya?', 'a' => 'Login ke dashboard Anda dan klik "Laporan Saya" untuk melihat semua laporan beserta statusnya. Anda juga akan mendapat notifikasi otomatis setiap ada perubahan status.'],
                    ]
                ],
                [
                    'category' => 'Teknis & Lainnya',
                    'icon' => 'settings',
                    'items' => [
                        ['q' => 'Browser apa yang didukung LaporanKita?', 'a' => 'LaporanKita mendukung semua browser modern seperti Chrome, Firefox, Safari, dan Edge versi terbaru. Pastikan JavaScript diaktifkan untuk pengalaman terbaik.'],
                        ['q' => 'Apakah ada aplikasi mobile LaporanKita?', 'a' => 'Saat ini LaporanKita tersedia dalam versi web yang responsif dan dapat diakses dari browser ponsel Anda. Aplikasi mobile native sedang dalam tahap pengembangan.'],
                        ['q' => 'Bagaimana cara menghapus akun saya?', 'a' => 'Untuk menghapus akun beserta seluruh data, hubungi kami melalui email halo@laporankita.id. Proses penghapusan akan diselesaikan dalam 7 hari kerja.'],
                    ]
                ],
            ];
            @endphp

            @foreach($faqs as $group)
            <section>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-lg bg-brand-900 text-white flex items-center justify-center">
                        <span class="material-symbols-outlined icon-filled text-[18px]">{{ $group['icon'] }}</span>
                    </div>
                    <h2 class="text-lg font-extrabold text-slate-900">{{ $group['category'] }}</h2>
                </div>
                <div class="space-y-3">
                    @foreach($group['items'] as $faq)
                    <details class="bg-white border border-slate-200 rounded-xl overflow-hidden group shadow-sm hover:shadow-md transition-shadow">
                        <summary class="flex items-center justify-between p-5 gap-4">
                            <span class="font-semibold text-slate-900 text-sm leading-snug">{{ $faq['q'] }}</span>
                            <span class="material-symbols-outlined faq-icon text-slate-400 text-[20px] shrink-0">expand_more</span>
                        </summary>
                        <div class="px-5 pb-5 pt-0">
                            <div class="h-px bg-slate-100 mb-4"></div>
                            <p class="text-sm text-slate-600 leading-relaxed">{{ $faq['a'] }}</p>
                        </div>
                    </details>
                    @endforeach
                </div>
            </section>
            @endforeach

            {{-- Kontak --}}
            <div class="bg-brand-900 rounded-2xl p-8 text-white text-center">
                <span class="material-symbols-outlined icon-filled text-[36px] mb-3 block">support_agent</span>
                <h2 class="text-xl font-extrabold mb-2">Masih ada pertanyaan?</h2>
                <p class="text-brand-100 text-sm mb-5">Tim kami siap membantu Anda melalui email.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="mailto:halo@laporankita.id" class="inline-flex items-center justify-center gap-2 bg-white text-brand-900 font-bold px-6 py-3 rounded-xl text-sm hover:bg-brand-50 transition-colors">
                        <span class="material-symbols-outlined text-[16px]">mail</span> halo@laporankita.id
                    </a>
                    <a href="{{ route('public.prosedur') }}" class="inline-flex items-center justify-center gap-2 border border-white/30 text-white font-semibold px-6 py-3 rounded-xl text-sm hover:bg-white/10 transition-colors">
                        <span class="material-symbols-outlined text-[16px]">assignment</span> Lihat Prosedur Laporan
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-100 py-6 text-center text-xs text-slate-400">
        © 2026 LaporanKita. <a href="{{ route('home') }}" class="hover:text-brand-600">Beranda</a> ·
        <a href="{{ route('public.syarat') }}" class="hover:text-brand-600">Syarat &amp; Ketentuan</a> ·
        <a href="{{ route('public.privasi') }}" class="hover:text-brand-600">Kebijakan Privasi</a>
    </footer>
</body>
</html>
