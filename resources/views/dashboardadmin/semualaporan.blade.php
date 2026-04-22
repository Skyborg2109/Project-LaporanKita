<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Semua Laporan - LaporanKita Admin</title>
    
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
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .sidebar-transition { transition: transform 0.3s ease-in-out; }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex h-screen overflow-hidden selection:bg-brand-500 selection:text-white">

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 z-30 hidden md:hidden backdrop-blur-sm transition-opacity opacity-0" onclick="toggleSidebar()"></div>

    <!-- ==================== SIDEBAR ==================== -->
    <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-brand-900 text-white flex flex-col h-full z-40 sidebar-transition -translate-x-full md:translate-x-0 shrink-0 shadow-2xl md:shadow-none">
        <div class="h-16 flex items-center px-6 border-b border-slate-700/50 shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="bg-brand-500 text-white p-1.5 rounded flex items-center justify-center">
                    <span class="material-symbols-outlined icon-filled text-[18px]">maps_ugc</span>
                </div>
                <span class="text-lg font-bold tracking-tight text-white">Laporan<span class="text-brand-400">Kita</span></span>
                <span class="ml-2 px-1.5 py-0.5 rounded text-[9px] font-bold bg-rose-500 text-white uppercase tracking-wider">Admin</span>
            </div>
            <button class="md:hidden ml-auto p-1 text-slate-400 hover:text-white rounded" onclick="toggleSidebar()">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5">
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 mb-3">Menu Manajemen</div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400 transition-colors">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-3 py-2.5 bg-brand-800 text-white rounded-lg font-semibold text-sm transition-colors border border-brand-700 shadow-inner">
                <span class="material-symbols-outlined icon-filled text-[20px] text-brand-400">list_alt</span>
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
            
            <h2 class="font-bold text-brand-900 text-lg hidden sm:block">Semua Laporan</h2>
            
            <div class="flex items-center gap-4 ml-auto">
                <!-- Search bar -->
                <div class="relative hidden lg:block w-64">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">search</span>
                    <input type="text" placeholder="Cari ID Laporan..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all" />
                </div>
                
                <!-- Notification Dropdown -->
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
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 custom-scrollbar relative">
            <div class="max-w-7xl mx-auto space-y-6">
                
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-200">
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">No. ID</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Nama User</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Judul Laporan</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($laporans as $laporan)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-xs font-mono text-slate-500">#LPK-{{ $laporan->id }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            @if($laporan->user->foto_profil)
                                                <img src="{{ str_starts_with($laporan->user->foto_profil, 'http') ? $laporan->user->foto_profil : Storage::url($laporan->user->foto_profil) }}" class="w-6 h-6 rounded-full border border-slate-200 object-cover" />
                                            @else
                                                <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-600">
                                                    {{ strtoupper(substr($laporan->user->name, 0, 2)) }}
                                                </div>
                                            @endif
                                            <span class="text-sm font-semibold text-brand-900">{{ $laporan->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700 max-w-[300px] truncate">
                                        {{ $laporan->judul }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-slate-700">{{ $laporan->created_at->format('d M Y') }}</p>
                                        <p class="text-[10px] text-slate-400">{{ $laporan->created_at->format('H:i') }} WITA</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded bg-slate-50 border border-slate-200 text-[10px] font-bold uppercase tracking-wider @if($laporan->status === 'baru') text-rose-600 bg-rose-50 border-rose-100 @elseif($laporan->status === 'diproses') text-amber-600 bg-amber-50 border-amber-100 @else text-emerald-600 bg-emerald-50 border-emerald-100 @endif">
                                            <span class="w-1.5 h-1.5 rounded-full @if($laporan->status === 'baru') bg-rose-500 animate-pulse @elseif($laporan->status === 'diproses') bg-amber-500 @else bg-emerald-500 @endif"></span> 
                                            {{ $laporan->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="p-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition-all inline-flex items-center">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                        {{ $laporans->links() }}
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
             // Notification Toggle Logic
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
    </script>
</body>
</html>
