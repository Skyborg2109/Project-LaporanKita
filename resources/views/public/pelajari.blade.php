<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Pelajari Layanan Darurat - LaporanKita</title>
    <meta name="description" content="Informasi lengkap tentang layanan darurat 112 dan cara memanfaatkan platform LaporanKita untuk keadaan darurat."/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300..600,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { brand: { 50: '#f0fdfa', 100: '#ccfbf1', 500: '#14b8a6', 600: '#0d9488', 800: '#115e59', 900: '#0f172a' } }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; }
        .icon-filled { font-variation-settings: 'FILL' 1; }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex flex-col min-h-screen">

    <header class="bg-white/80 backdrop-blur-lg border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="bg-brand-900 text-white p-1.5 rounded flex items-center justify-center">
                        <span class="material-symbols-outlined icon-filled text-lg">maps_ugc</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-brand-900">Laporan<span class="text-brand-600">Kita</span></span>
                </a>
                <a href="{{ route('home') }}" class="text-sm font-medium text-slate-500 hover:text-brand-900 transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali
                </a>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        {{-- Hero --}}
        <div class="bg-rose-700 text-white py-14 px-4">
            <div class="max-w-3xl mx-auto text-center">
                <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center mx-auto mb-5">
                    <span class="material-symbols-outlined icon-filled text-[36px]">emergency</span>
                </div>
                <span class="inline-block text-xs font-bold uppercase tracking-widest bg-white/20 px-3 py-1 rounded-full mb-4">Layanan Darurat</span>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-3">Pelajari Layanan Darurat</h1>
                <p class="text-rose-100 text-base max-w-xl mx-auto">Nomor tunggal darurat <strong class="text-white">112</strong> aktif 24 jam, 7 hari seminggu untuk situasi yang mengancam jiwa dan keselamatan.</p>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 py-12 space-y-10">

            {{-- Apa itu 112 --}}
            <section class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined icon-filled text-[24px]">call</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-900 mb-2">Apa itu Nomor 112?</h2>
                        <p class="text-slate-600 text-sm leading-relaxed mb-4">
                            Nomor 112 adalah nomor darurat nasional Indonesia yang terintegrasi untuk menghubungkan warga dengan layanan polisi, pemadam kebakaran, ambulans, dan penanganan bencana dalam satu jalur komunikasi cepat.
                        </p>
                        <div class="bg-rose-50 border border-rose-100 rounded-xl p-4">
                            <p class="text-rose-800 text-sm font-semibold">⚡ Layanan ini <span class="underline">GRATIS</span> dan dapat diakses dari seluruh operator seluler maupun telepon rumah tanpa pulsa.</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Kapan pakai 112 --}}
            <section>
                <h2 class="text-xl font-extrabold text-slate-900 mb-5">Kapan Harus Menghubungi 112?</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                    $situations = [
                        ['icon' => 'local_fire_department', 'color' => 'orange', 'title' => 'Kebakaran', 'desc' => 'Kebakaran gedung, rumah, atau lahan yang membutuhkan penanganan segera.'],
                        ['icon' => 'medical_services', 'color' => 'red', 'title' => 'Darurat Medis', 'desc' => 'Serangan jantung, kecelakaan serius, atau kondisi yang mengancam jiwa.'],
                        ['icon' => 'local_police', 'color' => 'blue', 'title' => 'Kejahatan Aktif', 'desc' => 'Perampokan, kekerasan, atau ancaman kriminal yang sedang terjadi.'],
                        ['icon' => 'flood', 'color' => 'teal', 'title' => 'Bencana Alam', 'desc' => 'Banjir, tanah longsor, gempa, atau bencana alam yang membutuhkan evakuasi segera.'],
                    ];
                    @endphp
                    @foreach($situations as $item)
                    <div class="bg-white border border-slate-200 rounded-xl p-5 flex gap-4 hover:shadow-md transition-shadow">
                        <div class="w-10 h-10 rounded-lg bg-slate-50 text-slate-500 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined icon-filled text-[22px]">{{ $item['icon'] }}</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 text-sm mb-1">{{ $item['title'] }}</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            {{-- Perbedaan 112 vs LaporanKita --}}
            <section class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                <h2 class="text-xl font-extrabold text-slate-900 mb-5">112 vs LaporanKita: Apa Bedanya?</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <th class="text-left py-3 text-slate-500 font-semibold text-xs uppercase tracking-wider">Aspek</th>
                                <th class="text-center py-3 text-rose-600 font-bold text-xs uppercase tracking-wider">112 (Darurat)</th>
                                <th class="text-center py-3 text-brand-600 font-bold text-xs uppercase tracking-wider">LaporanKita</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <tr>
                                <td class="py-3 text-slate-600 font-medium">Jenis Situasi</td>
                                <td class="py-3 text-center text-slate-700">Mengancam jiwa</td>
                                <td class="py-3 text-center text-slate-700">Non-darurat, infrastruktur</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-slate-600 font-medium">Respons</td>
                                <td class="py-3 text-center text-slate-700">Menit</td>
                                <td class="py-3 text-center text-slate-700">1×24 jam verifikasi</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-slate-600 font-medium">Cara Akses</td>
                                <td class="py-3 text-center text-slate-700">Telepon langsung</td>
                                <td class="py-3 text-center text-slate-700">Platform digital</td>
                            </tr>
                            <tr>
                                <td class="py-3 text-slate-600 font-medium">Contoh Kasus</td>
                                <td class="py-3 text-center text-slate-700">Kebakaran, kecelakaan</td>
                                <td class="py-3 text-center text-slate-700">Jalan rusak, drainase</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- CTA --}}
            <div class="bg-brand-900 rounded-2xl p-8 text-white text-center">
                <h2 class="text-xl font-extrabold mb-2">Butuh Laporan Non-Darurat?</h2>
                <p class="text-brand-100 text-sm mb-6">Gunakan LaporanKita untuk melaporkan masalah infrastruktur, fasilitas publik, dan keluhan layanan masyarakat yang bukan kondisi darurat.</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('laporan.create') }}" class="bg-white text-brand-900 font-bold px-6 py-3 rounded-xl text-sm hover:bg-brand-50 transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">edit_document</span> Buat Laporan Sekarang
                    </a>
                    <a href="{{ route('home') }}" class="border border-white/30 text-white font-semibold px-6 py-3 rounded-xl text-sm hover:bg-white/10 transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">home</span> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-100 py-6 text-center text-xs text-slate-400">
        © 2026 LaporanKita. <a href="{{ route('home') }}" class="hover:text-brand-600 transition-colors">Beranda</a>
    </footer>
</body>
</html>
