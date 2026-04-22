<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Pengaturan Akun Admin - LaporanKita</title>
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
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        .sidebar-transition { transition: transform 0.3s ease-in-out; }
        .input-focus { transition: border-color 0.2s, box-shadow 0.2s; }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex h-screen overflow-hidden selection:bg-brand-500 selection:text-white">

    @php $activeTab = session('tab', 'pegawai'); @endphp

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 z-30 hidden md:hidden backdrop-blur-sm transition-opacity opacity-0" onclick="toggleSidebar()"></div>

    <!-- SIDEBAR ADMIN -->
    <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-64 bg-brand-900 text-white flex flex-col h-full z-40 sidebar-transition -translate-x-full md:translate-x-0 shrink-0 shadow-2xl md:shadow-none">
        <div class="h-16 flex items-center px-6 border-b border-slate-700/50 shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="bg-brand-500 text-white p-1.5 rounded flex items-center justify-center">
                    <span class="material-symbols-outlined icon-filled text-[18px]">maps_ugc</span>
                </div>
                <span class="text-lg font-bold tracking-tight text-white">Laporan<span class="text-teal-400">Kita</span></span>
                <span class="ml-1 px-1.5 py-0.5 rounded text-[9px] font-bold bg-rose-500 text-white uppercase tracking-wider">Admin</span>
            </div>
            <button class="md:hidden ml-auto p-1 text-slate-400 hover:text-white rounded" onclick="toggleSidebar()">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5 custom-scrollbar">
            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 mb-3">Menu Manajemen</div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-teal-400">dashboard</span>Dashboard
            </a>
            <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-teal-400">list_alt</span>Semua Laporan
            </a>
            <a href="{{ route('admin.filter') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-300 hover:bg-slate-800 hover:text-white rounded-lg font-medium text-sm transition-colors group">
                <span class="material-symbols-outlined text-[20px] group-hover:text-teal-400">filter_alt</span>Filter Laporan
            </a>
            <div class="mt-6 pt-4 border-t border-slate-700/50">
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 mb-3">Pengaturan</div>
                <a href="{{ route('admin.profil') }}" class="flex items-center gap-3 px-3 py-2.5 bg-slate-800 text-white rounded-lg font-semibold text-sm border border-slate-700">
                    <span class="material-symbols-outlined icon-filled text-[20px] text-teal-400">admin_panel_settings</span>Akun & Keamanan
                </a>
            </div>
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

    <!-- MAIN -->
    <main class="flex-1 flex flex-col h-full w-full overflow-hidden relative">

        <!-- Topbar Header -->
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-8 shrink-0 shadow-sm z-30">
            <!-- Mobile Menu Toggle -->
            <button class="md:hidden p-2 -ml-2 text-slate-500 hover:bg-slate-50 rounded-md" onclick="toggleSidebar()">
                <span class="material-symbols-outlined">menu</span>
            </button>
            
            <h2 class="font-bold text-brand-900 text-lg hidden sm:block">Pengaturan Profil</h2>
            
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

        <!-- Content -->
        <div class="flex-1 overflow-y-auto custom-scrollbar bg-[#FAFAFA]">
            <div class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 space-y-6 min-h-full">

                @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-2 text-sm">
                    <span class="material-symbols-outlined">check_circle</span>{{ session('success') }}
                </div>
                @endif

                <!-- Profile Banner -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden relative">
                    <div class="absolute inset-0 h-24 bg-brand-900 z-0"></div>
                    <div class="p-6 relative z-10 flex flex-col sm:flex-row items-center sm:items-end gap-6 pt-12">
                        <div class="relative shrink-0">
                            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" id="avatar-form">
                                @csrf
                                @if($admin->foto_profil)
                                    <img id="admin-avatar" src="{{ str_starts_with($admin->foto_profil, 'http') ? $admin->foto_profil : Storage::url($admin->foto_profil) }}" alt="Admin Avatar" class="w-24 h-24 sm:w-28 sm:h-28 rounded-xl border-4 border-white shadow-lg object-cover bg-white" />
                                @else
                                    <img id="admin-avatar" src="https://ui-avatars.com/api/?name={{ urlencode($admin->name) }}&background=f1f5f9&color=0f172a&size=128" alt="Admin Avatar" class="w-24 h-24 sm:w-28 sm:h-28 rounded-xl border-4 border-white shadow-lg object-cover bg-white" />
                                @endif
                                <label for="avatar-input" class="absolute -bottom-2 -right-2 w-8 h-8 bg-white text-slate-600 rounded-full flex items-center justify-center hover:text-brand-600 transition-colors shadow-md border border-slate-200 cursor-pointer">
                                    <span class="material-symbols-outlined text-[16px]">edit</span>
                                </label>
                                <input type="file" id="avatar-input" name="foto_profil" accept="image/*" class="hidden" onchange="this.form.submit()" />
                            </form>
                        </div>
                        <div class="text-center sm:text-left flex-1">
                            <h1 class="text-2xl font-extrabold text-slate-900 mb-1">{{ $admin->name }}</h1>
                            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 mb-2">
                                @if($admin->nip)
                                <p class="text-sm text-slate-500 font-medium">NIP: {{ $admin->nip }}</p>
                                <span class="hidden sm:inline text-slate-300">•</span>
                                @endif
                                @if($admin->instansi)
                                <p class="text-sm text-slate-500 font-medium">{{ $admin->instansi }}</p>
                                @endif
                            </div>
                            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-brand-50 border border-brand-100 text-brand-700 rounded-md">
                                <span class="material-symbols-outlined icon-filled text-[14px]">shield_person</span>
                                <span class="text-[10px] font-bold uppercase tracking-wider">Super Admin</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

                    <!-- LEFT STATS -->
                    <div class="lg:col-span-4 space-y-6">
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px] text-slate-400">monitoring</span>Info Sesi
                            </h3>
                            <ul class="space-y-4 divide-y divide-slate-100">
                                <li class="pt-2 flex justify-between items-center">
                                    <span class="text-xs text-slate-500">Email</span>
                                    <span class="text-xs font-semibold text-slate-800 truncate max-w-[150px]">{{ $admin->email }}</span>
                                </li>
                                <li class="pt-3 flex justify-between items-center">
                                    <span class="text-xs text-slate-500">Telepon</span>
                                    <span class="text-xs font-semibold text-slate-800">{{ $admin->telepon ?? '-' }}</span>
                                </li>
                                <li class="pt-3 flex justify-between items-center">
                                    <span class="text-xs text-slate-500">Bergabung</span>
                                    <span class="text-xs font-semibold text-slate-800">{{ $admin->created_at->format('d M Y') }}</span>
                                </li>
                                <li class="pt-3 flex justify-between items-center">
                                    <span class="text-xs text-slate-500">Role</span>
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-brand-700 uppercase bg-brand-50 px-2 py-0.5 rounded-full border border-brand-100">
                                        {{ ucfirst($admin->role) }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- RIGHT TABS -->
                    <div class="lg:col-span-8">
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden min-h-[420px]">

                            <!-- Tab Buttons -->
                            <div class="flex border-b border-slate-100 bg-slate-50/50 px-2 pt-2 overflow-x-auto">
                                <button id="btn-tab-pegawai" onclick="switchTab('pegawai')" class="{{ $activeTab !== 'keamanan' ? 'text-brand-600 border-brand-600' : 'text-slate-500 border-transparent hover:text-slate-700' }} px-5 py-3.5 text-sm font-bold border-b-2 flex items-center gap-2 whitespace-nowrap transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">badge</span>Data Pegawai
                                </button>
                                <button id="btn-tab-keamanan" onclick="switchTab('keamanan')" class="{{ $activeTab === 'keamanan' ? 'text-brand-600 border-brand-600' : 'text-slate-500 border-transparent hover:text-slate-700' }} px-5 py-3.5 text-sm font-bold border-b-2 flex items-center gap-2 whitespace-nowrap transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">security</span>Keamanan Sandi
                                </button>
                            </div>

                            <!-- TAB: Data Pegawai -->
                            <form id="form-pegawai" action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data" class="{{ $activeTab === 'keamanan' ? 'hidden' : '' }} p-6 sm:p-8 space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div class="sm:col-span-2">
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">NIP</label>
                                        <div class="relative flex items-center">
                                            <span class="material-symbols-outlined absolute left-3.5 text-slate-400 text-[20px]">pin</span>
                                            <input type="text" name="nip" value="{{ old('nip', $admin->nip) }}" placeholder="Nomor Induk Pegawai" class="w-full pl-10 pr-4 py-3 bg-white border @error('nip') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus font-medium" />
                                        </div>
                                        @error('nip') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                                        <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="w-full px-4 py-3 bg-white border @error('name') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus font-medium" required />
                                        @error('name') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Instansi / Dinas</label>
                                        <input type="text" name="instansi" value="{{ old('instansi', $admin->instansi) }}" placeholder="Dinas/Instansi Anda" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus font-medium" />
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Email Kedinasan</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">alternate_email</span>
                                            <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="w-full pl-10 pr-4 py-3 bg-white border @error('email') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus font-medium" required />
                                        </div>
                                        @error('email') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">No. Telepon</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">call</span>
                                            <input type="tel" name="telepon" value="{{ old('telepon', $admin->telepon) }}" class="w-full pl-10 pr-4 py-3 bg-white border @error('telepon') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus font-medium" />
                                        </div>
                                        @error('telepon') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-slate-100 flex justify-end">
                                    <button type="submit" class="px-8 py-3 bg-brand-900 text-white rounded-lg text-sm font-semibold hover:bg-slate-800 shadow-md hover:shadow-lg transition-all active:scale-[0.98] flex items-center gap-2">
                                        Simpan Profil <span class="material-symbols-outlined text-[18px]">save</span>
                                    </button>
                                </div>
                            </form>

                            <!-- TAB: Keamanan -->
                            <form id="form-keamanan" action="{{ route('admin.profil.password') }}" method="POST" class="{{ $activeTab === 'keamanan' ? '' : 'hidden' }} p-6 sm:p-8 space-y-6">
                                @csrf
                                <div class="space-y-4 max-w-md">
                                    <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Ubah Kata Sandi Akses</h4>
                                    <div>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                                            <input type="password" name="current_password" placeholder="Kata Sandi Lama" class="w-full pl-10 pr-4 py-3 bg-white border @error('current_password') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus" required />
                                        </div>
                                        @error('current_password') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">key</span>
                                            <input type="password" name="password" placeholder="Kata Sandi Baru (Min. 8 Karakter)" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus" required minlength="8"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">key</span>
                                            <input type="password" name="password_confirmation" placeholder="Ulangi Kata Sandi Baru" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-slate-100 flex justify-end">
                                    <button type="submit" class="px-8 py-3 bg-brand-900 text-white rounded-lg text-sm font-semibold hover:bg-slate-800 shadow-md hover:shadow-lg transition-all active:scale-[0.98] flex items-center gap-2">
                                        Perbarui Sandi <span class="material-symbols-outlined text-[18px]">lock_reset</span>
                                    </button>
                                </div>
                            </form>
                        </div>
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

        function switchTab(tabName) {
            const forms = ['pegawai', 'keamanan'];
            const activeClass = 'text-brand-600 border-brand-600';
            const inactiveClass = 'text-slate-500 border-transparent hover:text-slate-700';

            forms.forEach(t => {
                const form = document.getElementById('form-' + t);
                const btn = document.getElementById('btn-tab-' + t);
                if (t === tabName) {
                    form.classList.remove('hidden');
                    btn.className = `px-5 py-3.5 text-sm font-bold border-b-2 flex items-center gap-2 whitespace-nowrap transition-colors ${activeClass}`;
                } else {
                    form.classList.add('hidden');
                    btn.className = `px-5 py-3.5 text-sm font-bold border-b-2 flex items-center gap-2 whitespace-nowrap transition-colors ${inactiveClass}`;
                }
            });
        }

        @if(session('tab') === 'keamanan')
        switchTab('keamanan');
        @endif
    </script>
</body>
</html>