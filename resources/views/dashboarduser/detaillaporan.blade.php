<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Detail Laporan #LPK-{{ $laporan->id }} - LaporanKita</title>
    
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
            
            <a href="{{ route('dashboarduser.laporan') }}" class="flex items-center gap-3 px-3 py-2.5 bg-brand-50 text-brand-900 rounded-lg font-semibold text-sm transition-colors shadow-sm">
                <span class="material-symbols-outlined icon-filled text-[20px] text-brand-600">assignment</span>
                Laporan Saya
            </a>

            <a href="{{ route('dashboarduser.notifikasi') }}" class="flex items-center gap-3 px-3 py-2.5 text-slate-500 hover:bg-slate-50 hover:text-brand-900 rounded-lg font-medium text-sm transition-colors group relative">
                <span class="material-symbols-outlined text-[20px] group-hover:text-brand-600 transition-colors">notifications</span>
                Notifikasi
                @if(Auth::user()->unreadNotifications->count() > 0)
                <span class="ml-auto bg-rose-500 text-white text-[10px] font-bold rounded-full px-1.5 py-0.5 min-w-[20px] text-center">{{ Auth::user()->unreadNotifications->count() }}</span>
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
        
        <!-- Mobile Header (With Back Button) -->
        <header class="md:hidden bg-white/90 backdrop-blur-md h-16 border-b border-slate-200 flex items-center justify-between px-4 sticky top-0 z-20">
            <a href="{{ route('dashboarduser.index') }}" class="p-2 text-slate-500 hover:bg-slate-50 rounded-full transition-colors flex items-center justify-center -ml-2">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div class="text-sm font-bold tracking-tight text-brand-900 truncate flex-1 text-center">
                Detail Laporan
            </div>
            <div class="relative" id="notif-wrapper-mobile">
                <button id="notif-toggle-mobile" class="p-2 text-slate-400 hover:text-brand-600 transition-colors relative">
                    <span class="material-symbols-outlined text-[24px]">notifications</span>
                    @if(Auth::user()->unreadNotifications->count() > 0)
                    <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full border border-white animate-pulse"></span>
                    @endif
                </button>

                <!-- Mobile Notif Dropdown Content -->
                <div id="notif-dropdown-mobile" class="fixed top-16 left-4 right-4 bg-white rounded-2xl shadow-2xl border border-slate-100 transition-all duration-300 opacity-0 scale-95 pointer-events-none z-[110] overflow-hidden text-left max-h-[70vh] flex flex-col">
                    <div class="p-4 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                        <h4 class="text-sm font-bold text-slate-900">Pemberitahuan</h4>
                        <a href="#" class="text-[11px] font-bold text-brand-600 hover:text-brand-900 transition-colors">Tandai Dibaca</a>
                    </div>
                    <div class="overflow-y-auto flex-1">
                        @forelse(Auth::user()->notifications->take(5) as $notif)
                        <a href="{{ route('laporan.show', $notif->data['laporan_id']) }}" class="p-4 hover:bg-slate-50 transition-colors border-b border-slate-50 group block">
                            <div class="flex gap-3">
                                <div class="w-10 h-10 rounded-full @if($notif->unread()) bg-brand-50 text-brand-600 @else bg-slate-50 text-slate-400 @endif flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[18px]">@if(($notif->data['type'] ?? '') === 'status') rule @else assignment_late @endif</span>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <p class="text-xs text-slate-900 font-bold leading-snug group-hover:text-brand-900 transition-colors">
                                        {{ $notif->data['pesan'] ?? ($notif->data['message'] ?? 'Pembaruan Laporan') }}
                                    </p>
                                    <div class="flex items-center gap-1.5 mt-1">
                                        <span class="text-[10px] font-medium text-slate-400">{{ $notif->created_at->diffForHumans() }}</span>
                                        @if($notif->unread())
                                        <span class="w-1.5 h-1.5 bg-brand-500 rounded-full"></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="p-10 text-center flex flex-col items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-slate-300 text-[24px]">notifications_off</span>
                            </div>
                            <p class="text-xs font-medium text-slate-500">Tidak ada pemberitahuan baru</p>
                        </div>
                        @endforelse
                    </div>
                    <a href="{{ route('dashboarduser.notifikasi') }}" class="p-4 bg-slate-50 hover:bg-slate-100 text-center block text-xs font-bold text-brand-700 transition-all border-t border-slate-100">
                        Lihat Semua Pemberitahuan
                    </a>
                </div>
            </div>
        </header>

        <!-- Desktop Topbar -->
        <header class="hidden md:flex h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 items-center justify-between px-8 sticky top-0 z-30 w-full">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboarduser.index') }}" class="p-1.5 text-slate-400 hover:text-brand-900 hover:bg-slate-50 rounded-lg transition-colors flex items-center justify-center -ml-2">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <h2 class="font-bold text-brand-900 text-sm">Kembali ke Daftar Laporan</h2>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="relative">
                    <button id="notif-toggle" class="p-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined">notifications</span>
                        @if(Auth::user()->unreadNotifications->count() > 0)
                        <span class="absolute top-2 right-2.5 w-2 h-2 bg-rose-500 rounded-full border-2 border-white animate-pulse"></span>
                        @endif
                    </button>

                    <!-- Notif Dropdown -->
                    <div id="notif-dropdown" class="absolute top-full right-0 mt-3 w-[320px] bg-white rounded-2xl shadow-2xl border border-slate-100 transition-all duration-300 opacity-0 scale-95 pointer-events-none z-[110] overflow-hidden">
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
            
            <!-- Skeleton Loader Wrapper -->
            <div id="skeleton-loader" class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 absolute inset-0 p-4 sm:p-6 lg:p-8 bg-[#FAFAFA] z-20">
                <div class="lg:col-span-7 xl:col-span-8">
                    <div class="bg-white rounded-2xl border border-slate-200 h-[600px] skeleton-pulse"></div>
                </div>
                <div class="lg:col-span-5 xl:col-span-4 space-y-6">
                    <div class="bg-white rounded-2xl border border-slate-200 h-32 skeleton-pulse"></div>
                    <div class="bg-white rounded-2xl border border-slate-200 h-[400px] skeleton-pulse"></div>
                </div>
            </div>

            <div id="main-content" class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 opacity-0 transition-opacity duration-500">
                
                <!-- ================= LEFT COLUMN: REPORT DETAILS ================= -->
                <div class="lg:col-span-7 xl:col-span-8 space-y-6 animate-[fadeInUp_0.3s_ease-out]">
                    
                    <!-- Main Detail Card -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        
                        <!-- Header meta -->
                        <div class="px-6 py-5 border-b border-slate-100 flex flex-wrap gap-3 items-center justify-between bg-slate-50/50">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold text-slate-500 tracking-wider">#LPK-{{ $laporan->id }}</span>
                                <span class="text-slate-300">•</span>
                                <span class="text-xs font-medium text-slate-500">{{ $laporan->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <!-- Current Status Badge & Actions -->
                            <div class="flex items-center gap-3">
                                @if(auth()->id() === $laporan->user_id && $laporan->status === 'baru')
                                <div class="flex items-center gap-2 pr-3 border-r border-slate-200">
                                    <a href="{{ route('laporan.edit', $laporan->id) }}" class="flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 text-amber-700 border border-amber-200 rounded-md text-[11px] font-bold uppercase tracking-wider hover:bg-amber-100 transition-colors shadow-sm">
                                        <span class="material-symbols-outlined text-[16px]">edit_square</span>
                                        Edit
                                    </a>
                                    <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-200 rounded-md text-[11px] font-bold uppercase tracking-wider hover:bg-rose-100 transition-colors shadow-sm">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                                @endif
                                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md @if($laporan->status === 'baru') bg-rose-50 border-rose-200 text-rose-700 @elseif($laporan->status === 'diproses') bg-amber-50 border-amber-200 text-amber-700 @else bg-emerald-50 border-emerald-200 text-emerald-700 @endif shadow-sm">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full @if($laporan->status === 'baru') bg-rose-400 @elseif($laporan->status === 'diproses') bg-amber-400 @else bg-emerald-400 @endif opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 @if($laporan->status === 'baru') bg-rose-500 @elseif($laporan->status === 'diproses') bg-amber-500 @else bg-emerald-500 @endif"></span>
                                    </span>
                                    <span class="text-[11px] font-bold uppercase tracking-widest">{{ $laporan->status }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h1 class="text-2xl font-extrabold text-brand-900 tracking-tight mb-4 leading-snug">
                                {{ $laporan->judul }}
                            </h1>

                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-[11px] font-semibold rounded uppercase tracking-wider">{{ $laporan->kategori }}</span>
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-600 text-[11px] font-semibold rounded flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">location_on</span>
                                    {{ $laporan->lokasi ?? 'Lokasi tidak disebutkan' }}
                                </span>
                            </div>

                            <!-- Photo Gallery (Multiple) -->
                            @if($laporan->foto && count($laporan->foto) > 0)
                            <div class="mb-6 space-y-4">
                                <div class="rounded-xl overflow-hidden border border-slate-200 bg-slate-100 shadow-sm">
                                    <img id="main-photo" src="{{ str_starts_with($laporan->foto[0], 'http') ? $laporan->foto[0] : Storage::url($laporan->foto[0]) }}" alt="Bukti Laporan" class="w-full h-auto max-h-[500px] object-cover hover:scale-[1.02] transition-transform duration-700 cursor-zoom-in" onclick="window.open(this.src)" />
                                </div>
                                
                                @if(count($laporan->foto) > 1)
                                <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                                    @foreach($laporan->foto as $index => $img)
                                    <div class="aspect-square rounded-lg overflow-hidden border-2 @if($index === 0) border-brand-500 @else border-transparent @endif cursor-pointer hover:opacity-80 transition-all thumbnail-item" onclick="changeMainPhoto('{{ str_starts_with($img, 'http') ? $img : Storage::url($img) }}', this)">
                                        <img src="{{ str_starts_with($img, 'http') ? $img : Storage::url($img) }}" class="w-full h-full object-cover" />
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endif

                            <!-- Description -->
                            <div class="prose prose-sm prose-slate max-w-none text-slate-600 leading-relaxed whitespace-pre-line">
                                {{ $laporan->deskripsi }}
                            </div>
                        </div>

                        <!-- Reporter Info -->
                        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($laporan->user->name) }}&background=e2e8f0&color=0f172a" alt="User" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" />
                                <div>
                                    <p class="text-sm font-bold text-brand-900">{{ $laporan->user->name }}</p>
                                    <p class="text-[11px] text-slate-500 font-medium">Pelapor (Publik)</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button id="btn-support" data-id="{{ $laporan->id }}" class="flex items-center gap-1.5 px-3 py-1.5 {{ $hasSupported ? 'bg-brand-50 text-brand-600 border-brand-200' : 'bg-white text-slate-500 border-slate-200' }} border hover:bg-brand-50 hover:text-brand-600 hover:border-brand-200 rounded-lg transition-all text-xs font-semibold shadow-sm group">
                                     <span class="material-symbols-outlined text-[16px] {{ $hasSupported ? 'icon-filled' : '' }} group-active:scale-125 transition-transform">thumb_up</span> 
                                     <span id="support-count">{{ $supportCount }}</span> Dukungan
                                 </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= RIGHT COLUMN: TRACKING & RESPONSE ================= -->
                <div class="lg:col-span-5 xl:col-span-4 space-y-6">
                    
                    @if($laporan->status === 'diproses' || $laporan->status === 'selesai')
                    <!-- Official Response Card (If Active/Done) -->
                    <div class="bg-brand-50 border border-brand-200 rounded-2xl shadow-sm p-5 relative overflow-hidden animate-[fadeInUp_0.4s_ease-out]">
                        <!-- Decorative bg -->
                        <span class="material-symbols-outlined absolute -right-6 -top-6 text-[120px] text-brand-500/10 rotate-12 pointer-events-none">verified_user</span>
                        
                        <div class="flex items-center gap-3 mb-4 relative z-10">
                            <div class="w-10 h-10 rounded-full bg-brand-600 text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined icon-filled text-[20px]">account_balance</span>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-brand-900">Dinas Terkait</h3>
                                <p class="text-[11px] text-brand-700 font-semibold uppercase tracking-wider">Tanggapan Resmi</p>
                            </div>
                        </div>
                        <div class="relative z-10">
                            <p class="text-sm text-brand-800 leading-relaxed italic bg-white/60 p-3 rounded-lg border border-brand-100">
                                @if($laporan->status === 'diproses')
                                    "Laporan Anda sedang kami tangani dan dalam proses tindak lanjut oleh tim di lapangan."
                                @else
                                    "Terima kasih atas laporan Anda. Laporan ini telah selesai kami tindak lanjuti."
                                @endif
                            </p>
                            <p class="text-[10px] text-brand-600 font-medium mt-3">Diperbarui: {{ $laporan->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Timeline Tracking System -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 animate-[fadeInUp_0.5s_ease-out]">
                        <h3 class="text-base font-bold text-brand-900 mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px] text-slate-400">route</span>
                            Status Perjalanan Laporan
                        </h3>

                        <!-- Vertical Timeline Container -->
                        <div class="relative ml-3 border-l-2 border-slate-100 space-y-8 pb-4">
                            
                            <!-- Item 1: Baru -->
                            <div class="relative">
                                <div class="absolute -left-[29px] top-0 w-7 h-7 bg-emerald-500 rounded-full border-4 border-white shadow-sm flex items-center justify-center z-10">
                                    <span class="material-symbols-outlined text-white text-[12px] icon-filled">check</span>
                                </div>
                                <div class="pl-6 pt-0.5">
                                    <h4 class="text-sm font-bold text-slate-900">Laporan Diterima</h4>
                                    <p class="text-[11px] text-slate-500 mt-0.5 font-medium">{{ $laporan->created_at->format('d M Y, H:i') }}</p>
                                    <p class="text-xs text-slate-600 mt-2">Laporan berhasil diterima oleh sistem LaporanKita.</p>
                                </div>
                            </div>

                            <!-- Item 2: Diproses -->
                            <div class="relative">
                                @if($laporan->status === 'baru')
                                <div class="absolute -left-[29px] top-0 w-7 h-7 bg-slate-200 rounded-full border-4 border-white flex items-center justify-center z-10">
                                    <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                </div>
                                <div class="pl-6 pt-0.5 opacity-50">
                                    <h4 class="text-sm font-bold text-slate-500">Diproses</h4>
                                </div>
                                @elseif($laporan->status === 'diproses')
                                <div class="absolute -left-[33px] top-[-4px] w-9 h-9 bg-amber-100 rounded-full animate-pulse z-0"></div>
                                <div class="absolute -left-[29px] top-0 w-7 h-7 bg-amber-500 rounded-full border-4 border-white shadow-sm flex items-center justify-center z-10">
                                    <span class="material-symbols-outlined text-white text-[12px] animate-[spin_3s_linear_infinite]">sync</span>
                                </div>
                                <div class="pl-6 pt-0.5">
                                    <h4 class="text-sm font-bold text-amber-600">Sedang Diproses</h4>
                                    <p class="text-[11px] text-slate-500 mt-0.5 font-medium">{{ $laporan->updated_at->format('d M Y, H:i') }}</p>
                                    <p class="text-xs text-slate-600 mt-2">Instansi terkait sedang menangani masalah di lapangan.</p>
                                </div>
                                @else
                                <div class="absolute -left-[29px] top-0 w-7 h-7 bg-emerald-500 rounded-full border-4 border-white shadow-sm flex items-center justify-center z-10">
                                    <span class="material-symbols-outlined text-white text-[12px] icon-filled">check</span>
                                </div>
                                <div class="pl-6 pt-0.5">
                                    <h4 class="text-sm font-bold text-slate-900">Diproses</h4>
                                    <p class="text-xs text-slate-600 mt-2">Laporan telah ditangani oleh dinas terkait.</p>
                                </div>
                                @endif
                            </div>

                            <!-- Item 3: Selesai -->
                            <div class="relative">
                                @if($laporan->status === 'selesai')
                                <div class="absolute -left-[29px] top-0 w-7 h-7 bg-emerald-500 rounded-full border-4 border-white shadow-sm flex items-center justify-center z-10">
                                    <span class="material-symbols-outlined text-white text-[12px] icon-filled">check</span>
                                </div>
                                <div class="pl-6 pt-0.5">
                                    <h4 class="text-sm font-bold text-emerald-600">Selesai</h4>
                                    <p class="text-[11px] text-slate-500 mt-0.5 font-medium">{{ $laporan->updated_at->format('d M Y, H:i') }}</p>
                                    <p class="text-xs text-slate-600 mt-2">Masalah telah berhasil diselesaikan.</p>
                                </div>
                                @else
                                <div class="absolute -left-[29px] top-0 w-7 h-7 bg-slate-200 rounded-full border-4 border-white flex items-center justify-center z-10">
                                    <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                </div>
                                <div class="pl-6 pt-0.5 opacity-50">
                                    <h4 class="text-sm font-bold text-slate-500">Selesai</h4>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- Spacing at bottom for mobile nav -->
            <div class="h-6 md:hidden"></div>
        </div>
    </main>

    <!-- ==================== MOBILE BOTTOM NAV ==================== -->
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

    <!-- UI/UX Scripts -->
    <script>
        function changeMainPhoto(src, thumbEl) {
            document.getElementById('main-photo').src = src;
            // Reset borders
            document.querySelectorAll('.thumbnail-item').forEach(el => {
                el.classList.remove('border-brand-500');
                el.classList.add('border-transparent');
            });
            // Set active border
            thumbEl.classList.remove('border-transparent');
            thumbEl.classList.add('border-brand-500');
        }

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

            // Support Button Logic
            const btnSupport = document.getElementById('btn-support');
            if (btnSupport) {
                btnSupport.addEventListener('click', async function() {
                    const id = this.getAttribute('data-id');
                    const countEl = document.getElementById('support-count');
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
            }
        });
    </script>

</body>
</html>