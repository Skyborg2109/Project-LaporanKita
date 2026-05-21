<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Manajemen User - LaporanKita Admin</title>
    
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
            <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400 transition-colors">list_alt</span>
                Semua Laporan
            </a>
            <a href="{{ route('admin.filter') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400 transition-colors">filter_alt</span>
                Filter Laporan
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2.5 bg-brand-800 text-white rounded-lg font-semibold text-sm transition-colors border border-brand-700 shadow-inner">
                <span class="material-symbols-outlined icon-filled text-[20px] text-brand-400">group</span>
                Manajemen User
            </a>
            <a href="{{ route('admin.naivebayes') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400 transition-colors">model_training</span>
                Naive Bayes
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
            
            <h2 class="font-bold text-brand-900 text-lg hidden sm:block">Manajemen User</h2>
            
            <div class="flex items-center gap-4 ml-auto">
                <a href="{{ route('admin.profil') }}" class="p-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-full transition-all">
                    <span class="material-symbols-outlined text-[24px]">account_circle</span>
                </a>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 custom-scrollbar relative">
            <div class="max-w-7xl mx-auto space-y-6">

                @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg p-4 flex gap-3 shadow-sm mb-4">
                    <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
                @endif
                
                @if(session('error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-lg p-4 flex gap-3 shadow-sm mb-4">
                    <span class="material-symbols-outlined text-rose-600">error</span>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
                @endif

                <!-- Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-center">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center">
                                <span class="material-symbols-outlined icon-filled">group</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Total User</h3>
                        </div>
                        <p class="text-3xl font-black text-brand-900 ml-13 pl-13">{{ $totalUsers }}</p>
                    </div>
                    
                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-center">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center">
                                <span class="material-symbols-outlined icon-filled">admin_panel_settings</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Admin</h3>
                        </div>
                        <p class="text-3xl font-black text-brand-900 ml-13 pl-13">{{ $totalAdmin }}</p>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-center">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                                <span class="material-symbols-outlined icon-filled">person</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Regular User</h3>
                        </div>
                        <p class="text-3xl font-black text-brand-900 ml-13 pl-13">{{ $totalRegular }}</p>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-center">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                <span class="material-symbols-outlined icon-filled">person_add</span>
                            </div>
                            <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Bulan Ini</h3>
                        </div>
                        <p class="text-3xl font-black text-brand-900 ml-13 pl-13">+{{ $newThisMonth }}</p>
                    </div>
                </div>

                <!-- Filters -->
                <form action="{{ route('admin.users') }}" method="GET" class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row gap-4 items-end">
                    <div class="w-full sm:flex-1">
                        <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wider">Cari Nama/Email</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">search</span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik kata kunci..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all">
                        </div>
                    </div>
                    <div class="w-full sm:w-48">
                        <label class="block text-xs font-bold text-slate-500 mb-1.5 uppercase tracking-wider">Role</label>
                        <select name="role" class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg font-semibold text-sm transition-colors shadow-sm flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">filter_list</span>
                        Filter
                    </button>
                    @if(request()->hasAny(['search', 'role']))
                        <a href="{{ route('admin.users') }}" class="w-full sm:w-auto px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg font-medium text-sm transition-colors text-center">Reset</a>
                    @endif
                </form>
                
                <!-- Data Table -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-200">
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Kontak</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-center">Role</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-center">Status</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-center">Laporan</th>
                                    <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($users as $u)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if($u->foto_profil)
                                                <img src="{{ str_starts_with($u->foto_profil, 'http') ? $u->foto_profil : Storage::url($u->foto_profil) }}" class="w-9 h-9 rounded-full border border-slate-200 object-cover" />
                                            @else
                                                <div class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">
                                                    {{ strtoupper(substr($u->name, 0, 2)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <p class="text-sm font-bold text-slate-900">{{ $u->name }}</p>
                                                <p class="text-xs text-slate-500">Terdaftar {{ $u->created_at->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-slate-700">{{ $u->email }}</p>
                                        <p class="text-xs text-slate-500">{{ $u->telepon ?? '-' }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider {{ $u->role === 'admin' ? 'bg-rose-100 text-rose-700' : 'bg-slate-100 text-slate-600' }}">
                                            {{ $u->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider {{ $u->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                            {{ $u->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-brand-50 text-brand-600 text-xs font-bold">
                                            {{ $u->laporans_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.users.show', $u->id) }}" title="Detail User" class="p-1.5 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition-colors">
                                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                                            </a>
                                            
                                            @if($u->id !== Auth::id())
                                            <!-- Ubah Status -->
                                            <form action="{{ route('admin.users.status', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin {{ $u->is_active ? 'menonaktifkan' : 'mengaktifkan' }} akun ini?');">
                                                @csrf @method('PATCH')
                                                <button type="submit" title="{{ $u->is_active ? 'Nonaktifkan' : 'Aktifkan' }}" class="p-1.5 {{ $u->is_active ? 'text-slate-400 hover:text-amber-600 hover:bg-amber-50' : 'text-slate-400 hover:text-emerald-600 hover:bg-emerald-50' }} rounded-lg transition-colors">
                                                    <span class="material-symbols-outlined text-[20px]">{{ $u->is_active ? 'block' : 'check_circle' }}</span>
                                                </button>
                                            </form>

                                            <!-- Hapus Akun -->
                                            <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda sangat yakin ingin menghapus akun ini secara permanen? Seluruh data laporan dari akun ini mungkin juga akan terpengaruh atau dihapus tergantung aturan relasi database.');">
                                                @csrf @method('DELETE')
                                                <button type="submit" title="Hapus Permanen" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-[32px] text-slate-300">group_off</span>
                                            </div>
                                            <p class="text-slate-500 font-medium">Tidak ada data user yang ditemukan.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($users->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                        {{ $users->links() }}
                    </div>
                    @endif
                </div>

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
    </script>
</body>
</html>
