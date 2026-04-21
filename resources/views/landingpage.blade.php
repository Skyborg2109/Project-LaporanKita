<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>LaporanKita - Layanan Aspirasi Terpadu</title>
    
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
                    },
                    backgroundImage: {
                        'dot-pattern': 'radial-gradient(circle, #cbd5e1 1px, transparent 1px)',
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24;
        }
        .icon-filled {
            font-variation-settings: 'FILL' 1;
        }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .bg-dots { background-size: 20px 20px; }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased flex flex-col min-h-screen selection:bg-brand-500 selection:text-white">

    <!-- Top Notice Bar -->
    <div class="bg-brand-900 text-white py-2 px-4 text-center text-xs font-medium tracking-wide">
        🚨 Layanan Darurat 112 aktif 24/7 untuk kondisi mengancam nyawa. <a href="{{ route('public.pelajari') }}" class="underline hover:text-brand-100 ml-1">Pelajari lebih lanjut.</a>
    </div>

    <!-- Navbar -->
    <header class="bg-white/80 backdrop-blur-lg border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2.5">
                    <div class="bg-brand-900 text-white p-1.5 rounded flex items-center justify-center">
                        <span class="material-symbols-outlined icon-filled text-lg">maps_ugc</span>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-brand-900">Laporan<span class="text-brand-600">Kita</span></span>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#beranda" class="nav-link text-brand-900 font-bold text-sm transition-all pb-1 border-b-2 border-brand-600">Beranda</a>
                    <a href="#cara-kerja" class="nav-link text-slate-500 hover:text-brand-900 font-medium text-sm transition-all pb-1 border-b-2 border-transparent">Cara Kerja</a>
                    <a href="#feed" class="nav-link text-slate-500 hover:text-brand-900 font-medium text-sm transition-all pb-1 border-b-2 border-transparent text-sm">Feed Laporan</a>
                    <a href="#kontak" class="nav-link text-slate-500 hover:text-brand-900 font-medium text-sm transition-all pb-1 border-b-2 border-transparent">Kontak</a>
                </nav>

                <!-- Desktop Auth & Mobile Toggle -->
                <div class="flex items-center gap-2 sm:gap-4">
                    @auth
                        <!-- Notifications Dropdown -->
                        <div class="relative flex items-center">
                            <button id="notif-toggle" class="p-2 rounded-full hover:bg-slate-100 transition-colors relative">
                                <span class="material-symbols-outlined text-slate-500">notifications</span>
                                @if(Auth::user()->unreadNotifications->count() > 0)
                                <span class="absolute top-1 right-1 w-4 h-4 bg-rose-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center animate-bounce shadow-sm">
                                    {{ Auth::user()->unreadNotifications->count() }}
                                </span>
                                @endif
                            </button>

                            <!-- Notif Content -->
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

                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="hidden md:flex items-center gap-1.5 bg-brand-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-md text-sm font-semibold transition-all shadow-sm hover:shadow-md">
                            <span class="material-symbols-outlined text-[18px]">dashboard</span> Dashboard Admin
                        </a>
                        @else
                        <a href="{{ route('dashboarduser.index') }}" class="hidden md:flex items-center gap-1.5 bg-brand-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-md text-sm font-semibold transition-all shadow-sm hover:shadow-md">
                            <span class="material-symbols-outlined text-[18px]">dashboard</span> Dashboard
                        </a>
                        @endif
                    @else
                    <a href="/login" class="hidden md:flex items-center gap-1.5 bg-brand-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-md text-sm font-semibold transition-all shadow-sm hover:shadow-md">
                        <span class="material-symbols-outlined text-[18px]">login</span> Login / Register
                    </a>
                    @endauth

                    <!-- Mobile Menu Button (Hamburger) -->
                    <div class="flex items-center md:hidden">
                        <button id="mobile-menu-toggle" class="p-2 -mr-2 rounded-md text-brand-900 hover:bg-slate-100 transition-colors">
                            <span class="material-symbols-outlined text-[28px]" id="menu-icon">menu</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer Menu (Moved outside header for proper stacking) -->
    <div id="mobile-drawer" class="fixed inset-0 z-[100] bg-slate-900/60 backdrop-blur-sm transition-opacity duration-300 opacity-0 pointer-events-none md:hidden">
        <div id="drawer-content" class="absolute top-0 right-0 h-full w-[280px] bg-white shadow-2xl transition-transform duration-300 translate-x-full flex flex-col">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-white">
                <span class="text-lg font-bold tracking-tight text-brand-900">Laporan<span class="text-brand-600">Kita</span></span>
                <button id="close-drawer" class="p-2 rounded-lg hover:bg-slate-100 transition-colors text-slate-500">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            
            <nav class="p-6 flex flex-col gap-5 overflow-y-auto bg-white flex-grow">
                <a href="#beranda" class="mobile-nav-link text-brand-900 font-bold text-base flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 transition-all border-l-4 border-brand-600">
                    <span class="material-symbols-outlined">home</span> Beranda
                </a>
                <a href="#cara-kerja" class="mobile-nav-link text-slate-600 font-medium text-base flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 transition-all border-l-4 border-transparent">
                    <span class="material-symbols-outlined">info</span> Cara Kerja
                </a>
                <a href="#feed" class="mobile-nav-link text-slate-600 font-medium text-base flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 transition-all border-l-4 border-transparent">
                    <span class="material-symbols-outlined">rss_feed</span> Feed Laporan
                </a>
                <a href="#kontak" class="mobile-nav-link text-slate-600 font-medium text-base flex items-center gap-3 p-2 rounded-lg hover:bg-slate-50 transition-all border-l-4 border-transparent">
                    <span class="material-symbols-outlined">contact_support</span> Kontak
                </a>
                
                <div class="h-px bg-slate-100 my-4"></div>
                
                <div class="px-2">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Akses Cepat</p>
                    @auth
                        <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboarduser.index') }}" class="flex items-center justify-between bg-brand-900 text-white px-5 py-4 rounded-xl shadow-lg shadow-brand-900/20 active:scale-95 transition-all">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                                <span class="font-bold text-sm">Masuk Dashboard</span>
                            </div>
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </a>
                    @else
                        <a href="/login" class="flex items-center justify-between bg-brand-900 text-white px-5 py-4 rounded-xl shadow-lg shadow-brand-900/20 active:scale-95 transition-all">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-[20px]">login</span>
                                <span class="font-bold text-sm">Login / Register</span>
                            </div>
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </a>
                    @endauth
                </div>
            </nav>

            <div class="p-6 bg-slate-50 text-[10px] text-slate-400 font-medium text-center border-t border-slate-100">
                &copy; 2026 LaporanKita. Versi 1.0.0
            </div>
        </div>
    </div>

    <main class="flex-grow">
        <!-- Editorial Hero Section -->
        <section id="beranda" class="relative pt-12 pb-20 lg:pt-20 lg:pb-32 overflow-hidden border-b border-slate-200 bg-dots bg-dot-pattern">
            <div class="absolute inset-0 bg-gradient-to-b from-white/40 via-[#FAFAFA]/80 to-[#FAFAFA] pointer-events-none"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                    
                    <!-- Text Content -->
                    <div class="lg:col-span-6 space-y-6 lg:space-y-8 reveal">
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white border border-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider shadow-sm w-fit">
                            <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                            Portal Aspirasi Nasional
                        </div>
                        
                        <h1 class="text-4xl sm:text-5xl lg:text-[4rem] font-extrabold tracking-tight text-brand-900 leading-[1.1]">
                            Jangan Hanya <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-teal-400">Mengeluh.</span><br/>
                            Laporkan.
                        </h1>
                        
                        <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-lg font-medium">
                            Temukan jalan rusak, fasilitas publik terbengkalai, atau pelanggaran di sekitar Anda? Laporan Anda adalah langkah pertama menuju perbaikan.
                        </p>
                        
                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-2">
                            <a href="{{ route('laporan.create') }}" class="bg-brand-900 hover:bg-slate-800 text-white px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl font-semibold text-sm transition-all shadow-lg shadow-slate-900/20 hover:shadow-xl hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[20px] icon-filled">edit_document</span>
                                Buat Laporan
                            </a>
                            <a href="{{ route('dashboarduser.index') }}" class="bg-white border-2 border-slate-200 hover:border-brand-900 hover:text-brand-900 text-slate-700 px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl font-semibold text-sm transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">track_changes</span>
                                Cek Status
                            </a>
                        </div>
                    </div>
                    
                    <!-- Imagery / Floating UI -->
                    <div class="lg:col-span-6 relative reveal" style="transition-delay: 200ms;">
                        <div class="relative w-full max-w-md mx-auto lg:max-w-none aspect-[4/3] lg:aspect-square group shadow-2xl rounded-2xl">
                            <!-- Image Clipping Container -->
                            <div class="absolute inset-0 rounded-2xl overflow-hidden z-10 bg-slate-100 border border-slate-200/50 shadow-inner">
                                @if($latestReport && $latestReport->foto && count($latestReport->foto) > 0)
                                <img src="{{ asset('storage/' . $latestReport->foto[0]) }}" alt="Latest Report" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                                @else
                                <img src="https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?auto=format&fit=crop&q=80&w=1000" alt="Petugas memperbaiki jalan" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                                @endif
                                
                                <!-- Vignette / Blurry Edge Overlay -->
                                <div class="absolute inset-0 z-10 shadow-[inner_0_0_100px_rgba(0,0,0,0.2)] pointer-events-none ring-1 ring-inset ring-black/5 rounded-2xl"></div>
                                <div class="absolute inset-0 bg-slate-900/10 z-0"></div>
                            </div>
                            
                            <!-- Floating Card 1: Ticket -->
                            <div class="absolute -bottom-4 -left-2 sm:-bottom-6 sm:-left-6 lg:bottom-8 lg:-left-10 bg-white p-4 rounded-xl shadow-[0_20px_40px_-15px_rgba(0,0,0,0.15)] border border-slate-100 z-20 w-56 sm:w-64 animate-[translateY_4s_ease-in-out_infinite_alternate]">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="w-2 h-2 rounded-full @if($latestReport && $latestReport->status === 'selesai') bg-emerald-500 @else bg-brand-500 @endif @if($latestReport && $latestReport->status !== 'selesai') animate-pulse @endif"></span>
                                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Tiket #LPK-{{ $latestReport->id ?? '8921' }}</span>
                                </div>
                                <p class="text-sm font-semibold text-brand-900 leading-tight mb-2 truncate">
                                    {{ $latestReport->judul ?? 'Pembersihan Saluran Drainase' }}
                                </p>
                                <div class="w-full bg-slate-100 rounded-full h-1.5 mb-1">
                                    <div class="h-1.5 rounded-full @if($latestReport && $latestReport->status === 'selesai') bg-emerald-500 w-full @elseif($latestReport && $latestReport->status === 'diproses') bg-brand-500 w-[60%] @else bg-slate-300 w-[5%] @endif transition-all duration-1000"></div>
                                </div>
                                <span class="text-[10px] font-medium text-slate-500">
                                    Status: <span class="font-bold uppercase">{{ $latestReport->status ?? 'Menunggu' }}</span>
                                </span>
                            </div>

                            <!-- Floating Card 2: Status -->
                            <div class="absolute -top-4 -right-2 sm:-top-6 sm:-right-6 lg:top-8 lg:-right-8 bg-white/95 backdrop-blur px-4 py-3 rounded-xl shadow-xl border border-white z-20 flex items-center gap-3 animate-[translateY_5s_ease-in-out_infinite_alternate-reverse]">
                                <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined icon-filled text-[20px]">verified_user</span>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-900">Total Aduan</div>
                                    <div class="text-[14px] font-bold text-brand-600 leading-none">{{ number_format($totalLaporan, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Structured Process Grid -->
        <section id="cara-kerja" class="py-20 lg:py-24 bg-white border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row gap-12 items-start">
                    <div class="md:w-1/3 reveal">
                        <h2 class="text-3xl font-extrabold text-brand-900 tracking-tight mb-4">Alur Singkat,<br/>Tindakan Cepat.</h2>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6">Kami memangkas birokrasi berbelit. Setiap laporan langsung diarahkan ke dasbor instansi terkait untuk segera ditindaklanjuti secara transparan.</p>
                        <a href="{{ route('public.prosedur') }}" class="text-brand-600 font-semibold text-sm hover:underline flex items-center gap-1 w-fit">
                            Pelajari SOP Kami <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span>
                        </a>
                    </div>
                    
                    <div class="md:w-2/3 grid grid-cols-1 sm:grid-cols-3 gap-6 relative w-full">
                        <div class="hidden sm:block absolute top-8 left-10 right-10 h-px bg-slate-200 z-0"></div>

                        <div class="relative z-10 bg-white p-6 border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow reveal" style="transition-delay: 100ms;">
                            <div class="w-8 h-8 rounded-full bg-brand-900 text-white flex items-center justify-center font-bold text-sm mb-4">1</div>
                            <h3 class="text-base font-bold text-brand-900 mb-2">Tulis Laporan</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">Jelaskan detail masalah, lampirkan foto bukti, dan tentukan titik lokasi akurat.</p>
                        </div>

                        <div class="relative z-10 bg-white p-6 border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow reveal" style="transition-delay: 200ms;">
                            <div class="w-8 h-8 rounded-full bg-slate-100 text-brand-900 border border-slate-200 flex items-center justify-center font-bold text-sm mb-4">2</div>
                            <h3 class="text-base font-bold text-brand-900 mb-2">Verifikasi & Disposisi</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">Admin memvalidasi laporan dalam 1x24 jam dan meneruskannya ke dinas terkait.</p>
                        </div>

                        <div class="relative z-10 bg-white p-6 border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow reveal" style="transition-delay: 300ms;">
                            <div class="w-8 h-8 rounded-full bg-brand-500 text-white flex items-center justify-center font-bold text-sm mb-4">
                                <span class="material-symbols-outlined text-[16px] icon-filled">done_all</span>
                            </div>
                            <h3 class="text-base font-bold text-brand-900 mb-2">Tindak Lanjut Publik</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">Pantau progres pekerjaan secara langsung. Beri rating jika masalah sudah tertangani.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistik Section -->
        <section class="py-12 bg-brand-900 border-b border-slate-800 relative overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-slate-700/20 via-transparent to-transparent pointer-events-none"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8 divide-y sm:divide-y-0 sm:divide-x divide-slate-700/50">
                    <div class="text-center sm:py-2 reveal">
                        <div class="text-4xl md:text-5xl font-extrabold text-white mb-2">{{ number_format($totalLaporan, 0, ',', '.') }}</div>
                        <div class="text-xs font-bold text-teal-400 uppercase tracking-widest">Total Laporan Masuk</div>
                    </div>
                    <div class="text-center py-6 sm:py-2 reveal" style="transition-delay: 100ms;">
                        <div class="text-4xl md:text-5xl font-extrabold text-white mb-2">{{ number_format($laporanDiproses, 0, ',', '.') }}</div>
                        <div class="text-xs font-bold text-amber-400 uppercase tracking-widest">Laporan Diproses</div>
                    </div>
                    <div class="text-center pt-6 sm:pt-2 reveal" style="transition-delay: 200ms;">
                        <div class="text-4xl md:text-5xl font-extrabold text-white mb-2">{{ number_format($laporanSelesai, 0, ',', '.') }}</div>
                        <div class="text-xs font-bold text-emerald-400 uppercase tracking-widest">Laporan Selesai</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Real-world Data Cards (Laporan Terbaru) -->
        <section id="feed" class="py-20 lg:py-24 bg-[#FAFAFA]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Diperbaiki dengan flex-col sm:flex-row agar tulisan Lihat Semua tidak tumpah -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-8 sm:mb-10 reveal">
                    <div>
                        <h2 class="text-2xl md:text-3xl font-extrabold text-brand-900 tracking-tight mb-2">Feed Laporan Terkini</h2>
                        <p class="text-sm text-slate-600">Real-time update dari berbagai daerah.</p>
                    </div>
                    <a href="{{ route('public.semualaporan') }}" class="inline-flex items-center gap-1 px-4 py-2 text-sm font-semibold bg-white border border-slate-200 rounded-md text-brand-900 hover:bg-slate-50 transition-colors shadow-sm whitespace-nowrap">
                        Lihat Semua <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($laporans as $index => $laporan)
                    <!-- Ticket Card -->
                    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:border-slate-300 transition-all duration-300 flex flex-col reveal" style="transition-delay: {{ ($index + 1) * 100 }}ms;">
                        <div class="px-5 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                            <div class="flex items-center gap-2">
                                @if($laporan->status === 'baru')
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                                    </span>
                                    <span class="text-[11px] font-bold text-rose-600 uppercase tracking-wider">Baru</span>
                                @elseif($laporan->status === 'diproses')
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                    </span>
                                    <span class="text-[11px] font-bold text-amber-700 uppercase tracking-wider">Diproses</span>
                                @else
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Selesai</span>
                                @endif
                            </div>
                            <span class="text-[11px] font-medium text-slate-400">#LPK-{{ $laporan->id }}</span>
                        </div>
                        <div class="p-5 flex-grow">
                            <h3 class="font-bold text-brand-900 text-lg mb-2 leading-tight">{{ $laporan->judul }}</h3>
                            <p class="text-slate-600 text-sm mb-4 line-clamp-3 leading-relaxed">{{ $laporan->deskripsi }}</p>
                        </div>
                        <div class="px-5 py-3 border-t border-slate-100 bg-white flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-medium text-slate-600">{{ $laporan->user ? $laporan->user->name : 'Anonim' }}</span>
                                <span class="text-slate-300 text-xs">•</span>
                                <span class="text-xs text-slate-400">{{ $laporan->lokasi ?? 'Lokasi tidak disebutkan' }}</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center py-10 text-slate-500">
                        Belum ada laporan terbaru dari warga.
                    </div>
                    @endforelse
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 pt-16 pb-8 md:pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 md:gap-8 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-brand-900 text-white p-1 rounded flex items-center justify-center">
                            <span class="material-symbols-outlined icon-filled text-[16px]">maps_ugc</span>
                        </div>
                        <span class="text-lg font-bold tracking-tight text-brand-900">Laporan<span class="text-brand-600">Kita</span></span>
                    </div>
                    <p class="text-sm text-slate-500 leading-relaxed max-w-sm mb-6">Membangun layanan masyarakat yang lebih baik melalui transparansi dan partisipasi publik.</p>
                    <!-- Social Media Links -->
                    <div class="flex items-center gap-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center hover:bg-brand-50 hover:text-brand-600 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center hover:bg-brand-50 hover:text-brand-600 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center hover:bg-brand-50 hover:text-brand-600 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                        </a>
                    </div>
                </div>
                <div id="kontak">
                    <h4 class="text-sm font-bold text-slate-900 mb-4 uppercase tracking-wider">Kontak Kami</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2 text-sm text-slate-500">
                            <span class="material-symbols-outlined text-[18px] text-brand-500 shrink-0 mt-0.5">location_on</span>
                            <span>Gd. Aspirasi Lt. 3<br/>Jl. Merdeka No. 1, Jakarta</span>
                        </li>
                        <li class="flex items-center gap-2 text-sm text-slate-500">
                            <span class="material-symbols-outlined text-[18px] text-brand-500 shrink-0">mail</span>
                            <a href="mailto:halo@laporankita.id" class="hover:text-brand-700 transition-colors">halo@laporankita.id</a>
                        </li>
                        <li class="flex items-center gap-2 text-sm text-slate-500">
                            <span class="material-symbols-outlined text-[18px] text-brand-500 shrink-0">call</span>
                            <span>1500-112 (Darurat)</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-900 mb-4 uppercase tracking-wider">Kebijakan</h4>
                    <ul class="space-y-3 text-sm text-slate-500">
                        <li><a href="{{ route('public.syarat') }}" class="hover:text-brand-700 transition-colors">Syarat &amp; Ketentuan</a></li>
                        <li><a href="{{ route('public.privasi') }}" class="hover:text-brand-700 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('public.prosedur') }}" class="hover:text-brand-700 transition-colors">Prosedur Laporan</a></li>
                        <li><a href="{{ route('public.faq') }}" class="hover:text-brand-700 transition-colors">FAQ / Bantuan</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-400">© 2026 LaporanKita. Seluruh hak cipta dilindungi.</p>
                <div class="flex items-center gap-1 text-xs font-semibold text-slate-400">
                    <span class="material-symbols-outlined text-[14px]">public</span> Untuk Indonesia Berkemajuan
                </div>
            </div>
        </div>
    </footer>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 0. Mobile Drawer & Notif Dropdown Logic
            const toggleBtn = document.getElementById('mobile-menu-toggle');
            const drawer = document.getElementById('mobile-drawer');
            const drawerContent = document.getElementById('drawer-content');
            const closeBtn = document.getElementById('close-drawer');
            const mobileLinks = document.querySelectorAll('.mobile-nav-link');

            // Notification Logic
            const notifToggle = document.getElementById('notif-toggle');
            const notifDropdown = document.getElementById('notif-dropdown');

            function openDrawer() {
                drawer.classList.remove('opacity-0', 'pointer-events-none');
                drawer.classList.add('opacity-100', 'pointer-events-auto');
                drawerContent.classList.remove('translate-x-full');
                drawerContent.classList.add('translate-x-0');
                document.body.classList.add('overflow-hidden');
            }

            function closeDrawer() {
                drawer.classList.remove('opacity-100', 'pointer-events-auto');
                drawer.classList.add('opacity-0', 'pointer-events-none');
                drawerContent.classList.remove('translate-x-0');
                drawerContent.classList.add('translate-x-full');
                document.body.classList.remove('overflow-hidden');
            }

            function toggleNotif() {
                const isOpen = !notifDropdown.classList.contains('opacity-0');
                if (isOpen) {
                    notifDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                    notifDropdown.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                } else {
                    notifDropdown.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                    notifDropdown.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
                }
            }

            toggleBtn?.addEventListener('click', openDrawer);
            closeBtn?.addEventListener('click', closeDrawer);
            notifToggle?.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleNotif();
            });

            document.addEventListener('click', (e) => {
                if (drawer && e.target === drawer) closeDrawer();
                if (notifDropdown && !notifDropdown.contains(e.target) && e.target !== notifToggle) {
                    notifDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                    notifDropdown.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                }
            });

            mobileLinks.forEach(link => {
                link.addEventListener('click', closeDrawer);
            });

            // 1. Reveal Elements on Scroll
            const observerOptions = { root: null, rootMargin: '0px', threshold: 0.1 };
            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-6');
                        observer.unobserve(entry.target); 
                    }
                });
            }, observerOptions);

            const revealElements = document.querySelectorAll('.reveal');
            revealElements.forEach(el => {
                el.classList.add('opacity-0', 'translate-y-6', 'transition-all', 'duration-700', 'ease-out');
                revealObserver.observe(el);
            });

            // 2. Scroll Spy Logic
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');
            const mobileLinksScroll = document.querySelectorAll('.mobile-nav-link');

            window.addEventListener('scroll', () => {
                let current = '';
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= (sectionTop - 150)) {
                        current = section.getAttribute('id');
                    }
                });

                // Update Desktop Links
                navLinks.forEach(link => {
                    link.classList.remove('text-brand-900', 'font-bold', 'border-brand-600');
                    link.classList.add('text-slate-500', 'font-medium', 'border-transparent');
                    
                    if (link.getAttribute('href').includes(current)) {
                        link.classList.add('text-brand-900', 'font-bold', 'border-brand-600');
                        link.classList.remove('text-slate-500', 'font-medium', 'border-transparent');
                    }
                });

                // Update Mobile Links
                mobileLinksScroll.forEach(link => {
                    link.classList.remove('text-brand-900', 'font-bold', 'border-brand-600', 'bg-slate-50');
                    link.classList.add('text-slate-600', 'font-medium', 'border-transparent', 'bg-transparent');
                    
                    if (link.getAttribute('href').includes(current)) {
                        link.classList.add('text-brand-900', 'font-bold', 'border-brand-600', 'bg-slate-50');
                        link.classList.remove('text-slate-600', 'font-medium', 'border-transparent', 'bg-transparent');
                    }
                });
            });
        });
    </script>
</body>
</html>