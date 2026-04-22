<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Riwayat Laporan Saya - LaporanKita</title>
    
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .icon-filled {
            font-variation-settings: 'FILL' 1;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Skeleton Pulse */
        .skeleton-pulse { animation: pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: .5; }
        }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex h-screen overflow-hidden selection:bg-brand-500 selection:text-white">

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
            
            <a href="{{ route('dashboarduser.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-brand-900 rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-600 transition-colors">dashboard</span>
                Dashboard
            </a>
            
            <a href="{{ route('laporan.create') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-brand-900 rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-600 transition-colors">add_box</span>
                Buat Laporan
            </a>
            
            <a href="{{ route('dashboarduser.laporan') }}" class="flex items-center gap-3 px-3 py-2.5 bg-brand-50 text-brand-900 rounded-lg font-semibold text-sm transition-colors">
                <span class="material-symbols-outlined icon-filled text-[20px] text-brand-600">assignment</span>
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
                <span class="text-lg font-bold tracking-tight text-brand-900">Riwayat Laporan</span>
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

                <!-- User Profile Info -->
                <div class="flex items-center gap-3 pl-3 border-l border-slate-100 ml-1">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-slate-900 leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] {{ auth()->user()->is_verified ? 'text-emerald-600' : 'text-slate-400' }} font-bold uppercase tracking-tighter">
                            {{ auth()->user()->is_verified ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                        </p>
                    </div>
                    @if(auth()->user()->foto_profil)
                        <img src="{{ str_starts_with(auth()->user()->foto_profil, 'http') ? auth()->user()->foto_profil : Storage::url(auth()->user()->foto_profil) }}" alt="Avatar" class="w-9 h-9 rounded-full border border-slate-200 object-cover" />
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=f1f5f9&color=0f172a" alt="Avatar" class="w-9 h-9 rounded-full border border-slate-200" />
                    @endif
                </div>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 no-scrollbar bg-[#FAFAFA] relative">
            
            <div class="max-w-5xl mx-auto space-y-6">
                
                @if(count($laporans) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                        @foreach($laporans as $laporan)
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden group hover:border-brand-500/50 transition-all duration-300 flex flex-col">
                            <!-- Image Header -->
                            <div class="relative h-48 overflow-hidden bg-slate-100">
                                @if($laporan->foto && count($laporan->foto) > 0)
                                    <img src="{{ Storage::url($laporan->foto[0]) }}" alt="Foto Laporan" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
                                    @if(count($laporan->foto) > 1)
                                    <div class="absolute bottom-3 right-3 bg-brand-900/80 backdrop-blur text-white text-[10px] font-bold px-2 py-1 rounded-md flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[12px]">filter_none</span>
                                        +{{ count($laporan->foto) - 1 }}
                                    </div>
                                    @endif
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <span class="material-symbols-outlined text-[48px]">image_not_supported</span>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4 capitalize inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-lg bg-white/90 backdrop-blur-md @if($laporan->status === 'baru') text-rose-600 @elseif($laporan->status === 'diproses') text-amber-600 @else text-emerald-600 @endif">
                                    <span class="w-1.5 h-1.5 rounded-full @if($laporan->status === 'baru') bg-rose-500 @elseif($laporan->status === 'diproses') bg-amber-500 @else bg-emerald-500 @endif"></span>
                                    {{ $laporan->status }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-1 flex flex-col">
                                <span class="text-[10px] font-extrabold text-brand-600 uppercase tracking-widest mb-1">{{ $laporan->kategori }}</span>
                                <h3 class="font-bold text-brand-900 text-lg mb-2 line-clamp-2 leading-tight group-hover:text-brand-600 transition-colors">
                                    {{ $laporan->judul }}
                                </h3>
                                <p class="text-slate-500 text-sm line-clamp-3 mb-6 leading-relaxed flex-1">
                                    {{ Str::limit($laporan->deskripsi, 120) }}
                                </p>
                                
                                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                                    <span class="text-[11px] font-medium text-slate-400">{{ $laporan->created_at->format('d M Y') }}</span>
                                    <a href="{{ route('laporan.show', $laporan->id) }}" class="flex items-center gap-1.5 text-xs font-bold text-brand-900 hover:text-brand-600 transition-colors">
                                        Detail Laporan <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="flex flex-col items-center justify-center py-20 text-center">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-slate-400 text-[40px]">inventory_2</span>
                        </div>
                        <h3 class="text-xl font-bold text-brand-900 mb-2">Belum ada laporan</h3>
                        <p class="text-slate-500 max-w-sm mb-8">Anda belum pernah mengirimkan laporan. Mulai laporkan aspirasi atau keluhan Anda sekarang.</p>
                        <a href="{{ route('laporan.create') }}" class="bg-brand-900 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-xl shadow-brand-900/20 active:scale-95 transition-all">
                            Buat Laporan Pertama
                        </a>
                    </div>
                @endif

            </div>
            
            <!-- Spacing at bottom for mobile nav -->
            <div class="h-12 md:hidden"></div>
        </div>
    </main>

    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-xl border-t border-slate-200 z-50 px-2 sm:px-6 py-1.5 flex justify-around items-center pb-[calc(0.5rem+env(safe-area-inset-bottom))] shadow-[0_-4px_20px_-5px_rgba(0,0,0,0.05)]">
        <a href="{{ route('dashboarduser.index') }}" class="flex flex-col items-center text-slate-400 hover:text-brand-900 transition-colors w-16 pt-2">
            <span class="material-symbols-outlined text-[24px]">dashboard</span>
            <span class="text-[10px] font-medium mt-1 tracking-wide">Beranda</span>
        </a>
        <a href="{{ route('dashboarduser.laporan') }}" class="flex flex-col items-center text-brand-900 transition-colors w-16 pt-2">
            <span class="material-symbols-outlined icon-filled text-[24px]">assignment</span>
            <span class="text-[10px] font-bold mt-1 tracking-wide">Riwayat</span>
        </a>
        <div class="relative -top-5 shrink-0 px-2">
            <a href="{{ route('laporan.create') }}" class="bg-brand-900 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_20px_-6px_rgba(15,23,42,0.6)] border-[4px] border-[#FAFAFA] active:scale-95 transition-transform">
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
