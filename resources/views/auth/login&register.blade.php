<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Masuk / Daftar - LaporanKita</title>
    
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
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .icon-filled {
            font-variation-settings: 'FILL' 1;
        }
        .bg-dots { background-size: 20px 20px; }
        
        /* Smooth transitions for validation */
        .input-transition { transition: border-color 0.3s ease, box-shadow 0.3s ease; }
    </style>
</head>
<body class="bg-[#FAFAFA] text-slate-900 antialiased min-h-screen flex items-center justify-center p-4 bg-dots bg-dot-pattern bg-[length:24px_24px] relative selection:bg-brand-500 selection:text-white">

    <!-- Subtle gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-white/60 via-[#FAFAFA]/90 to-[#FAFAFA] pointer-events-none"></div>

    <!-- Back to home -->
    <a href="/" class="absolute top-6 left-6 md:top-8 md:left-8 flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-brand-900 transition-colors z-10">
        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        <span class="hidden sm:inline">Kembali ke Beranda</span>
    </a>

    <!-- Main Auth Card -->
    <div class="w-full max-w-md bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-slate-200 overflow-hidden relative z-10 animate-[fadeInUp_0.5s_ease-out]">
        <!-- Top Accent Line -->
        <div class="h-1.5 w-full bg-gradient-to-r from-brand-500 to-teal-400"></div>

        <div class="p-8">
            <!-- Logo & Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center bg-brand-900 text-white p-2.5 rounded-xl mb-4 shadow-sm">
                    <span class="material-symbols-outlined icon-filled text-2xl">maps_ugc</span>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-brand-900 mb-1" id="auth-title">Selamat Datang Kembali</h1>
                <p class="text-sm text-slate-500 font-medium" id="auth-subtitle">Masuk untuk melanjutkan aspirasi Anda.</p>
            </div>

            <!-- Custom Tabs -->
            <div class="flex p-1 bg-slate-100 rounded-lg mb-8">
                <button id="tab-login" class="flex-1 py-2 text-sm font-semibold rounded-md bg-white text-brand-900 shadow-sm transition-all" onclick="switchTab('login')">Masuk</button>
                <button id="tab-register" class="flex-1 py-2 text-sm font-semibold rounded-md text-slate-500 hover:text-slate-700 transition-all" onclick="switchTab('register')">Daftar Akun</button>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-start gap-3 shadow-sm animate-[fadeInDown_0.3s_ease-out]">
                <span class="material-symbols-outlined icon-filled text-emerald-500 mt-0.5">check_circle</span>
                <p class="text-sm font-semibold leading-relaxed">{{ session('success') }}</p>
            </div>
            @endif
            @if(session('error'))
            <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl flex items-start gap-3 shadow-sm animate-[fadeInDown_0.3s_ease-out]">
                <span class="material-symbols-outlined icon-filled text-rose-500 mt-0.5">error</span>
                <p class="text-sm font-semibold leading-relaxed">{{ session('error') }}</p>
            </div>
            @endif

            <!-- ==================== LOGIN FORM ==================== -->
            <form id="form-login" class="space-y-5 block" action="{{ route('login.post') }}" method="POST">
                @csrf
                <!-- Email Field -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Alamat Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
                        <input type="email" name="email" id="login-email" class="w-full pl-10 pr-10 py-3.5 bg-slate-50 border @error('email') border-rose-300 bg-rose-50 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-transition" placeholder="nama@email.com" value="{{ old('email') }}" required />
                        <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-emerald-500 text-[20px] hidden" id="login-email-check">check_circle</span>
                    </div>
                    @error('email')
                        <p class="text-[11px] text-rose-500 mt-1.5 font-medium">{{ $message }}</p>
                    @else
                        <p class="text-[11px] text-rose-500 mt-1.5 hidden font-medium" id="login-email-error">Format email tidak valid</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wide">Kata Sandi</label>
                        <a href="#" class="text-[11px] font-semibold text-brand-600 hover:text-brand-800 transition-colors">Lupa sandi?</a>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                        <input type="password" name="password" id="login-password" class="w-full pl-10 pr-12 py-3.5 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-transition" placeholder="••••••••" required />
                        <!-- Toggle Password Visibility -->
                        <button type="button" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none toggle-password">
                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-brand-900 text-white py-3.5 rounded-lg text-sm font-semibold shadow-md hover:bg-slate-800 hover:shadow-lg transition-all active:scale-[0.98] flex items-center justify-center gap-2 mt-2">
                    Masuk Sekarang <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </button>
            </form>

            <!-- ==================== REGISTER FORM ==================== -->
            <form id="form-register" class="space-y-4 hidden" action="{{ route('register') }}" method="POST">
                @csrf
                <!-- Nama Lengkap Field -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Nama Lengkap</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">person</span>
                        <input type="text" name="name" id="reg-name" class="w-full pl-10 pr-10 py-3 bg-slate-50 border @error('name') border-rose-300 bg-rose-50 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-transition" placeholder="Sesuai KTP" value="{{ old('name') }}" required />
                        <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-emerald-500 text-[20px] hidden" id="reg-name-check">check_circle</span>
                    </div>
                    @error('name')
                        <p class="text-[11px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @else
                        <p class="text-[11px] text-rose-500 mt-1 hidden font-medium" id="reg-name-error">Nama tidak boleh kosong</p>
                    @enderror
                </div>

                <!-- No HP Field -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Nomor WhatsApp / HP</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">call</span>
                        <input type="tel" name="phone" id="reg-phone" class="w-full pl-10 pr-10 py-3 bg-slate-50 border border-slate-200 rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-transition" placeholder="08xxxxxxxxx" value="{{ old('phone') }}" />
                        <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-emerald-500 text-[20px] hidden" id="reg-phone-check">check_circle</span>
                    </div>
                    <p class="text-[11px] text-rose-500 mt-1 hidden font-medium" id="reg-phone-error">Minimal 10 digit angka</p>
                </div>

                <!-- Email Field -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Alamat Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">mail</span>
                        <input type="email" name="email" id="reg-email" class="w-full pl-10 pr-10 py-3 bg-slate-50 border @error('email') border-rose-300 bg-rose-50 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-transition" placeholder="nama@email.com" value="{{ old('email') }}" required />
                        <span class="material-symbols-outlined absolute right-3.5 top-1/2 -translate-y-1/2 text-emerald-500 text-[20px] hidden" id="reg-email-check">check_circle</span>
                    </div>
                    @error('email')
                        <p class="text-[11px] text-rose-500 mt-1 font-medium">{{ $message }}</p>
                    @else
                        <p class="text-[11px] text-rose-500 mt-1 hidden font-medium" id="reg-email-error">Format email tidak valid</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5 uppercase tracking-wide">Buat Kata Sandi</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">lock</span>
                        <input type="password" name="password" id="reg-password" class="w-full pl-10 pr-12 py-3 bg-slate-50 border @error('password') border-rose-300 bg-rose-50 @else border-slate-200 @enderror rounded-lg text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 input-transition" placeholder="Minimal 8 karakter" required minlength="8" />
                        <button type="button" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none toggle-password">
                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </div>
                    <!-- Password strength indicator -->
                    <div class="flex gap-1 mt-2 h-1 w-full hidden" id="pw-strength-bar">
                        <div class="h-full flex-1 rounded-full bg-slate-200 transition-colors" id="pw-bar-1"></div>
                        <div class="h-full flex-1 rounded-full bg-slate-200 transition-colors" id="pw-bar-2"></div>
                        <div class="h-full flex-1 rounded-full bg-slate-200 transition-colors" id="pw-bar-3"></div>
                    </div>
                    <p class="text-[10px] text-slate-500 mt-1.5 font-medium" id="reg-password-hint">Gunakan kombinasi huruf dan angka.</p>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-brand-900 text-white py-3.5 rounded-lg text-sm font-semibold shadow-md hover:bg-slate-800 hover:shadow-lg transition-all active:scale-[0.98] flex items-center justify-center gap-2 mt-4" id="btn-register">
                    Buat Akun <span class="material-symbols-outlined text-[18px]">person_add</span>
                </button>
                
                <p class="text-[10px] text-center text-slate-500 mt-4 leading-relaxed">
                    Dengan mendaftar, Anda menyetujui <a href="#" class="text-brand-600 hover:underline">Syarat Ketentuan</a> dan <a href="#" class="text-brand-600 hover:underline">Kebijakan Privasi</a> kami.
                </p>
            </form>

            <!-- Divider -->
            <div class="mt-8 mb-6 relative flex items-center justify-center">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-200"></div></div>
                <div class="relative bg-white px-3 text-[11px] font-semibold text-slate-400 uppercase tracking-widest">Atau gunakan</div>
            </div>

            <!-- SSO Options -->
            <div class="grid grid-cols-2 gap-3">
                <button class="flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 15.02 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                    <span class="text-sm font-semibold text-slate-700">Google</span>
                </button>
                <button class="flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors">
                    <svg class="w-5 h-5 text-slate-900" fill="currentColor" viewBox="0 0 24 24"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.04 2.34-.78 3.86-.67 1.34.05 2.53.64 3.25 1.62-2.91 1.76-2.4 5.39.46 6.55-.66 1.77-1.57 3.54-2.65 4.67zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.32 2.31-2.03 4.29-3.74 4.25z"/></svg>
                    <span class="text-sm font-semibold text-slate-700">Apple</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts for UI/UX Logic -->
    <script>
        // --- Tab Switching Logic ---
        const authTitle = document.getElementById('auth-title');
        const authSubtitle = document.getElementById('auth-subtitle');
        const formLogin = document.getElementById('form-login');
        const formRegister = document.getElementById('form-register');
        const tabLogin = document.getElementById('tab-login');
        const tabRegister = document.getElementById('tab-register');

        function switchTab(tab) {
            if (tab === 'login') {
                formRegister.classList.add('hidden');
                formLogin.classList.remove('hidden');
                
                tabRegister.classList.replace('bg-white', 'transparent');
                tabRegister.classList.replace('text-brand-900', 'text-slate-500');
                tabRegister.classList.remove('shadow-sm');
                
                tabLogin.classList.add('bg-white', 'text-brand-900', 'shadow-sm');
                tabLogin.classList.remove('text-slate-500');

                authTitle.textContent = 'Selamat Datang Kembali';
                authSubtitle.textContent = 'Masuk untuk melanjutkan aspirasi Anda.';
            } else {
                formLogin.classList.add('hidden');
                formRegister.classList.remove('hidden');
                
                tabLogin.classList.replace('bg-white', 'transparent');
                tabLogin.classList.replace('text-brand-900', 'text-slate-500');
                tabLogin.classList.remove('shadow-sm');
                
                tabRegister.classList.add('bg-white', 'text-brand-900', 'shadow-sm');
                tabRegister.classList.remove('text-slate-500');

                authTitle.textContent = 'Mulai Perubahan';
                authSubtitle.textContent = 'Daftar sekarang untuk mulai melapor.';
            }
        }

        // If page loaded with success message (after registration), force switch to Login tab
        @if(session('success'))
            switchTab('login');
        @elseif($errors->has('name') || $errors->has('phone') || $errors->has('password') && !$errors->has('email'))
            // Optional: If there are register specific errors, force switch to Register, 
            // but for simplicity we rely on user clicking. If we want auto-switch if register fails:
            @if(old('name')) 
                switchTab('register'); 
            @endif
        @endif

        // --- Toggle Password Visibility ---
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('span');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.textContent = 'visibility_off';
                    icon.classList.add('text-brand-600');
                } else {
                    input.type = 'password';
                    icon.textContent = 'visibility';
                    icon.classList.remove('text-brand-600');
                }
            });
        });

        // --- Real-time Validation Utility Functions ---
        function setValid(inputEl, checkIconEl, errorTextEl) {
            inputEl.classList.remove('border-rose-300', 'focus:ring-rose-500/20', 'focus:border-rose-500', 'bg-rose-50');
            inputEl.classList.add('border-slate-200', 'focus:ring-brand-500/20', 'focus:border-brand-500');
            if(checkIconEl) checkIconEl.classList.remove('hidden');
            if(errorTextEl) errorTextEl.classList.add('hidden');
            return true;
        }

        function setInvalid(inputEl, checkIconEl, errorTextEl) {
            inputEl.classList.add('border-rose-300', 'focus:ring-rose-500/20', 'focus:border-rose-500', 'bg-rose-50');
            inputEl.classList.remove('border-slate-200', 'focus:ring-brand-500/20', 'focus:border-brand-500');
            if(checkIconEl) checkIconEl.classList.add('hidden');
            if(errorTextEl) errorTextEl.classList.remove('hidden');
            return false;
        }

        function clearValidation(inputEl, checkIconEl, errorTextEl) {
            inputEl.classList.remove('border-rose-300', 'focus:ring-rose-500/20', 'focus:border-rose-500', 'bg-rose-50');
            inputEl.classList.add('border-slate-200', 'focus:ring-brand-500/20', 'focus:border-brand-500');
            if(checkIconEl) checkIconEl.classList.add('hidden');
            if(errorTextEl) errorTextEl.classList.add('hidden');
        }

        // Regex patterns
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phonePattern = /^[0-9]{10,14}$/;

        // --- Login Validations ---
        const loginEmail = document.getElementById('login-email');
        loginEmail.addEventListener('input', (e) => {
            const val = e.target.value.trim();
            if (val === '') clearValidation(loginEmail, document.getElementById('login-email-check'), document.getElementById('login-email-error'));
            else if (emailPattern.test(val)) setValid(loginEmail, document.getElementById('login-email-check'), document.getElementById('login-email-error'));
            else setInvalid(loginEmail, document.getElementById('login-email-check'), document.getElementById('login-email-error'));
        });

        // --- Register Validations ---
        const regName = document.getElementById('reg-name');
        regName.addEventListener('input', (e) => {
            const val = e.target.value.trim();
            if (val === '') clearValidation(regName, document.getElementById('reg-name-check'), document.getElementById('reg-name-error'));
            else if (val.length >= 3) setValid(regName, document.getElementById('reg-name-check'), document.getElementById('reg-name-error'));
            else setInvalid(regName, document.getElementById('reg-name-check'), document.getElementById('reg-name-error'));
        });

        const regPhone = document.getElementById('reg-phone');
        regPhone.addEventListener('input', (e) => {
            // Remove non-numeric characters for checking
            const val = e.target.value.replace(/\D/g, '');
            if (e.target.value === '') clearValidation(regPhone, document.getElementById('reg-phone-check'), document.getElementById('reg-phone-error'));
            else if (phonePattern.test(val)) setValid(regPhone, document.getElementById('reg-phone-check'), document.getElementById('reg-phone-error'));
            else setInvalid(regPhone, document.getElementById('reg-phone-check'), document.getElementById('reg-phone-error'));
        });

        const regEmail = document.getElementById('reg-email');
        regEmail.addEventListener('input', (e) => {
            const val = e.target.value.trim();
            if (val === '') clearValidation(regEmail, document.getElementById('reg-email-check'), document.getElementById('reg-email-error'));
            else if (emailPattern.test(val)) setValid(regEmail, document.getElementById('reg-email-check'), document.getElementById('reg-email-error'));
            else setInvalid(regEmail, document.getElementById('reg-email-check'), document.getElementById('reg-email-error'));
        });

        // Register Password Strength
        const regPassword = document.getElementById('reg-password');
        const pwStrengthBar = document.getElementById('pw-strength-bar');
        const bar1 = document.getElementById('pw-bar-1');
        const bar2 = document.getElementById('pw-bar-2');
        const bar3 = document.getElementById('pw-bar-3');
        const pwHint = document.getElementById('reg-password-hint');

        regPassword.addEventListener('input', (e) => {
            const val = e.target.value;
            if (val === '') {
                pwStrengthBar.classList.add('hidden');
                pwHint.classList.remove('text-rose-500', 'text-amber-500', 'text-emerald-500');
                pwHint.classList.add('text-slate-500');
                pwHint.textContent = 'Gunakan kombinasi huruf dan angka.';
                return;
            }

            pwStrengthBar.classList.remove('hidden');
            let strength = 0;
            if (val.length >= 8) strength++;
            if (/[A-Za-z]/.test(val) && /[0-9]/.test(val)) strength++;
            if (/[^A-Za-z0-9]/.test(val)) strength++; // special char

            // Reset bars
            bar1.className = 'h-full flex-1 rounded-full transition-colors bg-slate-200';
            bar2.className = 'h-full flex-1 rounded-full transition-colors bg-slate-200';
            bar3.className = 'h-full flex-1 rounded-full transition-colors bg-slate-200';
            pwHint.classList.remove('text-slate-500', 'text-rose-500', 'text-amber-500', 'text-emerald-500');

            if (strength === 0 || (val.length > 0 && val.length < 8)) {
                bar1.classList.replace('bg-slate-200', 'bg-rose-500');
                pwHint.classList.add('text-rose-500');
                pwHint.textContent = 'Terlalu pendek (Min. 8 karakter)';
            } else if (strength === 1) {
                bar1.classList.replace('bg-slate-200', 'bg-amber-400');
                bar2.classList.replace('bg-slate-200', 'bg-amber-400');
                pwHint.classList.add('text-amber-500');
                pwHint.textContent = 'Sedang (Tambahkan angka/simbol)';
            } else if (strength >= 2) {
                bar1.classList.replace('bg-slate-200', 'bg-emerald-500');
                bar2.classList.replace('bg-slate-200', 'bg-emerald-500');
                bar3.classList.replace('bg-slate-200', 'bg-emerald-500');
                pwHint.classList.add('text-emerald-500');
                pwHint.textContent = 'Sandi kuat!';
            }
        });
    </script>
</body>
</html>