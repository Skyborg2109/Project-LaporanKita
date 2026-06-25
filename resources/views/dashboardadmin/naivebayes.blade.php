<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Naive Bayes Klasifikasi - LaporanKita Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300..600,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: { 50:'#f0fdfa',100:'#ccfbf1',400:'#2dd4bf',500:'#14b8a6',600:'#0d9488',800:'#115e59',900:'#0f172a' }
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .icon-filled { font-variation-settings: 'FILL' 1; }
        .custom-scrollbar::-webkit-scrollbar { height:6px; width:6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background:transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background:#cbd5e1; border-radius:4px; }
        .sidebar-transition { transition: transform 0.3s ease-in-out; }
        .bar-fill { transition: width 1s ease-in-out; }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex h-screen overflow-hidden">

    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 z-30 hidden md:hidden backdrop-blur-sm transition-opacity opacity-0" onclick="toggleSidebar()"></div>

    <!-- SIDEBAR -->
    <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-brand-900 text-white flex flex-col h-full z-40 sidebar-transition -translate-x-full md:translate-x-0 shrink-0 shadow-2xl md:shadow-none">
        <div class="h-16 flex items-center px-6 border-b border-slate-700/50 shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="bg-brand-500 text-white p-1.5 rounded"><span class="material-symbols-outlined icon-filled text-[18px]">maps_ugc</span></div>
                <span class="text-lg font-bold tracking-tight">Laporan<span class="text-brand-400">Kita</span></span>
                <span class="ml-2 px-1.5 py-0.5 rounded text-[9px] font-bold bg-rose-500 text-white uppercase tracking-wider">Admin</span>
            </div>
            <button class="md:hidden ml-auto p-1 text-slate-400 hover:text-white rounded" onclick="toggleSidebar()">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5">
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 mb-3">Menu Manajemen</div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400">dashboard</span> Dashboard
            </a>
            <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400">list_alt</span> Semua Laporan
            </a>
            <a href="{{ route('admin.filter') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400">filter_alt</span> Filter Laporan
            </a>
            <a href="{{ route('admin.kategori.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400 transition-colors">category</span> Manajemen Kategori
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400">group</span> Manajemen User
            </a>
            <a href="{{ route('admin.naivebayes') }}" class="flex items-center gap-3 px-3 py-2.5 bg-brand-800 text-white rounded-lg font-semibold text-sm border border-brand-700 shadow-inner">
                <span class="material-symbols-outlined icon-filled text-[20px] text-brand-400">model_training</span> Naive Bayes
            </a>
        </div>
        <div class="p-4 border-t border-slate-700/50 bg-slate-900/30">
            <div class="flex items-center gap-3 px-3 py-2 mb-2">
                <div class="w-9 h-9 rounded-full bg-slate-700 flex items-center justify-center border border-slate-600">
                    <span class="material-symbols-outlined text-white text-[18px]">admin_panel_settings</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-slate-400 truncate">Administrator</p>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            <a href="#" onclick="if(confirm('Keluar?')){document.getElementById('logout-form').submit()}" class="flex items-center gap-3 px-3 py-2.5 text-rose-400 hover:bg-rose-500/10 rounded-lg font-medium text-sm transition-colors">
                <span class="material-symbols-outlined text-[20px]">logout</span> Keluar
            </a>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 flex flex-col h-full w-full overflow-hidden">
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-8 shrink-0 shadow-sm z-30">
            <div class="flex items-center gap-3">
                <button class="md:hidden p-2 text-slate-500 hover:bg-slate-50 rounded-md" onclick="toggleSidebar()">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <span class="material-symbols-outlined text-brand-500 text-[24px]">model_training</span>
                <h2 class="font-bold text-brand-900 text-lg">Klasifikasi Naive Bayes</h2>
            </div>
            <a href="{{ route('admin.naivebayes.evaluasi') }}" class="hidden sm:flex items-center gap-2 px-4 py-2 bg-brand-500 text-white rounded-lg text-sm font-semibold hover:bg-brand-600 transition-colors">
                <span class="material-symbols-outlined text-[18px]">assessment</span> Evaluasi Akurasi
            </a>
        </header>

        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 custom-scrollbar">

            @if(session('success'))
            <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-3 text-emerald-800 text-sm">
                <span class="material-symbols-outlined text-emerald-500">check_circle</span> {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="mb-5 p-4 bg-rose-50 border border-rose-200 rounded-xl flex items-center gap-3 text-rose-800 text-sm">
                <span class="material-symbols-outlined text-rose-500">error</span> {{ session('error') }}
            </div>
            @endif

            <div class="max-w-7xl mx-auto space-y-6">

                <!-- STATISTIK MODEL -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Status Model</p>
                        @if($modelStats['terlatih'])
                            <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></span><span class="font-bold text-emerald-700 text-sm">Aktif</span></div>
                        @else
                            <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 bg-slate-300 rounded-full"></span><span class="font-bold text-slate-500 text-sm">Belum Dilatih</span></div>
                        @endif
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Total Dokumen Training</p>
                        <p class="text-2xl font-extrabold text-brand-900">{{ $modelStats['total_dokumen'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Jumlah Kelas</p>
                        <p class="text-2xl font-extrabold text-brand-900">{{ $modelStats['total_kelas'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Kata Unik (Vocabulary)</p>
                        <p class="text-2xl font-extrabold text-brand-900">{{ number_format($modelStats['total_kata_unik'] ?? 0) }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- TRAINING PANEL -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="p-5 border-b border-slate-100 bg-brand-900 text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">model_training</span>
                            <h3 class="font-bold text-sm">Training Model</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 text-sm text-slate-600 leading-relaxed">
                                <p class="font-semibold text-slate-800 mb-1">📚 Cara Kerja Training</p>
                                <p>Sistem akan membaca semua laporan yang sudah memiliki kategori, kemudian menghitung probabilitas kemunculan kata per kategori menggunakan <strong>Naive Bayes dengan Laplace Smoothing</strong>.</p>
                            </div>

                            <div class="space-y-2">
                                <p class="text-xs font-bold text-slate-700 uppercase tracking-wider">Distribusi Data Training</p>
                                @foreach($distribusiKategori as $dist)
                                <div class="flex items-center gap-3">
                                    <span class="w-24 text-xs font-medium text-slate-600 truncate capitalize">{{ $dist->kategori }}</span>
                                    <div class="flex-1 h-2 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-brand-500 rounded-full bar-fill" style="width: 0%" data-target="{{ $distribusiKategori->max('total') > 0 ? round($dist->total / $distribusiKategori->max('total') * 100) : 0 }}%"></div>
                                    </div>
                                    <span class="w-8 text-xs font-bold text-brand-700 text-right">{{ $dist->total }}</span>
                                </div>
                                @endforeach
                                @if($distribusiKategori->isEmpty())
                                <p class="text-sm text-slate-400 italic">Belum ada data laporan berkategori.</p>
                                @endif
                            </div>

                            <div class="flex gap-3 pt-2">
                                <form action="{{ route('admin.naivebayes.train') }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Mulai training model? Data model lama akan ditimpa.')"
                                        class="w-full bg-brand-900 text-white py-3 rounded-xl text-sm font-semibold hover:bg-slate-800 transition-all flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-[18px]">play_arrow</span> Mulai Training
                                    </button>
                                </form>
                                @if($modelStats['terlatih'])
                                <form action="{{ route('admin.naivebayes.reset') }}" method="POST">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Reset model? Data training akan dihapus.')"
                                        class="px-4 py-3 border border-rose-200 text-rose-500 rounded-xl text-sm font-semibold hover:bg-rose-50 transition-all flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                                @endif
                            </div>

                            @if($modelStats['terlatih'])
                            <p class="text-[11px] text-slate-400 text-center">Terakhir dilatih: {{ $modelStats['last_trained'] }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- PANEL KLASIFIKASI MANUAL -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="p-5 border-b border-slate-100 bg-slate-800 text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">psychology</span>
                            <h3 class="font-bold text-sm">Uji Klasifikasi Manual</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <p class="text-xs text-slate-500">Masukkan teks laporan untuk melihat prediksi kategori dari model Naive Bayes.</p>

                            <form id="form-klasifikasi" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Teks Laporan</label>
                                    <textarea id="teks-input" rows="5" placeholder="Contoh: Jalan di depan kantor kecamatan rusak parah, banyak lubang besar yang membahayakan pengendara..."
                                        class="w-full p-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 resize-none">{{ session('teks_input') }}</textarea>
                                </div>

                                <button type="button" onclick="jalankanKlasifikasi()"
                                    class="w-full bg-slate-800 text-white py-3 rounded-xl text-sm font-semibold hover:bg-brand-900 transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">search</span> Klasifikasikan
                                </button>
                            </form>

                            <!-- Hasil Klasifikasi -->
                            <div id="hasil-box" class="hidden">
                                <div class="p-4 bg-brand-50 border border-brand-100 rounded-xl">
                                    <p class="text-[10px] font-bold text-brand-600 uppercase tracking-wider mb-2">Hasil Prediksi</p>
                                    <div class="flex items-center justify-between mb-3">
                                        <div>
                                            <span id="hasil-kategori" class="text-lg font-extrabold text-brand-900 capitalize"></span>
                                            <p class="text-xs text-slate-500 mt-0.5">Kategori yang diprediksi</p>
                                        </div>
                                        <div class="text-right">
                                            <span id="hasil-prob" class="text-2xl font-extrabold text-brand-600"></span>
                                            <p class="text-xs text-slate-500">Probabilitas</p>
                                        </div>
                                    </div>
                                    <div id="semua-prob" class="space-y-1.5 pt-3 border-t border-brand-100"></div>
                                </div>
                            </div>

                            @if(session('hasil_klasifikasi') && session('hasil_klasifikasi')['kategori'])
                            <div class="p-4 bg-brand-50 border border-brand-100 rounded-xl">
                                <p class="text-[10px] font-bold text-brand-600 uppercase tracking-wider mb-2">Hasil Prediksi</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-extrabold text-brand-900 capitalize">{{ session('hasil_klasifikasi')['kategori'] }}</span>
                                    <span class="text-xl font-extrabold text-brand-600">{{ session('hasil_klasifikasi')['probabilitas'] }}%</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- DISTRIBUSI KELAS MODEL -->
                @if($modelStats['terlatih'])
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-brand-500 text-[20px]">bar_chart</span>
                            <h3 class="font-bold text-sm text-brand-900">Detail Kelas Model Terlatih</h3>
                        </div>
                        <a href="{{ route('admin.naivebayes.evaluasi') }}" class="text-xs text-brand-600 font-semibold hover:underline flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">assessment</span> Lihat Evaluasi Penuh
                        </a>
                    </div>
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Dok. Training</th>
                                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Kata</th>
                                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Prior P(C)</th>
                                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Diperbarui</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($modelStats['kelas'] as $kelas)
                                @php $prior = $modelStats['total_dokumen'] > 0 ? round($kelas['jumlah_dokumen'] / $modelStats['total_dokumen'] * 100, 1) : 0; @endphp
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-brand-50 border border-brand-100 text-brand-700 text-xs font-bold capitalize">
                                            {{ $kelas['kategori'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-slate-700">{{ $kelas['jumlah_dokumen'] }}</td>
                                    <td class="px-6 py-4 text-sm text-slate-600">{{ number_format($kelas['total_kata']) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-20 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-brand-500 rounded-full" style="width: {{ $prior }}%"></div>
                                            </div>
                                            <span class="text-xs font-bold text-brand-700">{{ $prior }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-slate-400">{{ $kelas['updated_at'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => { overlay.classList.remove('opacity-0'); overlay.classList.add('opacity-100'); }, 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0');
                setTimeout(() => { overlay.classList.add('hidden'); }, 300);
            }
        }

        // Animasi bar distribusi
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.querySelectorAll('.bar-fill').forEach(el => {
                    el.style.width = el.dataset.target;
                });
            }, 300);
        });

        // Klasifikasi via AJAX
        async function jalankanKlasifikasi() {
            const teks = document.getElementById('teks-input').value.trim();
            if (!teks) { alert('Masukkan teks laporan terlebih dahulu.'); return; }

            const btn = event.target.closest('button');
            btn.disabled = true;
            btn.innerHTML = '<span class="material-symbols-outlined text-[18px] animate-spin">refresh</span> Memproses...';

            try {
                const res = await fetch('{{ route("admin.naivebayes.klasifikasi") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                    body: JSON.stringify({ teks })
                });
                const data = await res.json();

                if (data.kategori) {
                    document.getElementById('hasil-kategori').textContent = data.kategori;
                    document.getElementById('hasil-prob').textContent = data.probabilitas + '%';

                    const semua = document.getElementById('semua-prob');
                    semua.innerHTML = '';
                    if (data.probabilitas_semua) {
                        const sorted = Object.entries(data.probabilitas_semua).sort((a,b) => b[1]-a[1]);
                        sorted.forEach(([kat, prob]) => {
                            semua.innerHTML += `
                                <div class="flex items-center gap-2">
                                    <span class="w-24 text-xs font-medium text-slate-600 capitalize truncate">${kat}</span>
                                    <div class="flex-1 h-1.5 bg-brand-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-brand-500 rounded-full" style="width:${prob}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-brand-700 w-12 text-right">${prob}%</span>
                                </div>`;
                        });
                    }
                    document.getElementById('hasil-box').classList.remove('hidden');
                } else {
                    alert(data.pesan || 'Prediksi gagal. Pastikan model sudah dilatih.');
                }
            } catch(e) {
                alert('Terjadi kesalahan. Pastikan model sudah dilatih.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">search</span> Klasifikasikan';
            }
        }
    </script>
</body>
</html>
