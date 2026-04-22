<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Buat Laporan - LaporanKita</title>
    
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
        
        /* Smooth transition for form inputs */
        .input-focus { transition: all 0.2s ease-in-out; }

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
            
            <a href="{{ route('laporan.create') }}" class="flex items-center gap-3 px-3 py-2.5 bg-brand-50 text-brand-900 rounded-lg font-semibold text-sm transition-colors">
                <span class="material-symbols-outlined icon-filled text-[20px] text-brand-600">add_box</span>
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
                <span class="text-lg font-bold tracking-tight text-brand-900">Buat Laporan</span>
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
                    <div class="p-4 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                        <h4 class="text-sm font-bold text-slate-900">Pemberitahuan</h4>
                        <a href="#" class="text-[11px] font-bold text-brand-600 hover:text-brand-900 transition-colors">Tandai Dibaca</a>
                    </div>
                    <div class="overflow-y-auto flex-1">
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
                    <a href="{{ route('dashboarduser.notifikasi') }}" class="p-4 bg-slate-50 hover:bg-slate-100 text-center block text-xs font-bold text-brand-700 transition-all border-t border-slate-100">
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
            <div id="skeleton-loader" class="max-w-3xl mx-auto absolute inset-0 p-4 sm:p-6 lg:p-8 bg-[#FAFAFA] z-20">
                <div class="mb-6">
                    <div class="w-64 h-8 bg-slate-200 rounded-lg skeleton-pulse mb-2"></div>
                    <div class="w-full max-w-md h-4 bg-slate-200 rounded skeleton-pulse"></div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 h-[500px] skeleton-pulse"></div>
            </div>

            <div id="main-content" class="max-w-3xl mx-auto opacity-0 transition-opacity duration-500">
                <!-- Header Text -->
                <div class="mb-6 animate-[fadeInUp_0.3s_ease-out]">
                    <h1 class="text-2xl font-extrabold text-brand-900 tracking-tight mb-1">Sampaikan Laporan Anda</h1>
                    <p class="text-sm text-slate-500 font-medium">Pastikan data yang Anda masukkan akurat dan sesuai dengan kondisi di lapangan.</p>
                </div>

                <!-- Form Card -->
                <form id="report-form" class="bg-white rounded-2xl border border-slate-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden animate-[fadeInUp_0.4s_ease-out]" action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 sm:p-8 space-y-6">
                        
                        <!-- 1. Judul & Kategori -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Judul Laporan <span class="text-rose-500">*</span></label>
                                <input type="text" name="judul" placeholder="Contoh: Jalan berlubang di Jl. Sudirman" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus text-brand-900 font-medium placeholder:font-normal" value="{{ old('judul') }}" required />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Kategori <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <select name="kategori" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus appearance-none text-slate-700 font-medium" required>
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        <option value="infrastruktur">Infrastruktur</option>
                                        <option value="kebersihan">Kebersihan & Lingkungan</option>
                                        <option value="ketertiban">Ketertiban Umum</option>
                                        <option value="fasilitas">Fasilitas Publik</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Deskripsi -->
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">Deskripsi Detail <span class="text-rose-500">*</span></label>
                                <span class="text-[10px] text-slate-400 font-medium" id="char-count">0/500</span>
                            </div>
                            <textarea name="deskripsi" id="desc-input" rows="5" placeholder="Ceritakan detail masalah yang Anda temukan. Kapan terjadi, bagaimana kondisinya, dan dampaknya..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus resize-none text-slate-700 leading-relaxed" required maxlength="500">{{ old('deskripsi') }}</textarea>
                        </div>

                        <!-- 3. Lokasi -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Titik Lokasi</label>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="relative flex-1">
                                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">location_on</span>
                                    <input type="text" name="lokasi" id="input-location" placeholder="Ketik alamat atau nama jalan..." class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus text-slate-700" value="{{ old('lokasi') }}" />
                                </div>
                                <button type="button" id="btn-detect-location" class="flex items-center justify-center gap-2 px-4 py-3 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:border-brand-300 transition-colors text-brand-900 font-semibold text-sm shrink-0 shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span class="material-symbols-outlined text-[18px]">my_location</span>
                                    <span id="text-detect-location">Deteksi Lokasi</span>
                                </button>
                            </div>
                        </div>

                        <!-- 4. Upload Foto (Drag & Drop) -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Bukti Foto <span class="text-rose-500">*</span></label>
                            
                            <!-- Drop Zone -->
                            <div class="flex flex-col gap-3">
                                <div id="drop-zone" class="relative border-2 border-dashed border-slate-300 rounded-xl bg-slate-50 p-8 text-center hover:bg-brand-50 hover:border-brand-400 transition-all cursor-pointer group flex flex-col items-center justify-center">
                                    <input type="file" name="foto[]" id="file-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/png, image/jpeg, image/jpg" multiple required />
                                    
                                    <div class="w-12 h-12 mb-3 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-400 group-hover:text-brand-600 transition-colors border border-slate-100">
                                        <span class="material-symbols-outlined text-[24px]">cloud_upload</span>
                                    </div>
                                    <p class="text-sm font-bold text-brand-900 mb-1 group-hover:text-brand-700">Klik untuk unggah atau tarik foto-foto ke sini</p>
                                    <p class="text-xs text-slate-500 font-medium">Bisa pilih lebih dari 1 foto (Mendukung JPG, JPEG, PNG)</p>
                                </div>
                                
                                <button type="button" id="btn-open-camera" class="flex items-center justify-center gap-2 w-full py-3 bg-white border border-brand-200 text-brand-700 rounded-xl hover:bg-brand-50 transition-all font-bold text-sm shadow-sm group">
                                    <span class="material-symbols-outlined group-hover:scale-110 transition-transform">photo_camera</span>
                                    Ambil Foto dengan Kamera
                                </button>
                            </div>

                            <!-- Multiple Preview Area -->
                            <div id="preview-list-container" class="hidden mt-6 space-y-3">
                                <div class="flex items-center justify-between px-1">
                                    <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Foto Terpilih</h4>
                                    <button type="button" id="btn-clear-all" class="text-[10px] font-bold text-rose-500 hover:text-rose-700 uppercase tracking-tighter">Hapus Semua</button>
                                </div>
                                <div id="preview-items" class="grid grid-cols-1 gap-3">
                                    <!-- Dynamic items will be injected here -->
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <!-- Form Actions / Footer -->
                    <div class="px-6 sm:px-8 py-5 bg-slate-50 border-t border-slate-200 flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                        <button type="reset" id="btn-reset" class="w-full sm:w-auto px-6 py-2.5 bg-white border border-slate-300 text-slate-700 rounded-lg text-sm font-semibold hover:bg-slate-50 hover:text-brand-900 transition-all">
                            Batalkan
                        </button>
                        <button type="submit" class="w-full sm:w-auto px-8 py-2.5 bg-brand-900 text-white rounded-lg text-sm font-semibold hover:bg-slate-800 shadow-md hover:shadow-lg transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            Kirim Laporan <span class="material-symbols-outlined text-[18px]">send</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>

    <!-- Camera Modal -->
    <div id="camera-modal" class="fixed inset-0 z-[100] hidden bg-black/90 backdrop-blur-md flex flex-col items-center justify-center p-4">
        <div class="relative w-full max-w-lg bg-slate-900 rounded-3xl overflow-hidden shadow-2xl flex flex-col border border-slate-700">
            <!-- Header Modal -->
            <div class="p-4 flex items-center justify-between border-b border-slate-800 bg-slate-900/50">
                <h3 class="text-white font-bold text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-brand-400">photo_camera</span>
                    Kamera LaporanKita
                </h3>
                <button type="button" id="btn-close-camera" class="p-2 text-slate-400 hover:text-white transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <!-- Video Container -->
            <div class="relative aspect-[3/4] bg-black flex items-center justify-center overflow-hidden">
                <video id="camera-preview" autoplay playsinline class="w-full h-full object-cover"></video>
                <!-- Overlay Focus -->
                <div class="absolute inset-8 border-2 border-white/20 rounded-2xl pointer-events-none"></div>
                <div class="absolute top-4 left-4 flex gap-1 items-center bg-black/50 backdrop-blur px-2 py-1 rounded-full border border-white/10">
                    <div class="w-1.5 h-1.5 bg-rose-500 rounded-full animate-pulse"></div>
                    <span class="text-[10px] text-white font-bold uppercase tracking-wider">Live</span>
                </div>
            </div>

            <!-- Controls -->
            <div class="p-8 flex items-center justify-around bg-slate-900">
                <button type="button" id="btn-switch-camera" class="w-12 h-12 flex items-center justify-center bg-slate-800 text-white rounded-full hover:bg-slate-700 transition-all border border-slate-700">
                    <span class="material-symbols-outlined">flip_camera_ios</span>
                </button>
                
                <button type="button" id="btn-capture" class="w-20 h-20 flex items-center justify-center bg-white rounded-full hover:scale-105 active:scale-95 transition-all shadow-xl group">
                    <div class="w-16 h-16 border-4 border-slate-900 rounded-full group-active:border-8 transition-all"></div>
                </button>

                <div class="w-12 h-12"></div> <!-- Spacer for symmetry -->
            </div>
            
            <canvas id="camera-canvas" class="hidden"></canvas>
        </div>
        <p class="text-slate-400 text-xs mt-6 font-medium">Arahkan kamera ke arah objek masalah dengan pencahayaan cukup</p>
    </div>

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
            <a href="#" class="bg-brand-900 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_20px_-6px_rgba(15,23,42,0.6)] border-[4px] border-[#FAFAFA]">
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
        document.addEventListener('DOMContentLoaded', () => {
            // Skeleton Loader Logic
            setTimeout(() => {
                const skeleton = document.getElementById('skeleton-loader');
                const mainContent = document.getElementById('main-content');
                if(skeleton && mainContent) {
                    skeleton.classList.add('hidden');
                    mainContent.classList.remove('opacity-0');
                    mainContent.classList.add('opacity-100');
                }
            }, 800); // Sedikit lebih cepat untuk form
            
            // 1. Character Count for Textarea
            const descInput = document.getElementById('desc-input');
            const charCount = document.getElementById('char-count');
            
            descInput.addEventListener('input', function() {
                const currentLength = this.value.length;
                charCount.textContent = `${currentLength}/500`;
                
                if (currentLength >= 450) {
                    charCount.classList.add('text-amber-500');
                    charCount.classList.remove('text-slate-400');
                } else {
                    charCount.classList.remove('text-amber-500', 'text-rose-500');
                    charCount.classList.add('text-slate-400');
                }
                
                if(currentLength === 500) {
                    charCount.classList.replace('text-amber-500', 'text-rose-500');
                }
            });

            // 2. Multiple File Upload Logic
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('file-input');
            const previewListContainer = document.getElementById('preview-list-container');
            const previewItems = document.getElementById('preview-items');
            const btnClearAll = document.getElementById('btn-clear-all');

            // Handle selected files via click or drop
            fileInput.addEventListener('change', function() {
                handleFiles(Array.from(this.files));
            });

            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, e => { e.preventDefault(); e.stopPropagation(); }, false);
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.add('border-brand-500', 'bg-brand-50');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.remove('border-brand-500', 'bg-brand-50');
                }, false);
            });

            dropZone.addEventListener('drop', (e) => {
                const files = Array.from(e.dataTransfer.files);
                const dataTransfer = new DataTransfer();
                files.forEach(file => dataTransfer.items.add(file));
                fileInput.files = dataTransfer.files;
                handleFiles(files);
            }, false);

            function handleFiles(files) {
                previewItems.innerHTML = '';
                if (files.length === 0) {
                    previewListContainer.classList.add('hidden');
                    return;
                }

                previewListContainer.classList.remove('hidden');

                files.forEach((file) => {
                    if (!file.type.match('image.*')) return;

                    const item = document.createElement('div');
                    item.className = 'bg-white border border-slate-200 rounded-xl p-3 flex items-center gap-4 shadow-sm animate-[fadeInUp_0.2s_ease-out]';
                    
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        item.innerHTML = `
                            <div class="w-14 h-14 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                <img src="${e.target.result}" class="w-full h-full object-cover" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-1">
                                    <p class="text-sm font-semibold text-brand-900 truncate">${file.name}</p>
                                    <span class="text-[10px] text-emerald-500 font-bold uppercase">Ready</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-emerald-500 h-1.5 rounded-full w-full"></div>
                                </div>
                                <p class="text-[10px] text-slate-500 mt-1">${(file.size / (1024 * 1024)).toFixed(2)} MB</p>
                            </div>
                        `;
                    };
                    reader.readAsDataURL(file);
                    previewItems.appendChild(item);
                });
            }

            btnClearAll.addEventListener('click', () => {
                fileInput.value = '';
                previewItems.innerHTML = '';
                previewListContainer.classList.add('hidden');
            });

            // 3. Reset Button logic
            document.getElementById('btn-reset').addEventListener('click', () => {
                btnClearAll.click();
                charCount.textContent = '0/500';
                charCount.classList.remove('text-amber-500', 'text-rose-500');
                charCount.classList.add('text-slate-400');
            });

            // 4. Deteksi Lokasi Logic
            const btnDetectLocation = document.getElementById('btn-detect-location');
            const inputLocation = document.getElementById('input-location');
            const textDetectLocation = document.getElementById('text-detect-location');

            if (btnDetectLocation && inputLocation) {
                btnDetectLocation.addEventListener('click', () => {
                    if (!navigator.geolocation) {
                        alert('Peringatan: Browser Anda tidak mendukung fitur deteksi lokasi otomatis.');
                        return;
                    }

                    // Loading State UI
                    btnDetectLocation.disabled = true;
                    textDetectLocation.textContent = 'Mendeteksi...';
                    const originalPlaceholder = inputLocation.placeholder;
                    inputLocation.placeholder = 'Mencari titik lokasi Anda...';

                    navigator.geolocation.getCurrentPosition(
                        async (position) => {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;

                            try {
                                const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`, {
                                    headers: { 'Accept-Language': 'id-ID,id;q=0.9' }
                                });
                                const data = await response.json();

                                if (data && data.display_name) {
                                    inputLocation.value = data.display_name;
                                } else {
                                    inputLocation.value = `${lat}, ${lng}`;
                                }
                            } catch (error) {
                                console.error('Geocoding API Error:', error);
                                inputLocation.value = `${lat}, ${lng}`;
                            } finally {
                                btnDetectLocation.disabled = false;
                                textDetectLocation.textContent = 'Deteksi Lokasi';
                                inputLocation.placeholder = originalPlaceholder;
                            }
                        },
                        (error) => {
                            btnDetectLocation.disabled = false;
                            textDetectLocation.textContent = 'Deteksi Lokasi';
                            inputLocation.placeholder = originalPlaceholder;
                            
                            switch (error.code) {
                                case error.PERMISSION_DENIED:
                                    alert('Akses lokasi ditolak! Harap beri izin browser untuk mengakses lokasi Anda.');
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    alert('Informasi lokasi saat ini tidak tersedia.');
                                    break;
                                case error.TIMEOUT:
                                    alert('Waktu permintaan lokasi telah habis (Timeout).');
                                    break;
                                default:
                                    alert('Gagal mendeteksi lokasi akibat kesalahan sistem.');
                                    break;
                            }
                        },
                        { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
                    );
                });
            }

            // 5. CAMERA FEATURE LOGIC
            const cameraModal = document.getElementById('camera-modal');
            const openCameraBtn = document.getElementById('btn-open-camera');
            const closeCameraBtn = document.getElementById('btn-close-camera');
            const video = document.getElementById('camera-preview');
            const canvas = document.getElementById('camera-canvas');
            const captureBtn = document.getElementById('btn-capture');
            const switchCameraBtn = document.getElementById('btn-switch-camera');
            
            let stream = null;
            let currentFacingMode = 'environment'; // Default to back camera
            let capturedFiles = [];

            async function startCamera() {
                try {
                    if (stream) {
                        stream.getTracks().forEach(track => track.stop());
                    }
                    
                    stream = await navigator.mediaDevices.getUserMedia({
                        video: { 
                            facingMode: currentFacingMode,
                            width: { ideal: 1280 },
                            height: { ideal: 720 }
                        },
                        audio: false
                    });
                    
                    video.srcObject = stream;
                    cameraModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden'; // Prevent scroll
                } catch (err) {
                    console.error('Error accessing camera:', err);
                    alert('Gagal mengakses kamera. Pastikan Anda telah memberikan izin kamera di browser Anda.');
                }
            }

            function stopCamera() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                    stream = null;
                }
                video.srcObject = null;
                cameraModal.classList.add('hidden');
                document.body.style.overflow = '';
            }

            openCameraBtn.addEventListener('click', startCamera);
            closeCameraBtn.addEventListener('click', stopCamera);

            switchCameraBtn.addEventListener('click', () => {
                currentFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';
                startCamera();
            });

            captureBtn.addEventListener('click', () => {
                const context = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                
                // Draw current frame to canvas
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                
                // Convert canvas to blob/file
                canvas.toBlob((blob) => {
                    const timestamp = new Date().getTime();
                    const filename = `kamera-${timestamp}.jpg`;
                    const file = new File([blob], filename, { type: 'image/jpeg' });
                    
                    // Add to our main file input
                    const dataTransfer = new DataTransfer();
                    
                    // Add existing files first
                    Array.from(fileInput.files).forEach(f => dataTransfer.items.add(f));
                    // Add the new captured file
                    dataTransfer.items.add(file);
                    
                    fileInput.files = dataTransfer.files;
                    
                    // Trigger UI Update
                    handleFiles(Array.from(fileInput.files));
                    
                    // Visual feedback & Close
                    captureBtn.classList.add('bg-brand-500');
                    setTimeout(() => {
                        captureBtn.classList.remove('bg-brand-500');
                        stopCamera();
                    }, 200);
                    
                }, 'image/jpeg', 0.85);
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