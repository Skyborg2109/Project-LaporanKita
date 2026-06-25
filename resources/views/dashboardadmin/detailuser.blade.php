<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Detail User - LaporanKita Admin</title>
    
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
            <a href="{{ route('admin.kategori.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-400 transition-colors">category</span> Manajemen Kategori
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2.5 bg-brand-800 text-white rounded-lg font-semibold text-sm transition-colors border border-brand-700 shadow-inner">
                <span class="material-symbols-outlined icon-filled text-[20px] text-brand-400">group</span>
                Manajemen User
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
        <header class="h-16 bg-white border-b border-slate-200 flex items-center px-4 sm:px-8 shrink-0 shadow-sm z-30">
            <!-- Mobile Menu Toggle -->
            <button class="md:hidden p-2 -ml-2 mr-2 text-slate-500 hover:bg-slate-50 rounded-md" onclick="toggleSidebar()">
                <span class="material-symbols-outlined">menu</span>
            </button>
            
            <a href="{{ route('admin.users') }}" class="p-2 -ml-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-full transition-all mr-2 flex items-center justify-center">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            </a>
            
            <h2 class="font-bold text-brand-900 text-lg">Detail User</h2>
            
            <div class="flex items-center gap-4 ml-auto">
                <a href="{{ route('admin.profil') }}" class="p-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-full transition-all">
                    <span class="material-symbols-outlined text-[24px]">account_circle</span>
                </a>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 custom-scrollbar relative">
            <div class="max-w-5xl mx-auto space-y-6">

                @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg p-4 flex gap-3 shadow-sm">
                    <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
                @endif
                
                @if(session('error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-lg p-4 flex gap-3 shadow-sm">
                    <span class="material-symbols-outlined text-rose-600">error</span>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Kolom Kiri: Info Profil & Aksi -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Card Profil User -->
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                            <div class="h-24 bg-gradient-to-r from-brand-600 to-brand-400 relative"></div>
                            <div class="px-6 pb-6 pt-0 relative flex flex-col items-center -mt-12 text-center">
                                <div class="w-24 h-24 rounded-full border-4 border-white bg-white shadow-sm overflow-hidden mb-4">
                                    @if($user->foto_profil)
                                        <img src="{{ str_starts_with($user->foto_profil, 'http') ? $user->foto_profil : Storage::url($user->foto_profil) }}" class="w-full h-full object-cover" />
                                    @else
                                        <div class="w-full h-full bg-slate-200 flex items-center justify-center text-2xl font-bold text-slate-600">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </div>
                                <h3 class="font-bold text-lg text-brand-900 mb-1">{{ $user->name }}</h3>
                                <div class="flex flex-wrap justify-center gap-2 mb-4">
                                    <span class="inline-flex px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider {{ $user->role === 'admin' ? 'bg-rose-100 text-rose-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $user->role }}
                                    </span>
                                    <span class="inline-flex px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider {{ $user->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                    @if($user->is_verified)
                                    <span class="inline-flex px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wider bg-blue-100 text-blue-700" title="Email Terverifikasi">
                                        <span class="material-symbols-outlined text-[12px] mr-1">verified</span> Verified
                                    </span>
                                    @endif
                                </div>
                                
                                <div class="w-full pt-4 border-t border-slate-100 grid grid-cols-2 gap-4 divide-x divide-slate-100">
                                    <div>
                                        <p class="text-xs text-slate-400 font-medium mb-1">Total Laporan</p>
                                        <p class="text-xl font-black text-brand-600">{{ $user->laporans_count }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-400 font-medium mb-1">Terdaftar</p>
                                        <p class="text-sm font-bold text-slate-700 mt-1.5">{{ $user->created_at->format('M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Aksi Admin -->
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px] text-brand-500">settings</span>
                                Aksi Administrator
                            </h3>
                            
                            @if($user->id !== Auth::id())
                            <div class="space-y-4">
                                <!-- Ubah Role -->
                                <form action="{{ route('admin.users.role', $user->id) }}" method="POST" class="p-4 bg-slate-50 border border-slate-200 rounded-xl space-y-3">
                                    @csrf @method('PATCH')
                                    <label class="block text-xs font-bold text-slate-700">Ubah Role Akun</label>
                                    <div class="flex gap-2">
                                        <select name="role" class="flex-1 px-3 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20">
                                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        <button type="submit" class="px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg text-sm font-medium transition-colors">
                                            Simpan
                                        </button>
                                    </div>
                                </form>

                                <!-- Toggle Status -->
                                <form action="{{ route('admin.users.status', $user->id) }}" method="POST" class="p-4 border rounded-xl flex items-center justify-between gap-4 {{ $user->is_active ? 'border-amber-200 bg-amber-50' : 'border-emerald-200 bg-emerald-50' }}" onsubmit="return confirm('Apakah Anda yakin?');">
                                    @csrf @method('PATCH')
                                    <div>
                                        <h4 class="text-xs font-bold {{ $user->is_active ? 'text-amber-800' : 'text-emerald-800' }}">Status Akun</h4>
                                        <p class="text-[11px] {{ $user->is_active ? 'text-amber-600' : 'text-emerald-600' }} mt-0.5">
                                            {{ $user->is_active ? 'Tangguhkan akses login user' : 'Pulihkan akses login user' }}
                                        </p>
                                    </div>
                                    <button type="submit" class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors {{ $user->is_active ? 'bg-amber-100 text-amber-700 hover:bg-amber-200' : 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' }}">
                                        {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>

                                <!-- Delete -->
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="p-4 border border-rose-200 bg-rose-50 rounded-xl flex items-center justify-between gap-4" onsubmit="return confirm('Apakah Anda sangat yakin? Tindakan ini tidak bisa dibatalkan.');">
                                    @csrf @method('DELETE')
                                    <div>
                                        <h4 class="text-xs font-bold text-rose-800">Hapus Akun</h4>
                                        <p class="text-[11px] text-rose-600 mt-0.5">Hapus permanen dari database</p>
                                    </div>
                                    <button type="submit" class="px-3 py-1.5 rounded-md text-xs font-bold transition-colors bg-rose-100 text-rose-700 hover:bg-rose-200">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                            @else
                            <div class="p-4 bg-brand-50 border border-brand-200 rounded-xl text-center">
                                <span class="material-symbols-outlined text-brand-500 text-[32px] mb-2">admin_panel_settings</span>
                                <p class="text-sm font-medium text-brand-800">Ini adalah akun Anda. Pengaturan hanya dapat dilakukan di menu Profil.</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Kolom Kanan: Detail & Riwayat Laporan -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Card Informasi Detail (Edit Form) -->
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <h3 class="text-sm font-bold text-slate-900 mb-6 flex items-center justify-between">
                                <span class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[20px] text-brand-500">contact_page</span>
                                    Edit Informasi Lengkap
                                </span>
                            </h3>
                            
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-5 gap-x-6">
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all" required>
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Email</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all" required>
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">No. Telepon / WhatsApp</label>
                                        <input type="text" name="telepon" value="{{ old('telepon', $user->telepon) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">NIK</label>
                                        <input type="text" name="nik" value="{{ old('nik', $user->nik) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">NIP (Pegawai)</label>
                                        <input type="text" name="nip" value="{{ old('nip', $user->nip) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Instansi</label>
                                        <input type="text" name="instansi" value="{{ old('instansi', $user->instansi) }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5">Alamat Lengkap</label>
                                        <textarea name="alamat" rows="3" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:bg-white transition-all custom-scrollbar">{{ old('alamat', $user->alamat) }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="mt-6 flex justify-end">
                                    <button type="submit" class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white rounded-lg text-sm font-semibold shadow-sm transition-colors flex items-center gap-2">
                                        Simpan Perubahan <span class="material-symbols-outlined text-[18px]">save</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Card Riwayat Laporan -->
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px] text-brand-500">history</span>
                                Riwayat Laporan Terakhir
                            </h3>

                            <div class="space-y-4">
                                @forelse($laporans as $laporan)
                                <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="block p-4 border border-slate-100 rounded-xl hover:border-brand-300 hover:shadow-md hover:-translate-y-0.5 transition-all group bg-slate-50/50 hover:bg-white">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-2">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-mono font-bold text-brand-600">#LPK-{{ $laporan->id }}</span>
                                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                            <span class="text-xs text-slate-500 font-medium">{{ $laporan->created_at->format('d M Y') }}</span>
                                        </div>
                                        <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider @if($laporan->status === 'baru') text-rose-600 bg-rose-50 border border-rose-100 @elseif($laporan->status === 'diproses') text-amber-600 bg-amber-50 border border-amber-100 @else text-emerald-600 bg-emerald-50 border border-emerald-100 @endif">
                                            {{ $laporan->status }}
                                        </span>
                                    </div>
                                    <h4 class="font-bold text-slate-900 text-sm group-hover:text-brand-600 transition-colors line-clamp-1 mb-1">{{ $laporan->judul }}</h4>
                                    <p class="text-xs text-slate-500 line-clamp-2">{{ Str::limit(strip_tags($laporan->deskripsi), 100) }}</p>
                                </a>
                                @empty
                                <div class="text-center py-8 border-2 border-dashed border-slate-200 rounded-xl bg-slate-50">
                                    <span class="material-symbols-outlined text-slate-300 text-[40px] mb-2">inbox</span>
                                    <p class="text-sm font-medium text-slate-500">Belum ada laporan yang dibuat.</p>
                                </div>
                                @endforelse
                            </div>

                            @if($laporans->hasPages())
                            <div class="mt-6">
                                {{ $laporans->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
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
