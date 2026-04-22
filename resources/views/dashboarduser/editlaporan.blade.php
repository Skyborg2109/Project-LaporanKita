<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Edit Laporan - LaporanKita</title>
    
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
                <span class="text-lg font-bold tracking-tight text-brand-900">Edit Laporan</span>
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
                <div class="relative" x-data="{ open: false }" id="notif-wrapper">
                    <button onclick="toggleNotifDropdown()" class="p-2 text-slate-400 hover:text-brand-600 hover:bg-brand-50 rounded-full transition-all relative">
                        <span class="material-symbols-outlined">notifications</span>
                        @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full border-2 border-white" id="notif-dot"></span>
                        @endif
                    </button>
                    <div id="notif-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-100 z-50 overflow-hidden">
                        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="font-bold text-sm text-slate-900">Notifikasi</h3>
                            @if(isset($unreadCount) && $unreadCount > 0)
                            <a href="{{ route('dashboarduser.notifikasi') }}" class="text-[11px] text-brand-600 hover:underline font-semibold">Tandai semua dibaca</a>
                            @endif
                        </div>
                        <div class="max-h-64 overflow-y-auto divide-y divide-slate-50">
                            <div class="px-4 py-8 text-center text-slate-400 text-xs">Belum ada notifikasi baru</div>
                        </div>
                        <div class="px-4 py-2 border-t border-slate-100 text-center">
                            <a href="{{ route('dashboarduser.notifikasi') }}" class="text-xs text-brand-600 hover:underline font-semibold">Lihat semua notifikasi &rarr;</a>
                        </div>
                    </div>
                </div>

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
            
            <div id="main-content" class="max-w-3xl mx-auto transition-opacity duration-500">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-extrabold text-brand-900 tracking-tight mb-1">Edit Laporan Anda</h1>
                        <p class="text-sm text-slate-500 font-medium">Perbarui detail laporan Anda sebelum diproses oleh petugas.</p>
                    </div>
                    <a href="{{ route('dashboarduser.laporan') }}" class="text-sm font-bold text-brand-600 hover:text-brand-900 flex items-center gap-1 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali
                    </a>
                </div>

                <!-- Form Card -->
                <form id="report-form" class="bg-white rounded-2xl border border-slate-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden" action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="p-6 sm:p-8 space-y-6">
                        
                        <!-- 1. Judul & Kategori -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Judul Laporan <span class="text-rose-500">*</span></label>
                                <input type="text" name="judul" value="{{ old('judul', $laporan->judul) }}" placeholder="Contoh: Jalan berlubang di Jl. Sudirman" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus text-brand-900 font-medium placeholder:font-normal" required />
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Kategori <span class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <select name="kategori" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus appearance-none text-slate-700 font-medium" required>
                                        <option value="infrastruktur" {{ $laporan->kategori == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                        <option value="kebersihan" {{ $laporan->kategori == 'kebersihan' ? 'selected' : '' }}>Kebersihan & Lingkungan</option>
                                        <option value="ketertiban" {{ $laporan->kategori == 'ketertiban' ? 'selected' : '' }}>Ketertiban Umum</option>
                                        <option value="fasilitas" {{ $laporan->kategori == 'fasilitas' ? 'selected' : '' }}>Fasilitas Publik</option>
                                        <option value="lainnya" {{ $laporan->kategori == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">expand_more</span>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Deskripsi -->
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">Deskripsi Detail <span class="text-rose-500">*</span></label>
                                <span class="text-[10px] text-slate-400 font-medium" id="char-count">{{ strlen($laporan->deskripsi) }}/500</span>
                            </div>
                            <textarea name="deskripsi" id="desc-input" rows="5" placeholder="Ceritakan detail masalah..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus resize-none text-slate-700 leading-relaxed" required maxlength="500">{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
                        </div>

                        <!-- 3. Lokasi -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Titik Lokasi</label>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="relative flex-1">
                                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">location_on</span>
                                    <input type="text" name="lokasi" id="input-location" value="{{ old('lokasi', $laporan->lokasi) }}" placeholder="Ketik alamat atau nama jalan..." class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-focus text-slate-700" />
                                </div>
                                <button type="button" id="btn-detect-location" class="flex items-center justify-center gap-2 px-4 py-3 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:border-brand-300 transition-colors text-brand-900 font-semibold text-sm shrink-0 shadow-sm">
                                    <span class="material-symbols-outlined text-[18px]">my_location</span>
                                    <span>Deteksi Lokasi</span>
                                </button>
                            </div>
                        </div>

                        <!-- 4. Upload Foto -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wide">Update Bukti Foto <span class="text-slate-400 font-normal italic">(Biarkan kosong jika tidak ingin mengubah foto)</span></label>
                            
                            <!-- Existing Photos Preview -->
                            @if($laporan->foto)
                            <div class="mb-4">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Foto Saat Ini:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($laporan->foto as $img)
                                    <div class="w-20 h-20 rounded-lg overflow-hidden border border-slate-200 shadow-sm">
                                        <img src="{{ str_starts_with($img, 'http') ? $img : Storage::url($img) }}" class="w-full h-full object-cover" />
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div id="drop-zone" class="relative border-2 border-dashed border-slate-300 rounded-xl bg-slate-50 p-8 text-center hover:bg-brand-50 hover:border-brand-400 transition-all cursor-pointer group flex flex-col items-center justify-center">
                                <input type="file" name="foto[]" id="file-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/png, image/jpeg, image/jpg" multiple />
                                
                                <div class="w-12 h-12 mb-3 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-400 group-hover:text-brand-600 transition-colors border border-slate-100">
                                    <span class="material-symbols-outlined text-[24px]">cloud_upload</span>
                                </div>
                                <p class="text-sm font-bold text-brand-900 mb-1 group-hover:text-brand-700">Ganti foto dengan menarik foto baru ke sini</p>
                                <p class="text-xs text-slate-500 font-medium">Foto baru akan menggantikan foto lama sepenuhnya.</p>
                            </div>

                            <div id="preview-list-container" class="hidden mt-6 space-y-3">
                                <div class="flex items-center justify-between px-1">
                                    <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Foto Baru Terpilih</h4>
                                    <button type="button" id="btn-clear-all" class="text-[10px] font-bold text-rose-500 hover:text-rose-700 uppercase tracking-tighter">Hapus Semua</button>
                                </div>
                                <div id="preview-items" class="grid grid-cols-1 gap-3"></div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="px-6 sm:px-8 py-5 bg-slate-50 border-t border-slate-200 flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                        <a href="{{ route('dashboarduser.laporan') }}" class="w-full sm:w-auto px-6 py-2.5 bg-white border border-slate-300 text-slate-700 rounded-lg text-sm font-semibold hover:bg-slate-50 hover:text-brand-900 text-center transition-all">
                            Batalkan
                        </a>
                        <button type="submit" class="w-full sm:w-auto px-8 py-2.5 bg-brand-900 text-white rounded-lg text-sm font-semibold hover:bg-slate-800 shadow-md hover:shadow-lg transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            Simpan Perubahan <span class="material-symbols-outlined text-[18px]">save</span>
                        </button>
                    </div>
                </form>
            </div>
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
            <a href="{{ route('laporan.create') }}" class="bg-brand-900 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-[0_8px_20px_-6px_rgba(15,23,42,0.6)] border-[4px] border-[#FAFAFA]">
                <span class="material-symbols-outlined icon-filled text-[28px]">add</span>
            </a>
        </div>
        <a href="{{ route('dashboarduser.profil') }}" class="flex flex-col items-center text-slate-400 hover:text-brand-900 transition-colors w-16 pt-2 relative">
            <span class="material-symbols-outlined text-[24px]">person</span>
            <span class="text-[10px] font-medium mt-1 tracking-wide">Profil</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="inline w-16 pt-2">
            @csrf
            <button type="submit" class="flex flex-col items-center w-full text-slate-400 hover:text-rose-600 transition-colors">
                <span class="material-symbols-outlined text-[24px]">logout</span>
                <span class="text-[10px] font-medium mt-1 tracking-wide">Keluar</span>
            </button>
        </form>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const descInput = document.getElementById('desc-input');
            const charCount = document.getElementById('char-count');
            
            descInput.addEventListener('input', function() {
                charCount.textContent = `${this.value.length}/500`;
            });

            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('file-input');
            const previewListContainer = document.getElementById('preview-list-container');
            const previewItems = document.getElementById('preview-items');
            const btnClearAll = document.getElementById('btn-clear-all');

            fileInput.addEventListener('change', function() {
                handleFiles(Array.from(this.files));
            });

            function handleFiles(files) {
                previewItems.innerHTML = '';
                if (files.length === 0) {
                    previewListContainer.classList.add('hidden');
                    return;
                }
                previewListContainer.classList.remove('hidden');
                files.forEach((file) => {
                    const item = document.createElement('div');
                    item.className = 'bg-white border border-slate-200 rounded-xl p-3 flex items-center gap-4 shadow-sm';
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        item.innerHTML = `
                            <div class="w-14 h-14 rounded-lg overflow-hidden bg-slate-100 shrink-0 border border-slate-200">
                                <img src="${e.target.result}" class="w-full h-full object-cover" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-brand-900 truncate">${file.name}</p>
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
        });

        function toggleNotifDropdown() {
            const dropdown = document.getElementById('notif-dropdown');
            dropdown.classList.toggle('hidden');
        }
    </script>
</body>
</html>
