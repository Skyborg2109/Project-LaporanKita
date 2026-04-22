<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Semua Laporan - LaporanKita</title>
    <meta name="description" content="Lihat semua laporan warga yang masuk ke platform LaporanKita secara transparan dan real-time."/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300..600,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: {
                            50: '#f0fdfa', 100: '#ccfbf1',
                            500: '#14b8a6', 600: '#0d9488',
                            800: '#115e59', 900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; }
        .icon-filled { font-variation-settings: 'FILL' 1; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex flex-col min-h-screen">

    {{-- Navbar --}}
    <header class="bg-white/80 backdrop-blur-lg border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="bg-brand-900 text-white p-1.5 rounded flex items-center justify-center">
                        <span class="material-symbols-outlined icon-filled text-lg">maps_ugc</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-brand-900">Laporan<span class="text-brand-600">Kita</span></span>
                </a>
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-slate-500 hover:text-brand-900 transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali
                    </a>
                    @auth
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboarduser.index') }}" class="flex items-center gap-1.5 bg-brand-900 hover:bg-slate-800 text-white px-4 py-2 rounded-md text-sm font-semibold transition-all">
                            <span class="material-symbols-outlined text-[16px]">dashboard</span> Dashboard
                        </a>
                    @else
                        <a href="/login" class="flex items-center gap-1.5 bg-brand-900 hover:bg-slate-800 text-white px-4 py-2 rounded-md text-sm font-semibold transition-all">
                            <span class="material-symbols-outlined text-[16px]">login</span> Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        {{-- Header Section --}}
        <div class="bg-brand-900 text-white py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center gap-2 text-brand-100 text-sm mb-3">
                    <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span>Semua Laporan</span>
                </div>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-2">Feed Laporan Publik</h1>
                <p class="text-brand-100 text-sm max-w-xl">Pantau semua laporan warga secara transparan dan real-time. Data diperbarui setiap saat.</p>

                {{-- Stats --}}
                <div class="flex flex-wrap gap-6 mt-6">
                    <div>
                        <div class="text-2xl font-bold">{{ number_format($totalLaporan, 0, ',', '.') }}</div>
                        <div class="text-[11px] text-brand-100 uppercase tracking-wider font-medium">Total Laporan</div>
                    </div>
                    <div class="border-l border-slate-700 pl-6">
                        <div class="text-2xl font-bold text-amber-400">{{ number_format($totalDiproses, 0, ',', '.') }}</div>
                        <div class="text-[11px] text-brand-100 uppercase tracking-wider font-medium">Diproses</div>
                    </div>
                    <div class="border-l border-slate-700 pl-6">
                        <div class="text-2xl font-bold text-emerald-400">{{ number_format($totalSelesai, 0, ',', '.') }}</div>
                        <div class="text-[11px] text-brand-100 uppercase tracking-wider font-medium">Selesai</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter & Search Bar --}}
        <div class="bg-white border-b border-slate-200 py-4 px-4 sm:px-6 lg:px-8 shadow-sm">
            <div class="max-w-7xl mx-auto">
                <form method="GET" action="{{ route('public.semualaporan') }}" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-grow">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari laporan berdasarkan judul, deskripsi, atau lokasi…"
                            class="w-full pl-10 pr-4 py-2.5 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent bg-slate-50 hover:bg-white transition-colors"/>
                    </div>
                    <select name="status" class="px-4 py-2.5 border border-slate-200 rounded-lg text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-brand-500 bg-slate-50 hover:bg-white transition-colors">
                        <option value="">Semua Status</option>
                        <option value="baru" {{ request('status') === 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit" class="px-5 py-2.5 bg-brand-900 text-white rounded-lg text-sm font-semibold hover:bg-slate-800 transition-colors flex items-center gap-2 justify-center">
                        <span class="material-symbols-outlined text-[16px]">filter_list</span> Filter
                    </button>
                    @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('public.semualaporan') }}" class="px-4 py-2.5 border border-slate-200 text-slate-600 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors flex items-center gap-1 justify-center">
                        <span class="material-symbols-outlined text-[16px]">close</span> Reset
                    </a>
                    @endif
                </form>
            </div>
        </div>

        {{-- Laporan Grid --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            @if($laporans->isEmpty())
                <div class="text-center py-24 flex flex-col items-center gap-4">
                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center">
                        <span class="material-symbols-outlined text-slate-400 text-[32px]">search_off</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-700">Tidak ada laporan ditemukan</h3>
                    <p class="text-sm text-slate-500">Coba ubah kriteria pencarian atau reset filter Anda.</p>
                    <a href="{{ route('public.semualaporan') }}" class="mt-2 text-brand-600 text-sm font-semibold hover:underline">Tampilkan semua laporan</a>
                </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($laporans as $laporan)
                <div class="bg-white border border-slate-200 rounded-xl overflow-hidden hover:shadow-lg hover:border-slate-300 transition-all duration-300 flex flex-col">
                    {{-- Header Card --}}
                    <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <div class="flex items-center gap-2">
                            @if($laporan->status === 'baru')
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                                </span>
                                <span class="text-[11px] font-bold text-rose-600 uppercase tracking-wider">Baru</span>
                            @elseif($laporan->status === 'diproses')
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                </span>
                                <span class="text-[11px] font-bold text-amber-700 uppercase tracking-wider">Diproses</span>
                            @else
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Selesai</span>
                            @endif
                        </div>
                        <span class="text-[11px] font-medium text-slate-400">#LPK-{{ $laporan->id }}</span>
                    </div>

                    {{-- Foto --}}
                    @if($laporan->foto && count($laporan->foto) > 0)
                    <div class="aspect-video overflow-hidden bg-slate-100">
                        <img src="{{ str_starts_with($laporan->foto[0], 'http') ? $laporan->foto[0] : Storage::url($laporan->foto[0]) }}" alt="{{ $laporan->judul }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"/>
                    </div>
                    @endif

                    {{-- Konten --}}
                    <div class="p-5 flex-grow">
                        @if($laporan->kategori)
                        <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-brand-600 bg-brand-50 px-2 py-0.5 rounded mb-2">{{ $laporan->kategori }}</span>
                        @endif
                        <h3 class="font-bold text-brand-900 text-base mb-2 leading-tight line-clamp-2 hover:text-brand-600 transition-colors">
                            <a href="{{ route('laporan.show', $laporan->id) }}">{{ $laporan->judul }}</a>
                        </h3>
                        <p class="text-slate-500 text-sm mb-4 line-clamp-3 leading-relaxed">{{ $laporan->deskripsi }}</p>
                        
                        <a href="{{ route('laporan.show', $laporan->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-brand-600 hover:text-brand-800 transition-all group">
                            Lihat Detail Laporan 
                            <span class="material-symbols-outlined text-[14px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>

                    {{-- Footer Card --}}
                    <div class="px-5 py-3 border-t border-slate-100 bg-white flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2 min-w-0">
                            <div class="w-6 h-6 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-[12px]">person</span>
                            </div>
                            <span class="text-xs font-medium text-slate-600 truncate">{{ $laporan->user ? $laporan->user->name : 'Anonim' }}</span>
                        </div>
                        @if($laporan->lokasi)
                        <div class="flex items-center gap-1 text-xs text-slate-400 shrink-0">
                            <span class="material-symbols-outlined text-[12px]">location_on</span>
                            <span class="truncate max-w-[100px]">{{ $laporan->lokasi }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-10 flex justify-center">
                {{ $laporans->links('pagination::tailwind') }}
            </div>
            @endif
        </div>
    </main>

    {{-- Footer mini --}}
    <footer class="bg-white border-t border-slate-100 py-6 text-center text-xs text-slate-400">
        <p>© 2026 LaporanKita. <a href="{{ route('home') }}" class="hover:text-brand-600 transition-colors">Kembali ke Beranda</a></p>
    </footer>
</body>
</html>
