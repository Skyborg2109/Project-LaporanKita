<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Dashboard - LaporanKita</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300..600,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            500: '#14b8a6', // Teal
                            600: '#0d9488',
                            800: '#115e59',
                            900: '#0f172a', // Slate 900
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .icon-filled { font-variation-settings: 'FILL' 1; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .skeleton-pulse { animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .5; } }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex h-screen overflow-hidden selection:bg-brand-500 selection:text-white relative">

    <!-- ==================== SIDEBAR (DESKTOP) ==================== -->
    <aside class="hidden md:flex flex-col w-64 bg-white border-r border-slate-200 h-full z-20 shrink-0">
        <div class="h-16 flex items-center px-6 border-b border-slate-100">
            <div class="flex items-center gap-2.5">
                <div class="bg-brand-900 text-white p-1.5 rounded flex items-center justify-center">
                    <span class="material-symbols-outlined icon-filled text-[18px]">maps_ugc</span>
                </div>
                <span class="text-lg font-bold tracking-tight text-brand-900">Laporan<span class="text-brand-600">Kita</span></span>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5">
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 mb-2">Menu Utama</div>
            
            <a href="{{ route('dashboarduser.index') }}" class="flex items-center gap-3 px-3 py-2.5 bg-brand-50 text-brand-900 rounded-lg font-semibold text-sm transition-colors">
                <span class="material-symbols-outlined icon-filled text-[20px] text-brand-600">dashboard</span>
                Dashboard
            </a>
            
            <a href="{{ route('laporan.create') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-brand-900 rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-600 transition-colors">add_box</span>
                Buat Laporan
            </a>
            
            <a href="{{ route('dashboarduser.laporan') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-brand-900 rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-600 transition-colors">assignment</span>
                Laporan Saya
            </a>

            <a href="{{ route('dashboarduser.notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-brand-900 rounded-lg font-medium text-sm transition-colors group relative">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-600 transition-colors">notifications</span>
                Notifikasi
                @if(isset($unreadCount) && $unreadCount > 0)
                <span class="ml-auto bg-rose-500 text-white text-[10px] font-bold rounded-full px-1.5 py-0.5 min-w-[20px] text-center">{{ $unreadCount }}</span>
                @endif
            </a>

            <a href="{{ route('dashboarduser.profil') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-brand-900 rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-600 transition-colors">manage_accounts</span>
                Profil Saya
            </a>
        </div>

        <div class="p-4 border-t border-slate-100">
            <div class="flex items-center gap-3 px-3 py-2 mb-2">
                @if(auth()->user()->foto_profil)
                    <img src="{{ str_starts_with(auth()->user()->foto_profil, 'http') ? auth()->user()->foto_profil : Storage::url(auth()->user()->foto_profil) }}" alt="Avatar" class="w-9 h-9 rounded-full border border-slate-200 object-cover" />
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=f1f5f9&color=0f172a" alt="Avatar" class="w-9 h-9 rounded-full border border-slate-200" />
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-slate-500 truncate">{{ auth()->user()->is_verified ? 'Warga Terverifikasi' : 'Belum Terverifikasi' }}</p>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-rose-600 hover:bg-rose-50 rounded-lg font-medium text-sm transition-colors text-left">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT AREA ==================== -->
    <main class="flex-1 flex flex-col h-full w-full overflow-hidden relative pb-[72px] md:pb-0">
        
        <!-- Mobile Header -->
        <header class="md:hidden bg-white/90 backdrop-blur-md h-16 border-b border-slate-200 flex items-center justify-between px-4 sticky top-0 z-20">
            <div class="flex items-center gap-2">
                <div class="bg-brand-900 text-white p-1 rounded flex items-center justify-center">
                    <span class="material-symbols-outlined icon-filled text-[16px]">maps_ugc</span>
                </div>
                <span class="text-lg font-bold tracking-tight text-brand-900">Dashboard</span>
            </div>
            <a href="{{ route('dashboarduser.notifikasi') }}" class="relative p-2 text-slate-500 hover:bg-slate-50 rounded-full transition-colors">
                <span class="material-symbols-outlined text-[22px]">notifications</span>
                @if(isset($unreadCount) && $unreadCount > 0)
                <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                @endif
            </a>
        </header>

        <!-- Desktop Topbar -->
        <header class="hidden md:flex h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 items-center justify-between px-8 sticky top-0 z-10">
            <div class="relative w-96">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                <input type="text" placeholder="Cari laporan Anda..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
            </div>
            <div class="flex items-center gap-3">
                <!-- Desktop Notification Dropdown -->
                <div class="relative" x-data="{ open: false }" id="notif-wrapper">
                    <button onclick="toggleNotifDropdown()" class="p-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined">notifications</span>
                        @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full border-2 border-white" id="notif-dot"></span>
                        @endif
                    </button>
                    <!-- Dropdown -->
                    <div id="notif-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-100 z-50 overflow-hidden">
                        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="font-bold text-sm text-slate-900">Notifikasi</h3>
                            @if(isset($unreadCount) && $unreadCount > 0)
                            <a href="{{ route('dashboarduser.notifikasi') }}" class="text-[11px] text-brand-600 hover:underline font-semibold">Tandai semua dibaca</a>
                            @endif
                        </div>
                        <div class="max-h-64 overflow-y-auto divide-y divide-slate-50">
                            @if(isset($unreadNotifications) && $unreadNotifications->count() > 0)
                                @foreach($unreadNotifications->take(5) as $notif)
                                <a href="{{ route('laporan.show', $notif->data['laporan_id']) }}" class="flex items-start gap-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                                    <div class="w-8 h-8 rounded-full bg-brand-100 flex items-center justify-center shrink-0 mt-0.5">
                                        <span class="material-symbols-outlined icon-filled text-[16px] text-brand-600">notifications_active</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-semibold text-slate-900 leading-tight">{{ Str::limit($notif->data['pesan'], 60) }}</p>
                                        <p class="text-[10px] text-slate-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                    </div>
                                    <span class="w-2 h-2 bg-brand-500 rounded-full mt-2 shrink-0"></span>
                                </a>
                                @endforeach
                            @else
                            <div class="px-4 py-8 text-center">
                                <span class="material-symbols-outlined text-slate-300 text-[40px]">notifications_none</span>
                                <p class="text-xs text-slate-400 mt-2">Belum ada notifikasi</p>
                            </div>
                            @endif
                        </div>
                        <div class="px-4 py-2 border-t border-slate-100">
                            <a href="{{ route('dashboarduser.notifikasi') }}" class="text-xs text-brand-600 hover:underline font-semibold">Lihat semua notifikasi &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 no-scrollbar relative w-full">
            
            <!-- Skeleton Loader Wrapper -->
            <div id="skeleton-loader" class="absolute inset-0 p-4 sm:p-6 lg:p-8 bg-[#FAFAFA] z-20 max-w-7xl mx-auto">
                <div class="mb-8">
                    <div class="w-64 h-8 bg-slate-200 rounded-lg skeleton-pulse mb-2"></div>
                    <div class="w-96 h-4 bg-slate-200 rounded skeleton-pulse"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6 mb-8 w-full">
                    <div class="bg-white rounded-2xl border border-slate-200 h-[140px] skeleton-pulse"></div>
                    <div class="bg-white rounded-2xl border border-slate-200 h-[140px] skeleton-pulse"></div>
                    <div class="bg-white rounded-2xl border border-slate-200 h-[140px] skeleton-pulse"></div>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl h-[300px] skeleton-pulse w-full"></div>
            </div>

            <div id="main-content" class="max-w-7xl mx-auto opacity-0 transition-opacity duration-500 w-full">
                
                <!-- Greeting Section -->
                <div class="mb-8 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-brand-900 tracking-tight mb-1">Halo, {{ auth()->user()->name }} 👋</h1>
                        <p class="text-sm text-slate-500 font-medium">Ini adalah ringkasan aktivitas partisipasi publik Anda.</p>
                    </div>
                </div>
                
                @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-2">
                    <span class="material-symbols-outlined">check_circle</span>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
                @endif

                <!-- Card Summary (Grid Diperbaiki: grid-cols-1 md:grid-cols-3) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-6 mb-8 w-full">
                    
                    <!-- Card 1: Total Laporan -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden flex flex-col justify-between min-h-[140px]">
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-slate-50 rounded-full opacity-50 z-0"></div>
                        <div class="relative z-10 mb-2">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
                                <span class="material-symbols-outlined icon-filled text-[20px]">folder_open</span>
                            </div>
                        </div>
                        <div class="relative z-10 mt-auto">
                            <h3 class="text-3xl font-extrabold text-brand-900 leading-none mb-1">{{ $totalLaporan }}</h3>
                            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider m-0">Total Laporan</p>
                        </div>
                    </div>

                    <!-- Card 2: Diproses -->
                    <div class="bg-white p-6 rounded-2xl border border-amber-100 shadow-sm relative overflow-hidden flex flex-col justify-between min-h-[140px]">
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-amber-50 rounded-full opacity-50 z-0"></div>
                        <div class="relative z-10 mb-2">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                                <span class="material-symbols-outlined icon-filled text-[20px]">sync</span>
                            </div>
                        </div>
                        <div class="relative z-10 mt-auto">
                            <h3 class="text-3xl font-extrabold text-amber-700 leading-none mb-1">{{ $laporanDiproses }}</h3>
                            <p class="text-[11px] font-bold text-amber-600 uppercase tracking-wider m-0">Sedang Diproses</p>
                        </div>
                    </div>

                    <!-- Card 3: Selesai -->
                    <div class="bg-white p-6 rounded-2xl border border-emerald-100 shadow-sm relative overflow-hidden flex flex-col justify-between min-h-[140px]">
                        <div class="absolute -right-6 -top-6 w-32 h-32 bg-emerald-50 rounded-full opacity-50 z-0"></div>
                        <div class="relative z-10 mb-2">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                <span class="material-symbols-outlined icon-filled text-[20px]">task_alt</span>
                            </div>
                        </div>
                        <div class="relative z-10 mt-auto">
                            <h3 class="text-3xl font-extrabold text-emerald-700 leading-none mb-1">{{ $laporanSelesai }}</h3>
                            <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider m-0">Telah Selesai</p>
                        </div>
                    </div>
                </div>

                <!-- List Laporan Terkini -->
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden w-full">
                    <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h2 class="font-bold text-brand-900 text-base">Aktivitas Laporan Terkini</h2>
                        <a href="{{ route('dashboarduser.laporan') }}" class="text-xs font-semibold text-brand-600 hover:text-brand-800 transition-colors flex items-center gap-1">
                            Lihat Semua <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[600px]">
                            <thead>
                                <tr class="bg-white border-b border-slate-100">
                                    <th class="px-5 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider w-1/2">Judul Laporan</th>
                                    <th class="px-5 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-5 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status</th>
                                    <th class="px-5 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($laporans as $laporan)
                                <tr class="hover:bg-slate-50 transition-colors cursor-pointer" onclick="window.location.href='{{ route('laporan.show', $laporan->id) }}'">
                                    <td class="px-5 py-4">
                                        <p class="font-semibold text-brand-900 text-sm mb-0.5">{{ $laporan->judul }}</p>
                                        <span class="text-[11px] text-slate-500 font-medium">#LPK-{{ $laporan->id }} • Kategori: {{ ucfirst($laporan->kategori) }}</span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <p class="text-sm text-slate-700 font-medium">{{ $laporan->created_at->format('d M Y') }}</p>
                                        <p class="text-[11px] text-slate-400">{{ $laporan->created_at->format('H:i') }} WITA</p>
                                    </td>
                                    <td class="px-5 py-4">
                                        @if($laporan->status === 'baru')
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-rose-50 border border-rose-100 text-rose-700">
                                            <span class="relative flex h-2 w-2">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                                            </span>
                                            <span class="text-[11px] font-bold uppercase tracking-wider">Baru</span>
                                        </div>
                                        @elseif($laporan->status === 'diproses')
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-50 border border-amber-100 text-amber-700">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                            <span class="text-[11px] font-bold uppercase tracking-wider">Diproses</span>
                                        </div>
                                        @else
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-50 border border-emerald-100 text-emerald-700">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                            <span class="text-[11px] font-bold uppercase tracking-wider">Selesai</span>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <span class="material-symbols-outlined text-slate-400 text-[20px]">chevron_right</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-5 py-8 text-center text-slate-500 text-sm">
                                        Belum ada aktivitas laporan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="h-6 md:hidden"></div>

            </div>
        </div>
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-xl border-t border-slate-200 z-50 px-2 sm:px-6 py-1.5 flex justify-around items-center pb-[calc(0.5rem+env(safe-area-inset-bottom))] shadow-[0_-4px_20px_-5px_rgba(0,0,0,0.05)]">
        <a href="{{ route('dashboarduser.index') }}" class="flex flex-col items-center text-brand-900 transition-colors w-16 pt-2">
            <span class="material-symbols-outlined icon-filled text-[24px]">dashboard</span>
            <span class="text-[10px] font-bold mt-1 tracking-wide">Beranda</span>
        </a>
        <a href="{{ route('dashboarduser.laporan') }}" class="flex flex-col items-center text-slate-400 hover:text-brand-900 transition-colors w-16 pt-2">
            <span class="material-symbols-outlined text-[24px]">assignment</span>
            <span class="text-[10px] font-medium mt-1 tracking-wide">Riwayat</span>
        </a>
        <div class="relative -top-5 shrink-0 px-2">
            <a href="{{ route('laporan.create') }}" class="bg-brand-900 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_20px_-6px_rgba(15,23,42,0.6)] border-[4px] border-[#FAFAFA]">
                <span class="material-symbols-outlined icon-filled text-[28px]">add</span>
            </a>
        </div>
        <a href="{{ route('dashboarduser.profil') }}" class="flex flex-col items-center text-slate-400 hover:text-brand-900 transition-colors w-16 pt-2 relative">
            <span class="material-symbols-outlined text-[24px]">person</span>
            <span class="text-[10px] font-medium mt-1 tracking-wide">Profil</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="inline w-16 pt-2" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">
            @csrf
            <button type="submit" class="flex flex-col items-center w-full text-slate-400 hover:text-rose-600 transition-colors">
                <span class="material-symbols-outlined text-[24px]">logout</span>
                <span class="text-[10px] font-medium mt-1 tracking-wide">Keluar</span>
            </button>
        </form>
    </nav>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            setTimeout(() => {
                const skeleton = document.getElementById('skeleton-loader');
                const mainContent = document.getElementById('main-content');
                if(skeleton && mainContent) {
                    skeleton.classList.add('hidden');
                    mainContent.classList.remove('opacity-0');
                    mainContent.classList.add('opacity-100');
                }
            }, 800);
        });

        function toggleNotifDropdown() {
            const dropdown = document.getElementById('notif-dropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const wrapper = document.getElementById('notif-wrapper');
            const dropdown = document.getElementById('notif-dropdown');
            if (wrapper && dropdown && !wrapper.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>