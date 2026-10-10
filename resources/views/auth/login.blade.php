<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PERUMDA Tirta Kepri</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#006689',
                    },
                    keyframes: {
                        shine: {
                            '100%': { transform: 'translateX(100%)' }
                        },
                        slideInLeft: {
                            '0%': { opacity: '0', transform: 'translateX(-40px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' }
                        },
                        bgFadeIn: {
                            '0%': { opacity: '0', transform: 'scale(1.05)' },
                            '100%': { opacity: '1', transform: 'scale(1)' }
                        }
                    },
                    animation: {
                        'slide-in': 'slideInLeft 1.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        'bg-fade': 'bgFadeIn 2.5s ease-out forwards'
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom Input Autofill styling for Glassmorphism */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            -webkit-text-fill-color: #081e2a !important;
            border-radius: 0.75rem;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-900">

    <div class="min-h-screen relative flex items-center justify-start px-6 sm:px-16 md:px-24 lg:px-40 overflow-hidden">
        
        <!-- Full Background Image with Overlay -->
        <div class="absolute inset-0 z-0 animate-bg-fade opacity-0">
            <img src="{{ asset('img/background.jpg') }}" alt="Background" class="w-full h-full object-cover transform transition-transform duration-[20s] ease-out hover:scale-110">
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
        </div>

        <!-- Card Container with Entrance Animation -->
        <div class="w-full max-w-[420px] z-10 animate-slide-in opacity-0">
            <!-- Glassmorphism Login Card -->
            <div class="relative w-full bg-white/60 backdrop-blur-xl border border-white/40 shadow-[0_8px_32px_0_rgba(0,0,0,0.3)] rounded-[2rem] p-8 sm:p-10 transition-all duration-500 hover:shadow-[0_12px_48px_0_rgba(0,0,0,0.4)] hover:bg-white/70 hover:-translate-y-1">
            
            <!-- Logo & Brand -->
            <div class="mb-10 text-center flex flex-col items-center">
                <div class="w-20 h-20 bg-white rounded-2xl shadow-md p-3 mb-4 flex items-center justify-center transform transition hover:rotate-3">
                    <img src="{{ asset('img/icon.png') }}" alt="Logo Tirta Kepri" class="w-full h-full object-contain" onerror="this.src='{{ asset('img/logo tirta.png') }}'">
                </div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Portal Admin</h1>
                <p class="text-sm text-gray-700 mt-1 font-medium">PERUMDA Air Minum Tirta Kepri</p>
            </div>

            <!-- Session Status Alert -->
            @if (session('status'))
                <div class="mb-6 p-4 rounded-xl bg-green-50/80 border border-green-200 text-green-600 text-sm font-semibold flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-sm font-semibold text-gray-800">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">mail</span>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="block w-full pl-11 pr-4 py-3.5 bg-white/80 border border-white/50 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm"
                            placeholder="nama@tirtakepri.co.id">
                    </div>
                    @error('email')
                        <p class="text-red-600 text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-semibold text-gray-800">Kata Sandi</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-primary hover:text-blue-900 transition-colors">Lupa sandi?</a>
                        @endif
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">lock</span>
                        </div>
                        <input id="password" type="password" name="password" required
                            class="block w-full pl-11 pr-4 py-3.5 bg-white/80 border border-white/50 rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm"
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="text-red-600 text-xs font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <label class="relative flex items-center cursor-pointer">
                        <input type="checkbox" name="remember" class="peer sr-only" id="remember_me">
                        <div class="w-5 h-5 bg-white/80 border-2 border-gray-400 rounded-md peer-focus:ring-2 peer-focus:ring-primary/30 peer-checked:bg-primary peer-checked:border-primary transition-all flex items-center justify-center">
                            <span class="material-symbols-outlined text-[14px] text-white opacity-0 peer-checked:opacity-100 transition-opacity">check</span>
                        </div>
                        <span class="ml-2.5 text-sm font-medium text-gray-800 select-none">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="group relative w-full flex items-center justify-center gap-2 py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-primary hover:bg-[#004c68] hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary overflow-hidden transform transition-all active:scale-[0.98]">
                    <!-- Shine Effect -->
                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent group-hover:animate-[shine_1.5s_ease-in-out_infinite]"></div>
                    
                    <span class="relative z-10">Masuk</span>
                    <span class="material-symbols-outlined text-[20px] relative z-10 transform transition-transform group-hover:translate-x-1.5"></span>
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-xs text-gray-600 font-medium tracking-wide">
                    &copy; {{ date('Y') }} PERUMDA Air Minum Tirta Kepri.
                </p>
            </div>
            </div>
        </div>

    </div>

</body>
</html>


