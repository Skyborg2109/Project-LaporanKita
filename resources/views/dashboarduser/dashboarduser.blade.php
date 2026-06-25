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
    <aside class="hidden md:flex flex-col w-64 h-full z-20 shrink-0 bg-gradient-to-b from-teal-600 via-brand-500 to-emerald-500 border-r-0">
        <div class="h-16 flex items-center px-6 border-b border-white/20">
            <div class="flex items-center gap-2.5">
                <div class="bg-white/20 backdrop-blur-sm text-white p-1.5 rounded-lg">
                    <span class="material-symbols-outlined icon-filled text-[18px]">maps_ugc</span>
                </div>
                <span class="text-lg font-bold tracking-tight text-white">Laporan<span class="text-emerald-200">Kita</span></span>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5">
            <div class="text-[10px] font-bold text-white/50 uppercase tracking-widest px-2 mb-2">Menu Utama</div>
            
            <a href="{{ route('dashboarduser.index') }}" class="flex items-center gap-3 px-3 py-2.5 bg-white/20 backdrop-blur-sm text-white rounded-xl font-semibold text-sm shadow-sm transition-all">
                <span class="material-symbols-outlined icon-filled text-[20px]">dashboard</span>
                Dashboard
            </a>
            
            <a href="{{ route('laporan.create') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/80 hover:bg-white/15 hover:text-white rounded-xl font-medium text-sm transition-all group">
                <span class="material-symbols-outlined text-[20px] text-emerald-200 group-hover:text-white transition-colors">add_box</span>
                Buat Laporan
            </a>
            
            <a href="{{ route('dashboarduser.laporan') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/80 hover:bg-white/15 hover:text-white rounded-xl font-medium text-sm transition-all group">
                <span class="material-symbols-outlined text-[20px] text-amber-200 group-hover:text-white transition-colors">assignment</span>
                Laporan Saya
            </a>

            <a href="{{ route('dashboarduser.notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/80 hover:bg-white/15 hover:text-white rounded-xl font-medium text-sm transition-all group relative">
                <span class="material-symbols-outlined text-[20px] text-rose-200 group-hover:text-white transition-colors">notifications</span>
                Notifikasi
                @if(isset($unreadCount) && $unreadCount > 0)
                <span class="ml-auto bg-rose-500 text-white text-[10px] font-bold rounded-full px-1.5 py-0.5 min-w-[20px] text-center shadow-sm">{{ $unreadCount }}</span>
                @endif
            </a>

            <a href="{{ route('dashboarduser.profil') }}" class="flex items-center gap-3 px-3 py-2.5 text-white/80 hover:bg-white/15 hover:text-white rounded-xl font-medium text-sm transition-all group">
                <span class="material-symbols-outlined text-[20px] text-sky-200 group-hover:text-white transition-colors">manage_accounts</span>
                Profil Saya
            </a>
        </div>

        <div class="p-4 border-t border-white/20">
            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-white/70 hover:bg-white/15 hover:text-white rounded-xl font-medium text-sm transition-all text-left">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT AREA ==================== -->
    <main class="flex-1 flex flex-col h-full w-full overflow-hidden relative pb-[72px] md:pb-0">
        
        <!-- Mobile Header -->
        <header class="md:hidden bg-white/90 backdrop-blur-md h-16 border-b border-slate-200 flex items-center justify-between px-4 sticky top-0 z-20 shadow-sm">
            <div class="flex items-center gap-2">
                <div class="bg-gradient-to-br from-brand-500 to-teal-600 text-white p-1 rounded flex items-center justify-center">
                    <span class="material-symbols-outlined icon-filled text-[16px]">maps_ugc</span>
                </div>
                <span class="text-lg font-bold tracking-tight text-brand-900">Dashboard</span>
            </div>
            <div class="relative" id="notif-wrapper-mobile">
                <button id="notif-toggle-mobile" class="relative p-2 text-slate-500 hover:bg-slate-50 rounded-full transition-colors">
                    <span class="material-symbols-outlined text-[24px]">notifications</span>
                    @if(isset($unreadCount) && $unreadCount > 0)
                    <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border border-white animate-pulse"></span>
                    @endif
                </button>

                <!-- Mobile Notif Dropdown Content -->
                <div id="notif-dropdown-mobile" class="fixed top-16 left-4 right-4 bg-white rounded-2xl shadow-2xl border border-slate-100 transition-all duration-300 opacity-0 scale-95 pointer-events-none z-[110] overflow-hidden text-left max-h-[70vh] flex flex-col">
                    <div class="p-4 border-b border-slate-50 flex items-center justify-between bg-gradient-to-r from-brand-50 to-teal-50">
                        <h4 class="text-sm font-bold text-brand-900">Pemberitahuan</h4>
                        <a href="#" class="text-[11px] font-bold text-brand-600 hover:text-brand-900 transition-colors">Tandai Dibaca</a>
                    </div>
                    <div class="overflow-y-auto flex-1">
                        @if(isset($unreadNotifications) && $unreadNotifications->count() > 0)
                            @foreach($unreadNotifications->take(5) as $notif)
                            @php
                                $notifType = $notif->data['type'] ?? '';
                                if ($notifType === '' && isset($notif->data['kategori_baru'])) {
                                    $notifType = 'kategori_dikoreksi';
                                } elseif ($notifType === '' && (isset($notif->data['status']) || isset($notif->data['status_label']))) {
                                    $notifType = 'status';
                                }
                                $typeLabel = match($notifType) {
                                    'kategori_dikoreksi' => 'Kategori Dikoreksi',
                                    'status'             => $notif->data['status_label'] ?? 'Status Diperbarui',
                                    default              => 'Pembaruan Laporan',
                                };
                                $typeColor = match($notifType) {
                                    'kategori_dikoreksi' => 'text-sky-600 bg-sky-50 border-sky-100',
                                    'status'             => 'text-emerald-600 bg-emerald-50 border-emerald-100',
                                    default              => 'text-slate-600 bg-slate-50 border-slate-100',
                                };
                                $typeIcon = match($notifType) {
                                    'kategori_dikoreksi' => 'edit_note',
                                    'status'             => 'rule',
                                    default              => 'assignment_late',
                                };
                            @endphp
                            <a href="{{ route('laporan.show', $notif->data['laporan_id']) }}" class="p-4 hover:bg-slate-50 transition-colors border-b border-slate-50 group block">
                                <div class="flex gap-3">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 {{ $typeColor }}">
                                        <span class="material-symbols-outlined text-[18px]">{{ $typeIcon }}</span>
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <div class="flex items-center gap-2 mb-1">
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider border {{ $typeColor }}">
                                                {{ $typeLabel }}
                                            </span>
                                            <span class="text-[10px] font-medium text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-xs text-slate-900 font-bold leading-snug group-hover:text-brand-900 transition-colors">
                                            {{ $notif->data['pesan'] ?? ($notif->data['judul'] ?? 'Ada pembaruan pada laporan Anda.') }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        @else
                            <div class="p-10 text-center flex flex-col items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-slate-300 text-[24px]">notifications_off</span>
                                </div>
                                <p class="text-xs font-medium text-slate-500">Tidak ada pemberitahuan baru</p>
                            </div>
                        @endif
                    </div>
                    <a href="{{ route('dashboarduser.notifikasi') }}" class="p-4 bg-gradient-to-r from-brand-50 to-teal-50 hover:from-brand-100 hover:to-teal-100 text-center block text-xs font-bold text-brand-700 transition-all border-t border-slate-100">
                        Lihat Semua Pemberitahuan
                    </a>
                </div>
            </div>
        </header>

        <!-- Desktop Topbar -->
        <header class="hidden md:flex h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 items-center justify-between px-8 sticky top-0 z-10">
            <div class="relative w-96">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                <input type="text" placeholder="Cari laporan Anda..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
            </div>
            <div class="flex items-center gap-4">
                <!-- Desktop Notification Dropdown -->
                <div class="relative" id="notif-wrapper">
                    <button id="notif-toggle" class="p-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-full transition-all relative flex items-center justify-center">
                        <span class="material-symbols-outlined text-[24px]">notifications</span>
                        @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border border-white animate-pulse"></span>
                        @endif
                    </button>

                    <!-- Notif Dropdown Content -->
                    <div id="notif-dropdown" class="absolute top-full right-0 mt-3 w-[320px] bg-white rounded-2xl shadow-2xl border border-slate-100 transition-all duration-300 opacity-0 scale-95 pointer-events-none z-[110] overflow-hidden text-left">
                        <div class="p-4 border-b border-slate-50 flex items-center justify-between bg-gradient-to-r from-brand-50 to-teal-50">
                            <h4 class="text-sm font-bold text-brand-900">Pemberitahuan</h4>
                            <a href="#" class="text-[11px] font-bold text-brand-600 hover:text-brand-900 transition-colors">Tandai Dibaca</a>
                        </div>
                        <div class="max-h-[350px] overflow-y-auto">
                            @if(isset($unreadNotifications) && $unreadNotifications->count() > 0)
                                @foreach($unreadNotifications->take(5) as $notif)
                                @php
                                    $notifType = $notif->data['type'] ?? '';
                                    if ($notifType === '' && isset($notif->data['kategori_baru'])) {
                                        $notifType = 'kategori_dikoreksi';
                                    } elseif ($notifType === '' && (isset($notif->data['status']) || isset($notif->data['status_label']))) {
                                        $notifType = 'status';
                                    }
                                    $typeLabel = match($notifType) {
                                        'kategori_dikoreksi' => 'Kategori Dikoreksi',
                                        'status'             => $notif->data['status_label'] ?? 'Status Diperbarui',
                                        default              => 'Pembaruan Laporan',
                                    };
                                    $typeColor = match($notifType) {
                                        'kategori_dikoreksi' => 'text-sky-600 bg-sky-50 border-sky-100',
                                        'status'             => 'text-emerald-600 bg-emerald-50 border-emerald-100',
                                        default              => 'text-slate-600 bg-slate-50 border-slate-100',
                                    };
                                    $typeIcon = match($notifType) {
                                        'kategori_dikoreksi' => 'edit_note',
                                        'status'             => 'rule',
                                        default              => 'assignment_late',
                                    };
                                @endphp
                                <a href="{{ route('laporan.show', $notif->data['laporan_id']) }}" class="p-4 hover:bg-slate-50 transition-colors border-b border-slate-50 group block">
                                    <div class="flex gap-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 {{ $typeColor }}">
                                            <span class="material-symbols-outlined text-[18px]">{{ $typeIcon }}</span>
                                        </div>
                                        <div class="flex-grow min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider border {{ $typeColor }}">
                                                    {{ $typeLabel }}
                                                </span>
                                                <span class="text-[10px] font-medium text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-xs text-slate-900 font-bold leading-snug group-hover:text-brand-900 transition-colors">
                                                {{ $notif->data['pesan'] ?? ($notif->data['judul'] ?? 'Ada pembaruan pada laporan Anda.') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            @else
                                <div class="p-10 text-center flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-slate-300 text-[24px]">notifications_off</span>
                                    </div>
                                    <p class="text-xs font-medium text-slate-500">Tidak ada pemberitahuan baru</p>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('dashboarduser.notifikasi') }}" class="p-3 bg-gradient-to-r from-brand-50 to-teal-50 hover:from-brand-100 hover:to-teal-100 text-center block text-xs font-bold text-brand-600 hover:text-brand-800 transition-all border-t border-slate-100">
                            Lihat Semua Pemberitahuan
                        </a>
                    </div>
                </div>

                <!-- User Profile Avatar (Berdampingan langsung dengan notif) -->
                <a href="{{ route('dashboarduser.profil') }}" class="flex items-center hover:opacity-85 transition-all shrink-0" title="Profil Saya">
                    @if(auth()->user()->foto_profil)
                        <img src="{{ Storage::url(auth()->user()->foto_profil) }}" alt="Avatar" class="w-9 h-9 rounded-full border border-slate-200 object-cover" />
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=f1f5f9&color=0f172a" alt="Avatar" class="w-9 h-9 rounded-full border border-slate-200" />
                    @endif
                </a>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 no-scrollbar relative w-full">
            
            <!-- Skeleton Loader Wrapper -->
            <div id="skeleton-loader" class="absolute inset-0 p-4 sm:p-6 lg:p-8 bg-[#FAFAFA] z-20 max-w-7xl mx-auto">
                <div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-brand-200 to-teal-200 h-[100px] skeleton-pulse"></div>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8 w-full">
                    <div class="bg-white rounded-xl border border-slate-200 h-[120px] skeleton-pulse"></div>
                    <div class="bg-white rounded-xl border border-slate-200 h-[120px] skeleton-pulse"></div>
                    <div class="bg-white rounded-xl border border-slate-200 h-[120px] skeleton-pulse"></div>
                    <div class="bg-white rounded-xl border border-slate-200 h-[120px] skeleton-pulse"></div>
                </div>
                <div class="bg-white border border-slate-200 rounded-2xl h-[300px] skeleton-pulse w-full"></div>
            </div>

            <div id="main-content" class="max-w-7xl mx-auto opacity-0 transition-opacity duration-500 w-full">
                
                <!-- Greeting Section -->
                <div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-brand-500 via-brand-600 to-teal-700 text-white relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full"></div>
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/5 rounded-full"></div>
                    <div class="relative z-10">
                        <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight mb-1">Halo, {{ auth()->user()->name }} 👋</h1>
                        <p class="text-sm text-white/80 font-medium">Ini adalah ringkasan aktivitas partisipasi publik Anda.</p>
                    </div>
                </div>
                
                @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
                @endif

                <!-- Card Summary (Grid 4 Kolom seperti Admin) -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8 w-full">
                    
                    <!-- Card 1: Total Laporan (Brand/Teal) -->
                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-brand-500 rounded-l-xl"></div>
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Total Laporan</p>
                            <span class="material-symbols-outlined text-brand-500 text-[20px]">folder_open</span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-brand-900">{{ $totalLaporan }}</h3>
                        <p class="text-[11px] text-brand-600 font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">analytics</span> Terdata di sistem
                        </p>
                    </div>

                    <!-- Card 2: Laporan Baru (Rose) -->
                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-rose-500 rounded-l-xl"></div>
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Laporan Baru</p>
                            <span class="material-symbols-outlined text-rose-500 text-[20px]">mark_email_unread</span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-brand-900">{{ $totalLaporan - $laporanDiproses - $laporanSelesai }}</h3>
                        <p class="text-[11px] text-rose-600 font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">error</span> Butuh verifikasi
                        </p>
                    </div>

                    <!-- Card 3: Diproses (Amber) -->
                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-amber-500 rounded-l-xl"></div>
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Sedang Diproses</p>
                            <span class="material-symbols-outlined text-amber-500 text-[20px]">sync</span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-brand-900">{{ $laporanDiproses }}</h3>
                        <p class="text-[11px] text-amber-600 font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">pending</span> Status aktif
                        </p>
                    </div>

                    <!-- Card 4: Selesai (Emerald) -->
                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-500 rounded-l-xl"></div>
                        <div class="flex justify-between items-start mb-2">
                            <p class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Selesai</p>
                            <span class="material-symbols-outlined text-emerald-500 text-[20px]">task_alt</span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-brand-900">{{ $laporanSelesai }}</h3>
                        <p class="text-[11px] text-emerald-600 font-medium mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">check_circle</span> Laporan selesai
                        </p>
                    </div>
                </div>

                <!-- Tab Navigation -->
                <div class="mb-6 border-b border-slate-200">
                    <nav class="-mb-px flex space-x-6 sm:space-x-8" aria-label="Tabs">
                        <button id="tab-saya-btn" onclick="switchDashboardTab('saya')" class="border-brand-600 text-brand-900 whitespace-nowrap py-3.5 px-1 border-b-2 font-bold text-sm flex items-center gap-2 transition-all">
                            <span class="material-symbols-outlined text-[20px] text-brand-600 icon-filled">assignment</span>
                            Aktivitas Saya
                        </button>
                        <button id="tab-lain-btn" onclick="switchDashboardTab('lain')" class="border-transparent text-slate-500 hover:text-brand-700 hover:border-brand-300 whitespace-nowrap py-3.5 px-1 border-b-2 font-semibold text-sm flex items-center gap-2 transition-all">
                            <span class="material-symbols-outlined text-[20px]">explore</span>
                            Feed Laporan Publik
                        </button>
                    </nav>
                </div>

                <!-- Tab 1: Aktivitas Saya -->
                <div id="tab-content-saya" class="space-y-6 block">
                    <!-- List Laporan Terkini -->
                    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden w-full">
                        <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-gradient-to-r from-brand-50 to-teal-50">
                            <h2 class="font-bold text-brand-900 text-base flex items-center gap-2">
                                <span class="material-symbols-outlined text-brand-500 text-[20px] icon-filled">assignment</span>
                                Aktivitas Laporan Terkini
                            </h2>
                            <a href="{{ route('dashboarduser.laporan') }}" class="text-xs font-semibold text-brand-600 hover:text-brand-800 transition-colors flex items-center gap-1">
                                Lihat Semua <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[600px]">
                                <thead>
                                    <tr class="bg-brand-50 border-b border-brand-100">
                                        <th class="px-5 py-3 text-[11px] font-bold text-brand-700 uppercase tracking-wider w-1/2">Judul Laporan</th>
                                        <th class="px-5 py-3 text-[11px] font-bold text-brand-700 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-5 py-3 text-[11px] font-bold text-brand-700 uppercase tracking-wider">Status</th>
                                        <th class="px-5 py-3 text-[11px] font-bold text-brand-700 uppercase tracking-wider text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse ($laporans as $laporan)
                                    <tr class="hover:bg-slate-50 transition-colors cursor-pointer row-link" data-url="{{ route('laporan.show', $laporan->id) }}">
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
                </div>

                <!-- Tab 2: Feed Laporan Publik -->
                <div id="tab-content-lain" class="space-y-6 hidden">
                    @if(count($laporanLain) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($laporanLain as $laporan)
                            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden group hover:border-brand-400 hover:shadow-lg transition-all duration-300 flex flex-col cursor-pointer card-link" data-url="{{ route('laporan.show', $laporan->id) }}">
                                <!-- Image Header -->
                                <div class="relative h-48 overflow-hidden bg-slate-100 shrink-0">
                                    @if($laporan->foto && count($laporan->foto) > 0)
                                        <img src="{{ str_starts_with($laporan->foto[0], 'http') ? $laporan->foto[0] : Storage::url($laporan->foto[0]) }}" alt="Foto Laporan" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                        @if(count($laporan->foto) > 1)
                                        <div class="absolute bottom-3 right-3 bg-brand-900/80 backdrop-blur text-white text-[10px] font-bold px-2 py-1 rounded-md flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[12px]">filter_none</span>
                                            +{{ count($laporan->foto) - 1 }}
                                        </div>
                                        @endif
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50">
                                            <span class="material-symbols-outlined text-[48px]">image_not_supported</span>
                                        </div>
                                    @endif
                                    <div class="absolute top-4 right-4 capitalize inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-lg bg-white/90 backdrop-blur-md @if($laporan->status === 'baru') text-rose-600 @elseif($laporan->status === 'diproses') text-amber-600 @else text-emerald-600 @endif">
                                        <span class="w-1.5 h-1.5 rounded-full @if($laporan->status === 'baru') bg-rose-500 @elseif($laporan->status === 'diproses') bg-amber-500 @else bg-emerald-500 @endif"></span>
                                        {{ $laporan->status }}
                                    </div>
                                </div>

                                <!-- Content Body -->
                                <div class="p-5 flex-grow flex flex-col">
                                    <!-- Author info & Category -->
                                    <div class="flex items-center justify-between gap-2 mb-3">
                                        <div class="flex items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($laporan->user->name) }}&background=e2e8f0&color=0f172a" alt="User" class="w-6 h-6 rounded-full border border-slate-100 shrink-0" />
                                            <span class="text-xs font-bold text-slate-700 truncate max-w-[120px]">{{ $laporan->user->name }}</span>
                                        </div>
                                        <span class="text-[10px] font-extrabold text-brand-600 bg-brand-50/50 border border-brand-100 rounded px-2 py-0.5 uppercase tracking-wider shrink-0">{{ $laporan->kategori }}</span>
                                    </div>

                                    <h3 class="font-bold text-brand-900 text-sm mb-2 line-clamp-2 leading-snug group-hover:text-brand-600 transition-colors">
                                        {{ $laporan->judul }}
                                    </h3>
                                    <p class="text-slate-500 text-xs line-clamp-3 mb-4 leading-relaxed flex-grow">
                                        {{ Str::limit($laporan->deskripsi, 120) }}
                                    </p>
                                    
                                    <!-- Support button & Details -->
                                    <div class="flex items-center justify-between pt-4 border-t border-slate-100 shrink-0">
                                        @php
                                            $hasSupported = $laporan->supports->contains('user_id', Auth::id());
                                            $supportCount = $laporan->supports->count();
                                        @endphp
                                        <button data-id="{{ $laporan->id }}" class="btn-support-card flex items-center gap-1.5 px-3 py-1.5 {{ $hasSupported ? 'bg-brand-50 text-brand-600 border-brand-200' : 'bg-white text-slate-500 border-slate-200' }} border hover:bg-brand-50 hover:text-brand-600 hover:border-brand-200 rounded-lg transition-all text-[11px] font-bold shadow-sm group">
                                            <span class="material-symbols-outlined text-[15px] {{ $hasSupported ? 'icon-filled' : '' }} group-active:scale-125 transition-transform">thumb_up</span> 
                                            <span class="support-count">{{ $supportCount }}</span> Dukung
                                        </button>
                                        
                                        <div class="flex items-center gap-1 text-xs font-bold text-slate-600 hover:text-brand-600 transition-colors">
                                            Detail <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="bg-white border border-slate-200 rounded-2xl p-12 text-center flex flex-col items-center justify-center">
                            <div class="w-16 h-16 bg-brand-50 rounded-full flex items-center justify-center mb-4 border border-brand-100">
                                <span class="material-symbols-outlined text-brand-400 text-[32px]">campaign</span>
                            </div>
                            <h3 class="text-lg font-bold text-brand-900 mb-1">Belum ada laporan dari user lain</h3>
                            <p class="text-slate-500 text-xs max-w-xs">Semua laporan publik dari warga lain akan muncul di feed ini.</p>
                        </div>
                    @endif
                </div>

                <div class="h-6 md:hidden"></div>

            </div>
        </div>
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-xl border-t border-slate-200 z-50 px-2 sm:px-6 py-1.5 flex justify-around items-center pb-[calc(0.5rem+env(safe-area-inset-bottom))] shadow-[0_-4px_20px_-5px_rgba(0,0,0,0.08)]">
        <a href="{{ route('dashboarduser.index') }}" class="flex flex-col items-center text-brand-600 transition-colors w-16 pt-2">
            <span class="material-symbols-outlined icon-filled text-[24px]">dashboard</span>
            <span class="text-[10px] font-bold mt-1 tracking-wide">Beranda</span>
        </a>
        <a href="{{ route('dashboarduser.laporan') }}" class="flex flex-col items-center text-slate-400 hover:text-brand-600 transition-colors w-16 pt-2">
            <span class="material-symbols-outlined text-[24px]">assignment</span>
            <span class="text-[10px] font-medium mt-1 tracking-wide">Riwayat</span>
        </a>
        <div class="relative -top-5 shrink-0 px-2">
            <a href="{{ route('laporan.create') }}" class="bg-gradient-to-br from-brand-500 to-teal-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_20px_-6px_rgba(20,184,166,0.6)] border-[4px] border-[#FAFAFA]">
                <span class="material-symbols-outlined icon-filled text-[28px]">add</span>
            </a>
        </div>
        <a href="{{ route('dashboarduser.profil') }}" class="flex flex-col items-center text-slate-400 hover:text-brand-600 transition-colors w-16 pt-2 relative">
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

        // Tab Switcher Logic
        function switchDashboardTab(tabName) {
            const btnSaya = document.getElementById('tab-saya-btn');
            const btnLain = document.getElementById('tab-lain-btn');
            const contentSaya = document.getElementById('tab-content-saya');
            const contentLain = document.getElementById('tab-content-lain');

            const iconSaya = btnSaya.querySelector('.material-symbols-outlined');
            const iconLain = btnLain.querySelector('.material-symbols-outlined');

            if (tabName === 'saya') {
                btnSaya.className = `border-brand-600 text-brand-900 whitespace-nowrap py-3.5 px-1 border-b-2 font-bold text-sm flex items-center gap-2 transition-all`;
                btnLain.className = `border-transparent text-slate-500 hover:text-brand-700 hover:border-brand-300 whitespace-nowrap py-3.5 px-1 border-b-2 font-semibold text-sm flex items-center gap-2 transition-all`;
                
                iconSaya.classList.add('icon-filled');
                iconLain.classList.remove('icon-filled');

                contentSaya.classList.remove('hidden');
                contentSaya.classList.add('block');
                contentLain.classList.add('hidden');
                contentLain.classList.remove('block');
            } else {
                btnSaya.className = `border-transparent text-slate-500 hover:text-brand-700 hover:border-brand-300 whitespace-nowrap py-3.5 px-1 border-b-2 font-semibold text-sm flex items-center gap-2 transition-all`;
                btnLain.className = `border-brand-600 text-brand-900 whitespace-nowrap py-3.5 px-1 border-b-2 font-bold text-sm flex items-center gap-2 transition-all`;

                iconSaya.classList.remove('icon-filled');
                iconLain.classList.add('icon-filled');

                contentSaya.classList.add('hidden');
                contentSaya.classList.remove('block');
                contentLain.classList.remove('hidden');
                contentLain.classList.add('block');
            }
        }

        // Support Toggle Logic for Cards
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.btn-support-card').forEach(btn => {
                btn.addEventListener('click', async function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const id = this.getAttribute('data-id');
                    const countEl = this.querySelector('.support-count');
                    const iconEl = this.querySelector('.material-symbols-outlined');
                    
                    try {
                        const response = await fetch(`/laporan/${id}/support`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            countEl.innerText = data.count;
                            if (data.status === 'supported') {
                                this.classList.remove('bg-white', 'text-slate-500', 'border-slate-200');
                                this.classList.add('bg-brand-50', 'text-brand-600', 'border-brand-200');
                                iconEl.classList.add('icon-filled');
                            } else {
                                this.classList.remove('bg-brand-50', 'text-brand-600', 'border-brand-200');
                                this.classList.add('bg-white', 'text-slate-500', 'border-slate-200');
                                iconEl.classList.remove('icon-filled');
                            }
                        }
                    } catch (error) {
                        console.error('Error toggling support:', error);
                    }
                });
            });
        });

        // Row & Card link navigation via data-url
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.row-link, .card-link').forEach(el => {
                el.addEventListener('click', function(e) {
                    if (e.target.closest('button, a, input, textarea, select')) return;
                    const url = this.getAttribute('data-url');
                    if (url) window.location.href = url;
                });
            });
        });

        // Notification Toggle Logic (Desktop & Mobile)
        document.addEventListener('DOMContentLoaded', () => {
            const setups = [
                { toggle: 'notif-toggle', dropdown: 'notif-dropdown' },
                { toggle: 'notif-toggle-mobile', dropdown: 'notif-dropdown-mobile' }
            ];

            setups.forEach(setup => {
                const btn = document.getElementById(setup.toggle);
                const menu = document.getElementById(setup.dropdown);

                if (btn && menu) {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        
                        // Close other open dropdowns first
                        setups.forEach(s => {
                            if (s.dropdown !== setup.dropdown) {
                                const otherMenu = document.getElementById(s.dropdown);
                                if (otherMenu) otherMenu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                            }
                        });

                        const isOpen = !menu.classList.contains('opacity-0');
                        if (isOpen) {
                            menu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                            menu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                        } else {
                            menu.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                            menu.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
                        }
                    });

                    document.addEventListener('click', (e) => {
                        if (!menu.contains(e.target) && e.target !== btn && !btn.contains(e.target)) {
                            menu.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                            menu.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>