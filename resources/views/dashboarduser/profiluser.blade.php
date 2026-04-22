<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Profil Saya - LaporanKita</title>
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
        .input-focus { transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out; }
        @keyframes slideInRight { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes fadeOut { from { opacity: 1; } to { opacity: 0; } }
        .toast-enter { animation: slideInRight 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards; }
        .toast-leave { animation: fadeOut 0.3s ease-out forwards; }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex h-screen overflow-hidden selection:bg-brand-500 selection:text-white">

    @php $activeTab = session('tab', 'pribadi'); @endphp

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

            <a href="{{ route('dashboarduser.notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-brand-900 rounded-lg font-medium text-sm transition-colors group relative">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-600 transition-colors">notifications</span>
                Notifikasi
                @if(isset($unreadCount) && $unreadCount > 0)
                <span class="ml-auto bg-rose-500 text-white text-[10px] font-bold rounded-full px-1.5 py-0.5 min-w-[20px] text-center">{{ $unreadCount }}</span>
                @endif
            </a>

            <a href="{{ route('dashboarduser.profil') }}" class="flex items-center gap-3 px-3 py-2.5 bg-brand-50 text-brand-900 rounded-lg font-semibold text-sm transition-colors">
                <span class="material-symbols-outlined icon-filled text-[20px] text-brand-600">manage_accounts</span>
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
    <main class="flex-1 flex flex-col h-full w-full overflow-hidden relative pb-[72px] md:pb-0">

        <!-- Mobile Header -->
        <header class="md:hidden bg-white/90 backdrop-blur-md h-16 border-b border-slate-200 flex items-center justify-between px-4 sticky top-0 z-20">
            <div class="flex items-center gap-2">
                <div class="bg-brand-900 text-white p-1 rounded flex items-center justify-center">
                    <span class="material-symbols-outlined icon-filled text-[16px]">maps_ugc</span>
                </div>
                <span class="text-lg font-bold tracking-tight text-brand-900">Profil Saya</span>
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
                <div class="relative" id="notif-wrapper">
                    <button id="notif-toggle" class="p-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined text-[24px]">notifications</span>
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
                        <div class="max-h-[350px] overflow-y-auto">
                            @if(isset($unreadNotifications) && $unreadNotifications->count() > 0)
                                @foreach($unreadNotifications->take(5) as $notif)
                                <a href="{{ route('laporan.show', $notif->data['laporan_id']) }}" class="p-4 hover:bg-slate-50 transition-colors border-b border-slate-50 group block">
                                    <div class="flex gap-3">
                                        <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                                            <span class="material-symbols-outlined text-[18px]">@if(($notif->data['type'] ?? '') === 'status') rule @else assignment_late @endif</span>
                                        </div>
                                        <div class="flex-grow min-w-0">
                                            <p class="text-xs text-slate-900 font-bold leading-snug group-hover:text-brand-900 transition-colors">
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
                        <p class="text-xs font-bold text-slate-900 leading-tight">{{ $user->name }}</p>
                        <p class="text-[10px] {{ $user->is_verified ? 'text-emerald-600' : 'text-slate-400' }} font-bold uppercase tracking-tighter">
                            {{ $user->is_verified ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                        </p>
                    </div>
                    @if($user->foto_profil)
                        <img src="{{ str_starts_with($user->foto_profil, 'http') ? $user->foto_profil : Storage::url($user->foto_profil) }}" alt="Avatar" class="w-9 h-9 rounded-full border border-slate-200 object-cover" />
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f1f5f9&color=0f172a" alt="Avatar" class="w-9 h-9 rounded-full border border-slate-200" />
                    @endif
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 no-scrollbar">

            @if(session('success'))
            <div class="max-w-5xl mx-auto mb-4">
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-2 text-sm">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            <div class="max-w-5xl mx-auto w-full">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                    <!-- LEFT: PROFILE CARD -->
                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden text-center p-6 relative">
                            <div class="absolute top-0 left-0 right-0 h-24 bg-slate-50 border-b border-slate-100 z-0"></div>

                                <div class="relative w-24 h-24 mx-auto mb-4 z-10">
                                    @if($user->foto_profil)
                                        <img id="avatar-preview" src="{{ str_starts_with($user->foto_profil, 'http') ? $user->foto_profil : Storage::url($user->foto_profil) }}" alt="Avatar" class="w-full h-full rounded-full border-4 border-white shadow-md object-cover" />
                                    @else
                                        <img id="avatar-preview" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f1f5f9&color=0f172a&size=128" alt="Avatar" class="w-full h-full rounded-full border-4 border-white shadow-md object-cover" />
                                    @endif
                                    <label for="foto_profil_input" class="absolute bottom-0 right-0 w-8 h-8 bg-brand-900 text-white rounded-full flex items-center justify-center hover:bg-slate-800 transition-colors shadow-sm border-2 border-white cursor-pointer z-20" title="Ubah Foto">
                                        <span class="material-symbols-outlined text-[16px]">photo_camera</span>
                                    </label>
                                </div>

                            <h2 class="text-xl font-extrabold text-brand-900 mb-1 relative z-10">{{ $user->name }}</h2>
                            <p class="text-sm text-slate-500 font-medium mb-3 relative z-10">{{ $user->email }}</p>

                            @if($user->is_verified)
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-full shadow-sm mb-6 relative z-10">
                                <span class="material-symbols-outlined icon-filled text-[14px]">verified</span>
                                <span class="text-xs font-bold uppercase tracking-wider">Warga Terverifikasi</span>
                            </div>
                            @else
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 border border-rose-100 text-rose-700 rounded-full shadow-sm mb-6 relative z-10">
                                <span class="material-symbols-outlined text-[14px]">report</span>
                                <span class="text-xs font-bold uppercase tracking-wider">Belum Terverifikasi</span>
                            </div>
                            <div class="bg-slate-50 rounded-lg p-3 mb-6 relative z-10 border border-slate-100 text-left">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Lengkapi Data Berikut:</p>
                                <ul class="space-y-1">
                                    <li class="flex items-center gap-2 text-[11px] {{ $user->nik ? 'text-emerald-600' : 'text-slate-400' }}">
                                        <span class="material-symbols-outlined text-[14px]">{{ $user->nik ? 'check_circle' : 'circle' }}</span> NIK Kependudukan
                                    </li>
                                    <li class="flex items-center gap-2 text-[11px] {{ $user->telepon ? 'text-emerald-600' : 'text-slate-400' }}">
                                        <span class="material-symbols-outlined text-[14px]">{{ $user->telepon ? 'check_circle' : 'circle' }}</span> Nomor WhatsApp
                                    </li>
                                    <li class="flex items-center gap-2 text-[11px] {{ $user->alamat ? 'text-emerald-600' : 'text-slate-400' }}">
                                        <span class="material-symbols-outlined text-[14px]">{{ $user->alamat ? 'check_circle' : 'circle' }}</span> Alamat Domisili
                                    </li>
                                </ul>
                            </div>
                            @endif

                            <div class="grid grid-cols-2 gap-4 border-t border-slate-100 pt-5">
                                <div>
                                    <p class="text-2xl font-bold text-brand-900 mb-0.5">{{ $totalLaporan }}</p>
                                    <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest">Laporan</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-brand-900 mb-0.5">{{ $user->created_at->year }}</p>
                                    <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest">Bergabung</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 text-center">
                            <span class="material-symbols-outlined text-slate-300 text-[32px] mb-2">history</span>
                            <p class="text-xs text-slate-500 font-medium">Bergabung sejak <strong class="text-slate-700">{{ $user->created_at->translatedFormat('F Y') }}</strong></p>
                        </div>
                    </div>

                    <!-- RIGHT: SETTINGS TABS -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                            <!-- Tab Headers -->
                            <div class="flex border-b border-slate-100 bg-slate-50/50 px-4 pt-4 overflow-x-auto no-scrollbar">
                                <button id="btn-tab-pribadi" onclick="switchTab('pribadi')" class="{{ $activeTab === 'pribadi' ? 'text-brand-600 border-brand-600' : 'text-slate-500 border-transparent hover:text-slate-700' }} px-5 py-3 text-sm font-bold border-b-2 whitespace-nowrap transition-colors">
                                    Data Pribadi
                                </button>
                                <button id="btn-tab-keamanan" onclick="switchTab('keamanan')" class="{{ $activeTab === 'keamanan' ? 'text-brand-600 border-brand-600' : 'text-slate-500 border-transparent hover:text-slate-700' }} px-5 py-3 text-sm font-bold border-b-2 whitespace-nowrap transition-colors">
                                    Keamanan & Sandi
                                </button>
                            </div>

                            <!-- TAB 1: Data Pribadi -->
                            <form id="form-pribadi" action="{{ route('dashboarduser.profil.update') }}" method="POST" enctype="multipart/form-data" class="{{ $activeTab === 'keamanan' ? 'hidden' : '' }} p-6 sm:p-8 space-y-6">
                                @csrf
                                <input type="file" id="foto_profil_input" name="foto_profil" accept="image/*" class="hidden" onchange="previewAvatar(this)" />
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <!-- NIK -->
                                    <div class="sm:col-span-2">
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">NIK</label>
                                        <div class="relative flex items-center">
                                            <span class="material-symbols-outlined absolute left-3.5 text-slate-400 text-[20px]">badge</span>
                                            <input type="text" name="nik" value="{{ $user->nik }}" placeholder="Nomor Induk Kependudukan" class="w-full pl-10 pr-4 py-3 bg-white border @error('nik') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus font-medium" />
                                        </div>
                                        @error('nik') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <!-- Nama -->
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">person</span>
                                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full pl-10 pr-4 py-3 bg-white border @error('name') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus font-medium" required />
                                        </div>
                                        @error('name') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <!-- Telepon -->
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">No. WhatsApp</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">call</span>
                                            <input type="tel" name="telepon" value="{{ old('telepon', $user->telepon) }}" placeholder="Cth: 0812xxxx" class="w-full pl-10 pr-4 py-3 bg-white border @error('telepon') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus font-medium" />
                                        </div>
                                        @error('telepon') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="sm:col-span-2">
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Alamat Email</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
                                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full pl-10 pr-4 py-3 bg-white border @error('email') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus font-medium" required />
                                        </div>
                                        @error('email') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <!-- Alamat -->
                                    <div class="sm:col-span-2">
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Domisili / Alamat Lengkap</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-3.5 text-slate-400 text-[20px]">home_work</span>
                                            <textarea name="alamat" rows="3" class="w-full pl-10 pr-4 py-3 bg-white border @error('alamat') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus font-medium resize-none" placeholder="Alamat lengkap Anda...">{{ old('alamat', $user->alamat) }}</textarea>
                                        </div>
                                        @error('alamat') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-slate-100 flex justify-end">
                                    <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-brand-900 text-white rounded-lg text-sm font-semibold hover:bg-slate-800 shadow-md hover:shadow-lg transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                                        Simpan Perubahan <span class="material-symbols-outlined text-[18px]">save</span>
                                    </button>
                                </div>
                            </form>

                            <!-- TAB 2: Keamanan -->
                            <form id="form-keamanan" action="{{ route('dashboarduser.profil.password') }}" method="POST" class="{{ $activeTab === 'keamanan' ? '' : 'hidden' }} p-6 sm:p-8 space-y-6">
                                @csrf
                                <div class="bg-amber-50 border border-amber-100 rounded-xl p-4 flex items-start gap-3">
                                    <span class="material-symbols-outlined text-amber-600 mt-0.5">info</span>
                                    <p class="text-xs text-amber-800 leading-relaxed font-medium">
                                        Untuk keamanan akun, Anda akan diminta untuk login kembali setelah mengubah kata sandi.
                                    </p>
                                </div>
                                <div class="space-y-4 max-w-md">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Kata Sandi Saat Ini</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                                            <input type="password" name="current_password" class="w-full pl-10 pr-4 py-3 bg-white border @error('current_password') border-rose-400 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus" placeholder="••••••••" required />
                                        </div>
                                        @error('current_password') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Kata Sandi Baru</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">key</span>
                                            <input type="password" name="password" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus" placeholder="Minimal 8 karakter" required />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wide">Konfirmasi Sandi Baru</label>
                                        <div class="relative">
                                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">key</span>
                                            <input type="password" name="password_confirmation" class="w-full pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus" placeholder="Ulangi sandi baru" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-slate-100 flex justify-end">
                                    <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-brand-900 text-white rounded-lg text-sm font-semibold hover:bg-slate-800 shadow-md hover:shadow-lg transition-all active:scale-[0.98] flex items-center justify-center gap-2">
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

    <!-- Mobile Bottom Navigation -->
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
        <a href="{{ route('dashboarduser.profil') }}" class="flex flex-col items-center text-brand-900 transition-colors w-16 pt-2 relative">
            <span class="material-symbols-outlined text-[24px] icon-filled">person</span>
            <span class="text-[10px] font-bold mt-1 tracking-wide">Profil</span>
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

    <script>
        function switchTab(tabName) {
            const formPribadi = document.getElementById('form-pribadi');
            const formKeamanan = document.getElementById('form-keamanan');
            const btnPribadi = document.getElementById('btn-tab-pribadi');
            const btnKeamanan = document.getElementById('btn-tab-keamanan');
            const activeClass = 'text-brand-600 border-brand-600';
            const inactiveClass = 'text-slate-500 border-transparent hover:text-slate-700';

            if (tabName === 'pribadi') {
                formKeamanan.classList.add('hidden');
                formPribadi.classList.remove('hidden');
                btnPribadi.className = `px-5 py-3 text-sm font-bold border-b-2 whitespace-nowrap transition-colors ${activeClass}`;
                btnKeamanan.className = `px-5 py-3 text-sm font-bold border-b-2 whitespace-nowrap transition-colors ${inactiveClass}`;
            } else {
                formPribadi.classList.add('hidden');
                formKeamanan.classList.remove('hidden');
                btnKeamanan.className = `px-5 py-3 text-sm font-bold border-b-2 whitespace-nowrap transition-colors ${activeClass}`;
                btnPribadi.className = `px-5 py-3 text-sm font-bold border-b-2 whitespace-nowrap transition-colors ${inactiveClass}`;
            }
        }

        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                const oldSrc = document.getElementById('avatar-preview').src;
                
                reader.onload = e => {
                    document.getElementById('avatar-preview').src = e.target.result;
                    
                    // Small delay to let the preview render before confirm
                    setTimeout(() => {
                        if (confirm('Apakah Anda yakin ingin mengubah foto profil dengan foto ini?')) {
                            document.getElementById('form-pribadi').submit();
                        } else {
                            // Reset preview and input if cancelled
                            document.getElementById('avatar-preview').src = oldSrc;
                            input.value = "";
                        }
                    }, 100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        @if(session('tab') === 'keamanan')
        switchTab('keamanan');
        @endif
    </script>
</body>
</html>