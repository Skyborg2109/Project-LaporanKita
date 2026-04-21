<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Prosedur Laporan - LaporanKita</title>
    <meta name="description" content="Pelajari prosedur lengkap cara membuat dan mengelola laporan di platform LaporanKita."/>
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
                <span class="material-symbols-outlined icon-filled text-[24px]">assignment</span>
            </div>
            <h1 class="text-3xl font-extrabold mb-2">Prosedur Laporan</h1>
            <p class="text-brand-100 text-sm">Panduan langkah demi langkah cara membuat laporan yang efektif</p>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 py-12 space-y-8">

            {{-- Alur laporan --}}
            <section>
                <h2 class="text-xl font-extrabold text-slate-900 mb-6">Alur Proses Laporan</h2>
                <div class="relative">
                    <div class="absolute left-6 top-0 bottom-0 w-px bg-slate-200 hidden sm:block"></div>
                    <div class="space-y-6">
                        @foreach([
                            ['step'=>'1','icon'=>'how_to_reg','color'=>'brand','title'=>'Registrasi & Login','desc'=>'Buat akun atau masuk ke LaporanKita. Akun diperlukan agar laporan Anda dapat dilacak dan Anda mendapat notifikasi pembaruan.'],
                            ['step'=>'2','icon'=>'edit_document','color'=>'brand','title'=>'Tulis Laporan','desc'=>'Isi formulir laporan dengan lengkap: judul yang deskriptif, kategori yang tepat, deskripsi detail, lokasi akurat, dan lampirkan minimal 1 foto bukti.'],
                            ['step'=>'3','icon'=>'upload','color'=>'amber','title'=>'Kirim & Konfirmasi','desc'=>'Submit laporan. Anda akan mendapat nomor tiket unik (#LPK-XXXX) sebagai referensi dan email konfirmasi penerimaan laporan.'],
                            ['step'=>'4','icon'=>'manage_search','color'=>'amber','title'=>'Verifikasi Admin','desc'=>'Tim admin LaporanKita memverifikasi kelengkapan dan validitas laporan dalam 1×24 jam kerja. Laporan yang tidak memenuhi syarat dapat dikembalikan untuk dilengkapi.'],
                            ['step'=>'5','icon'=>'send','color'=>'blue','title'=>'Disposisi ke Instansi','desc'=>'Laporan yang terverifikasi diteruskan kepada instansi pemerintah yang berwenang sesuai kategori dan lokasi laporan.'],
                            ['step'=>'6','icon'=>'done_all','color'=>'emerald','title'=>'Tindak Lanjut & Selesai','desc'=>'Instansi menindaklanjuti laporan. Anda akan mendapat notifikasi di setiap perubahan status hingga laporan dinyatakan selesai.'],
                        ] as $step)
                        <div class="flex gap-4 sm:gap-6">
                            <div class="w-12 h-12 rounded-full bg-brand-900 text-white flex items-center justify-center font-bold text-sm shrink-0 z-10 border-4 border-[#FAFAFA]">
                                {{ $step['step'] }}
                            </div>
                            <div class="bg-white rounded-xl border border-slate-200 p-5 flex-grow shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="material-symbols-outlined icon-filled text-brand-600 text-[18px]">{{ $step['icon'] }}</span>
                                    <h3 class="font-bold text-brand-900 text-base">{{ $step['title'] }}</h3>
                                </div>
                                <p class="text-sm text-slate-600 leading-relaxed">{{ $step['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Tips laporan baik --}}
            <section class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <h2 class="text-lg font-extrabold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined icon-filled text-brand-500 text-[22px]">tips_and_updates</span>
                    Tips Laporan yang Efektif
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach([
                        ['icon'=>'photo_camera','tip'=>'Lampirkan minimal 1 foto yang jelas dan relevan dengan masalah yang dilaporkan'],
                        ['icon'=>'location_on','tip'=>'Cantumkan lokasi selengkap-lengkapnya: nama jalan, RT/RW, kelurahan, dan kecamatan'],
                        ['icon'=>'edit','tip'=>'Tulis deskripsi dengan detail: kapan pertama kali ditemukan, seberapa parah dampaknya'],
                        ['icon'=>'category','tip'=>'Pilih kategori yang paling tepat agar laporan langsung diarahkan ke instansi yang benar'],
                    ] as $tip)
                    <div class="flex gap-3 p-4 bg-brand-50 rounded-xl">
                        <span class="material-symbols-outlined text-brand-600 text-[20px] shrink-0 mt-0.5">{{ $tip['icon'] }}</span>
                        <p class="text-xs text-slate-700 leading-relaxed">{{ $tip['tip'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            {{-- Yang tidak bisa dilaporkan --}}
            <section class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <h2 class="text-lg font-extrabold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined icon-filled text-rose-500 text-[22px]">block</span>
                    Yang Tidak Dapat Dilaporkan Melalui LaporanKita
                </h2>
                <ul class="space-y-3">
                    @foreach([
                        'Situasi darurat yang mengancam jiwa — hubungi 112',
                        'Laporan anonim tanpa bukti yang dapat diverifikasi',
                        'Konten yang mengandung SARA, hoaks, atau fitnah',
                        'Laporan yang sama berulang kali (duplikat)',
                        'Pengaduan yang bersifat personal atau sengketa perdata',
                    ] as $item)
                    <li class="flex items-start gap-3 text-sm text-slate-600">
                        <span class="material-symbols-outlined icon-filled text-rose-400 text-[16px] mt-0.5 shrink-0">cancel</span>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>
            </section>

            {{-- CTA --}}
            <div class="bg-brand-900 rounded-2xl p-8 text-white text-center">
                <h2 class="text-xl font-extrabold mb-2">Siap Membuat Laporan?</h2>
                <p class="text-brand-100 text-sm mb-5">Ikuti prosedur di atas dan buat laporan Anda sekarang.</p>
                <a href="{{ route('laporan.create') }}" class="inline-flex items-center gap-2 bg-white text-brand-900 font-bold px-6 py-3 rounded-xl text-sm hover:bg-brand-50 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">edit_document</span> Buat Laporan Sekarang
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-100 py-6 text-center text-xs text-slate-400">
        © 2026 LaporanKita. <a href="{{ route('home') }}" class="hover:text-brand-600">Beranda</a> ·
        <a href="{{ route('public.faq') }}" class="hover:text-brand-600">FAQ / Bantuan</a>
    </footer>
</body>
</html>
