<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Notifikasi - LaporanKita</title>
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .icon-filled { font-variation-settings: 'FILL' 1; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
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
            
            <a href="{{ route('dashboarduser.laporan') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-brand-900 rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-600 transition-colors">assignment</span>
                Laporan Saya
            </a>

            <a href="{{ route('dashboarduser.notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 bg-brand-50 text-brand-900 rounded-lg font-semibold text-sm transition-colors">
                <span class="material-symbols-outlined icon-filled text-[20px] text-brand-600">notifications</span>
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

    <!-- MAIN -->
    <main class="flex-1 flex flex-col h-full w-full overflow-hidden pb-[72px] md:pb-0">

        <!-- Mobile Header -->
        <header class="md:hidden bg-white/90 backdrop-blur-md h-16 border-b border-slate-200 flex items-center justify-between px-4 sticky top-0 z-20">
            <div class="flex items-center gap-2">
                <div class="bg-brand-900 text-white p-1 rounded flex items-center justify-center">
                    <span class="material-symbols-outlined icon-filled text-[16px]">maps_ugc</span>
                </div>
                <span class="text-lg font-bold tracking-tight text-brand-900">Notifikasi</span>
            </div>
            <a href="{{ route('dashboarduser.notifikasi') }}" class="relative p-2 text-brand-600 bg-brand-50 rounded-full transition-colors">
                <span class="material-symbols-outlined text-[22px] icon-filled">notifications</span>
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
                <div class="relative" id="notif-wrapper">
                    <button id="notif-toggle" class="p-2 text-brand-600 bg-brand-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined text-[24px] icon-filled">notifications</span>
                        @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border border-white animate-pulse"></span>
                        @endif
                    </button>

                    <!-- Notif Dropdown Content -->
                    <div id="notif-dropdown" class="absolute top-full right-0 mt-3 w-[320px] bg-white rounded-2xl shadow-2xl border border-slate-100 transition-all duration-300 opacity-0 scale-95 pointer-events-none z-[110] overflow-hidden text-left">
                        <div class="p-4 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                            <h4 class="text-sm font-bold text-slate-900">Pemberitahuan</h4>
                            <a href="#" class="text-[11px] font-bold text-brand-600 hover:text-brand-900 transition-colors">Tandai Dibaca</a>
                        </div>
                        <div class="max-h-[350px] overflow-y-auto text-left">
                            @if(isset($unreadNotifications) && $unreadNotifications->count() > 0)
                                @foreach($unreadNotifications->take(5) as $notif)
                                <a href="{{ route('laporan.show', $notif->data['laporan_id']) }}" class="p-4 hover:bg-slate-50 transition-colors border-b border-slate-50 group block">
                                    <div class="flex gap-3">
                                        <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-[18px]">@if(($notif->data['type'] ?? '') === 'status') rule @else assignment_late @endif</span>
                                        </div>
                                        <div class="flex-grow min-w-0">
                                            <p class="text-xs text-slate-900 font-bold leading-snug group-hover:text-brand-900 transition-colors text-left">
                                                {{ $notif->data['pesan'] ?? 'Pembaruan Laporan' }}
                                            </p>
                                            <div class="flex items-center gap-1.5 mt-1">
                                                <span class="text-[10px] font-medium text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
                                                <span class="w-1.5 h-1.5 bg-brand-500 rounded-full"></span>
                                            </div>
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
                        <a href="{{ route('dashboarduser.notifikasi') }}" class="p-3 bg-slate-50 hover:bg-slate-100 text-center block text-xs font-bold text-slate-500 hover:text-brand-700 transition-all border-t border-slate-100">
                            Lihat Semua Pemberitahuan
                        </a>
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

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 no-scrollbar">
            <div class="max-w-2xl mx-auto">

                @if(session('success'))
                <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex gap-2 text-sm">
                    <span class="material-symbols-outlined">check_circle</span> {{ session('success') }}
                </div>
                @endif

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                        <h3 class="font-bold text-slate-900">Semua Notifikasi</h3>
                        <span class="text-xs text-slate-500">{{ $notifications->total() }} total</span>
                    </div>

                    @if($notifications->count() > 0)
                    <div class="divide-y divide-slate-50">
                        @foreach($notifications as $notif)
                        @php
                            $data = $notif->data;
                            $isRead = !is_null($notif->read_at);
                            $statusColor = match($data['status'] ?? '') {
                                'selesai' => 'text-emerald-600 bg-emerald-50',
                                'diproses' => 'text-amber-600 bg-amber-50',
                                'baru' => 'text-brand-600 bg-brand-50',
                                default => 'text-slate-600 bg-slate-50',
                            };
                            $iconName = match($data['status'] ?? '') {
                                'selesai' => 'check_circle',
                                'diproses' => 'autorenew',
                                default => 'notifications_active',
                            };
                        @endphp
                        <a href="{{ route('laporan.show', $data['laporan_id']) }}" class="flex items-start gap-4 px-5 py-4 hover:bg-slate-50 transition-colors {{ $isRead ? '' : 'bg-brand-50/30' }}">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 {{ $statusColor }}">
                                <span class="material-symbols-outlined icon-filled text-[20px]">{{ $iconName }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-900 mb-0.5">{{ $data['judul'] ?? 'Laporan Anda' }}</p>
                                <p class="text-xs text-slate-600 mb-1.5 leading-relaxed">{{ $data['pesan'] ?? '' }}</p>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full {{ $statusColor }}">
                                        {{ $data['status_label'] ?? '' }}
                                    </span>
                                    <span class="text-[10px] text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            @if(!$isRead)
                            <span class="w-2 h-2 bg-brand-500 rounded-full mt-2 shrink-0"></span>
                            @endif
                        </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($notifications->hasPages())
                    <div class="px-5 py-4 border-t border-slate-100">
                        {{ $notifications->links() }}
                    </div>
                    @endif

                    @else
                    <div class="py-16 text-center">
                        <span class="material-symbols-outlined text-slate-200 text-[64px]">notifications_none</span>
                        <p class="text-sm font-semibold text-slate-400 mt-3">Belum Ada Notifikasi</p>
                        <p class="text-xs text-slate-400 mt-1">Anda akan mendapat pemberitahuan saat status laporan diperbarui.</p>
                        <a href="{{ route('laporan.create') }}" class="inline-flex items-center gap-2 mt-6 px-5 py-2.5 bg-brand-900 text-white rounded-lg text-sm font-semibold hover:bg-slate-800 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">add</span> Buat Laporan Baru
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white/95 backdrop-blur-xl border-t border-slate-200 z-50 px-2 sm:px-6 py-1.5 flex justify-around items-center pb-[calc(0.5rem+env(safe-area-inset-bottom))] shadow-[0_-4px_20px_-5px_rgba(0,0,0,0.05)]">
        <a href="{{ route('dashboarduser.index') }}" class="flex flex-col items-center text-slate-400 hover:text-brand-900 transition-colors w-16 pt-2">
            <span class="material-symbols-outlined text-[24px]">dashboard</span>
            <span class="text-[10px] font-medium mt-1 tracking-wide">Beranda</span>
        </a>
        <a href="{{ route('dashboarduser.laporan') }}" class="flex flex-col items-center text-slate-400 hover:text-brand-900 transition-colors w-16 pt-2">
            <span class="material-symbols-outlined text-[24px]">assignment</span>
            <span class="text-[10px] font-medium mt-1 tracking-wide">Riwayat</span>
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
        // Notification Toggle Logic
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
        });
    </script>

</body>
</html>
