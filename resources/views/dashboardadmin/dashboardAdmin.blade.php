<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Dashboard Admin - LaporanKita</title>
    
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
    
    <!-- Chart.js for realistic charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .icon-filled {
            font-variation-settings: 'FILL' 1;
        }
        /* Custom scrollbar for tables */
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f8fafc; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Sidebar transition */
        .sidebar-transition { transition: transform 0.3s ease-in-out; }

        /* Skeleton Pulse */
        .skeleton-pulse { animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex h-screen overflow-hidden selection:bg-brand-500 selection:text-white">

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 z-30 hidden md:hidden backdrop-blur-sm transition-opacity opacity-0" onclick="toggleSidebar()"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-brand-900 text-white flex flex-col h-full z-40 sidebar-transition -translate-x-full md:translate-x-0 shrink-0 shadow-2xl md:shadow-none">
        <!-- Logo -->
        <div class="h-16 flex items-center px-6 border-b border-slate-700/50 shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="bg-brand-500 text-white p-1.5 rounded flex items-center justify-center">
                    <span class="material-symbols-outlined icon-filled text-[18px]">maps_ugc</span>
                </div>
                <span class="text-lg font-bold tracking-tight text-white">Laporan<span class="text-brand-400">Kita</span></span>
                <span class="ml-2 px-1.5 py-0.5 rounded text-[9px] font-bold bg-rose-500 text-white uppercase tracking-wider">Admin</span>
            </div>
            <!-- Mobile Close Button -->
            <button class="md:hidden ml-auto p-1 text-slate-400 hover:text-white rounded" onclick="toggleSidebar()">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <!-- Nav Links -->
        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5">
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 mb-3">Menu Manajemen</div>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 bg-brand-800 text-white rounded-lg font-semibold text-sm transition-colors border border-brand-700 shadow-inner">
                <span class="material-symbols-outlined icon-filled text-[20px] text-brand-400">dashboard</span>
                Dashboard
            </a>
            
            <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400 transition-colors">list_alt</span>
                Semua Laporan
            </a>
            
            <a href="{{ route('admin.filter') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400 transition-colors">filter_alt</span>
                Filter Laporan
            </a>
        </div>

        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-slate-700/50 bg-slate-900/30">
            <div class="flex items-center gap-3 px-3 py-2 mb-2">
                @if(Auth::user()->foto_profil)
                    <img src="{{ str_starts_with(Auth::user()->foto_profil, 'http') ? Auth::user()->foto_profil : Storage::url(Auth::user()->foto_profil) }}" class="w-9 h-9 rounded-full border border-slate-600 object-cover" />
                @else
                    <div class="w-9 h-9 rounded-full bg-slate-700 flex items-center justify-center border border-slate-600">
                        <span class="material-symbols-outlined text-white text-[18px]">admin_panel_settings</span>
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-slate-400 truncate">Administrator</p>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            <a href="#" onclick="if(confirm('Apakah Anda yakin ingin keluar sebagai Admin?')) { event.preventDefault(); document.getElementById('logout-form').submit(); }" class="flex items-center gap-3 px-3 py-2.5 text-rose-400 hover:bg-rose-500/10 hover:text-rose-300 rounded-lg font-medium text-sm transition-colors">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                Keluar
            </a>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT AREA ==================== -->
    <main class="flex-1 flex flex-col h-full w-full overflow-hidden relative">
        
        <!-- Topbar Header -->
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-8 shrink-0 shadow-sm z-30">
            <!-- Mobile Menu Toggle -->
            <button class="md:hidden p-2 -ml-2 text-slate-500 hover:bg-slate-50 rounded-md" onclick="toggleSidebar()">
                <span class="material-symbols-outlined">menu</span>
            </button>
            
            <h2 class="font-bold text-brand-900 text-lg hidden sm:block">Ringkasan Sistem</h2>
            
            <div class="flex items-center gap-4 ml-auto">
                <!-- Search bar -->
                <div class="relative hidden lg:block w-64">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">search</span>
                    <input type="text" placeholder="Cari ID Laporan..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                </div>
                
                <!-- Notifications Dropdown -->
                <div class="relative">
                    <button id="notif-toggle" class="p-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined text-[24px]">notifications</span>
                        @if(Auth::user()->unreadNotifications->count() > 0)
                        <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border border-white animate-pulse"></span>
                        @endif
                    </button>

                    <!-- Notif Dropdown Content -->
                    <div id="notif-dropdown" class="absolute top-full right-0 mt-3 w-[320px] bg-white rounded-2xl shadow-2xl border border-slate-100 transition-all duration-300 opacity-0 scale-95 pointer-events-none z-[110] overflow-hidden text-left">
                        <div class="p-4 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                            <h4 class="text-sm font-bold text-slate-900">Pemberitahuan</h4>
                            <a href="#" class="text-[11px] font-bold text-brand-600 hover:text-brand-900 transition-colors">Tandai Dibaca</a>
                        </div>
                        <div class="max-h-[350px] overflow-y-auto">
                            @forelse(Auth::user()->notifications->take(5) as $notif)
                            <div class="p-4 hover:bg-slate-50 transition-colors border-b border-slate-50 group cursor-pointer">
                                <div class="flex gap-3">
                                    <div class="w-10 h-10 rounded-full @if($notif->unread()) bg-brand-50 text-brand-600 @else bg-slate-50 text-slate-400 @endif flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[18px]">@if($notif->data['type'] ?? '' === 'status') rule @else assignment_late @endif</span>
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <p class="text-xs text-slate-900 font-bold leading-snug group-hover:text-brand-900 transition-colors">
                                            {{ $notif->data['message'] ?? 'Pembaruan Laporan' }}
                                        </p>
                                        <div class="flex items-center gap-1.5 mt-1">
                                            <span class="text-[10px] font-medium text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
                                            @if($notif->unread())
                                            <span class="w-1.5 h-1.5 bg-brand-500 rounded-full"></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="p-10 text-center flex flex-col items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-slate-300 text-[24px]">notifications_off</span>
                                </div>
                                <p class="text-xs font-medium text-slate-500">Tidak ada pemberitahuan baru</p>
                            </div>
                            @endforelse
                        </div>
                        @if(Auth::user()->notifications->count() > 0)
                        <a href="{{ route('dashboarduser.notifikasi') }}" class="p-3 bg-slate-50 hover:bg-slate-100 text-center block text-xs font-bold text-slate-500 hover:text-brand-700 transition-all border-t border-slate-100">
                            Lihat Semua Pemberitahuan
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Scrollable Dashboard Content -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 custom-scrollbar relative">
            
            <!-- Skeleton Loader Wrapper -->
            <div id="skeleton-loader" class="max-w-7xl mx-auto space-y-6 absolute inset-0 p-4 sm:p-6 lg:p-8 bg-[#FAFAFA] z-20">
                <!-- 4 Summary Cards Skeleton -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    <div class="bg-white rounded-xl border border-slate-200 p-5 h-[116px] skeleton-pulse"></div>
                    <div class="bg-white rounded-xl border border-slate-200 p-5 h-[116px] skeleton-pulse"></div>
                    <div class="bg-white rounded-xl border border-slate-200 p-5 h-[116px] skeleton-pulse"></div>
                    <div class="bg-white rounded-xl border border-slate-200 p-5 h-[116px] skeleton-pulse"></div>
                </div>
                <!-- Chart Skeleton -->
                <div class="bg-white rounded-xl border border-slate-200 h-[340px] skeleton-pulse"></div>
                <!-- Table Skeleton -->
                <div class="bg-white rounded-xl border border-slate-200 h-[400px] skeleton-pulse"></div>
            </div>

            <div id="main-content" class="max-w-7xl mx-auto space-y-6 opacity-0 transition-opacity duration-500">
                
                <!-- 1. SUMMARY CARDS -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 animate-[fadeInUp_0.3s_ease-out]">
                    <!-- Card 1: Total -->
                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Laporan</p>
                            <span class="material-symbols-outlined text-brand-500 text-[20px]">folder_open</span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-brand-900">{{ number_format($totalCount) }}</h3>
                        <p class="text-[11px] text-emerald-600 font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">analytics</span> Terdata di sistem
                        </p>
                    </div>

                    <!-- Card 2: Baru -->
                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden">
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Laporan Baru</p>
                            <span class="material-symbols-outlined text-rose-500 text-[20px]">mark_email_unread</span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-brand-900">{{ number_format($baruCount) }}</h3>
                        <p class="text-[11px] text-rose-600 font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">error</span> Butuh verifikasi segera
                        </p>
                    </div>

                    <!-- Card 3: Diproses -->
                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden">
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Sedang Diproses</p>
                            <span class="material-symbols-outlined text-amber-500 text-[20px]">sync</span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-brand-900">{{ number_format($prosesCount) }}</h3>
                        <p class="text-[11px] text-slate-500 font-medium mt-1">Status tindak lanjut aktif</p>
                    </div>

                    <!-- Card 4: Selesai -->
                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden">
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Selesai</p>
                            <span class="material-symbols-outlined text-emerald-500 text-[20px]">task_alt</span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-brand-900">{{ number_format($selesaiCount) }}</h3>
                        <p class="text-[11px] text-emerald-600 font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">check_circle</span> Laporan terselesaikan
                        </p>
                    </div>
                </div>

                <!-- 2. CHART SECTION -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 animate-[fadeInUp_0.4s_ease-out]">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="font-bold text-brand-900 text-base">Statistik Laporan Harian</h3>
                            <p class="text-xs text-slate-500">Jumlah laporan masuk dalam 7 hari terakhir</p>
                        </div>
                        <button class="text-xs font-semibold text-slate-500 border border-slate-200 px-3 py-1.5 rounded bg-slate-50 hover:bg-slate-100 flex items-center gap-1">
                            Minggu Ini <span class="material-symbols-outlined text-[14px]">expand_more</span>
                        </button>
                    </div>
                    <!-- Chart Canvas -->
                    <div class="w-full h-[250px] md:h-[300px] relative">
                        <canvas id="reportsChart"></canvas>
                    </div>
                </div>

                <!-- 3. LIST LAPORAN & FILTER -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden animate-[fadeInUp_0.5s_ease-out]">
                    <!-- Header & Filter -->
                    <div class="p-5 border-b border-slate-200 bg-slate-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <h3 class="font-bold text-brand-900 text-base">Manajemen Laporan</h3>
                        
                        <!-- Filter Group -->
                        <div class="flex flex-wrap items-center gap-3">
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-[16px]">filter_list</span>
                                <select class="pl-8 pr-8 py-2 bg-white border border-slate-200 rounded-md text-xs font-medium focus:outline-none focus:border-brand-500 appearance-none text-slate-700 shadow-sm cursor-pointer">
                                    <option value="all">Semua Status</option>
                                    <option value="baru">Baru</option>
                                    <option value="diproses">Diproses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                                <span class="material-symbols-outlined absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-[16px] pointer-events-none">expand_more</span>
                            </div>
                            
                            <input type="date" class="px-3 py-2 bg-white border border-slate-200 rounded-md text-xs font-medium focus:outline-none focus:border-brand-500 text-slate-700 shadow-sm cursor-pointer" />
                            
                            <button class="bg-brand-900 text-white px-4 py-2 rounded-md text-xs font-semibold hover:bg-brand-800 transition-colors shadow-sm">
                                Terapkan
                            </button>
                        </div>
                    </div>

                    <!-- Table Wrapper -->
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left border-collapse whitespace-nowrap min-w-[800px]">
                            <thead>
                                <tr class="bg-white border-b border-slate-200">
                                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">No. ID</th>
                                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Nama User</th>
                                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Judul Laporan</th>
                                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($recentReports as $laporan)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-xs font-mono text-slate-500">#LPK-{{ $laporan->id }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            @if($laporan->user->foto_profil)
                                                <img src="{{ str_starts_with($laporan->user->foto_profil, 'http') ? $laporan->user->foto_profil : Storage::url($laporan->user->foto_profil) }}" class="w-6 h-6 rounded-full border border-slate-200 object-cover" />
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($laporan->user->name) }}&background=f1f5f9&color=0f172a" class="w-6 h-6 rounded-full border border-slate-200" />
                                            @endif
                                            <span class="text-sm font-semibold text-brand-900">{{ $laporan->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700 max-w-[250px] truncate">
                                        {{ $laporan->judul }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-slate-700">{{ $laporan->created_at->format('d M Y') }}</p>
                                        <p class="text-[10px] text-slate-400">{{ $laporan->created_at->format('H:i') }} WITA</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded @if($laporan->status === 'baru') bg-rose-50 border-rose-100 text-rose-700 @elseif($laporan->status === 'diproses') bg-amber-50 border-amber-100 text-amber-700 @else bg-emerald-50 border-emerald-100 text-emerald-700 @endif text-[10px] font-bold uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full @if($laporan->status === 'baru') bg-rose-500 animate-pulse @elseif($laporan->status === 'diproses') bg-amber-500 @else bg-emerald-500 @endif"></span> {{ $laporan->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="p-1.5 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded transition-colors inline-block" title="Lihat Detail">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination (Mockup) -->
                    <div class="px-6 py-4 border-t border-slate-200 bg-white flex items-center justify-between">
                        <span class="text-xs text-slate-500">Menampilkan 5 laporan terbaru</span>
                        <a href="{{ route('admin.laporan') }}" class="text-xs font-bold text-brand-600 hover:text-brand-800 flex items-center gap-1">
                            Lihat Semua <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- UI/UX Scripts & Chart Initialization -->
    <script>
        // --- Mobile Sidebar Toggle ---
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                // Open
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                    overlay.classList.add('opacity-100');
                }, 10);
            } else {
                // Close
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
            }
        }

        // --- Notification & Sidebar Logic ---
        document.addEventListener('DOMContentLoaded', () => {
            const notifToggle = document.getElementById('notif-toggle');
            const notifDropdown = document.getElementById('notif-dropdown');

            if (notifToggle && notifDropdown) {
                notifToggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isOpen = !notifDropdown.classList.contains('opacity-0');
                    if (isOpen) {
                        notifDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                        notifDropdown.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                    } else {
                        notifDropdown.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                        notifDropdown.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
                    }
                });

                document.addEventListener('click', (e) => {
                    if (!notifDropdown.contains(e.target) && e.target !== notifToggle) {
                        notifDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                        notifDropdown.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                    }
                });
            }

            // Skeleton Loader Logic
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

        // --- Chart.js Initialization ---
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('reportsChart').getContext('2d');
            
            // Gradient fill for line chart
            let gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(20, 184, 166, 0.4)'); // brand-500 with opacity
            gradient.addColorStop(1, 'rgba(20, 184, 166, 0.0)');

            const reportsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Laporan Masuk',
                        data: @json($chartData),
                        borderColor: '#0d9488', // brand-600
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#0d9488',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4 // Creates smooth curves
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Hide default legend for cleaner look
                        },
                        tooltip: {
                            backgroundColor: '#0f172a', // slate-900
                            titleFont: { family: 'Inter', size: 13 },
                            bodyFont: { family: 'Inter', size: 13 },
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' Laporan';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9', // slate-100
                                drawBorder: false,
                            },
                            ticks: {
                                color: '#64748b', // slate-500
                                font: { family: 'Inter', size: 11 },
                                stepSize: 20
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                color: '#64748b',
                                font: { family: 'Inter', size: 11 }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                }
            });
        });
    </script>
</body>
</html>