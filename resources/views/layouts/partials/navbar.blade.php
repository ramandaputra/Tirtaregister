@php
    // Ambil setting dari database
    $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
@endphp


<header class="fixed top-0 left-0 right-0 z-50">
    {{-- Top Bar Info --}}
    <div class="w-full bg-primary text-on-primary py-space-xs">
        <div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin flex items-center justify-between font-body-sm text-body-sm">
            <div class="flex items-center gap-space-xs truncate">
                <span class="material-symbols-outlined text-[15px] shrink-0">verified</span>
                <span class="truncate max-w-[200px] md:max-w-full">{{ $settings['navbar_topbar_text'] ?? setting('navbar_topbar_text', 'Portal Resmi Layanan Pelanggan PERUMDA Air Minum Tirta Kepri • Pemerintah Provinsi Kepulauan Riau') }}</span>
            </div>
            <div class="hidden md:flex items-center gap-space-md shrink-0 font-label-sm text-label-sm">
                <span class="flex items-center gap-space-xs">
                    <span class="material-symbols-outlined text-[15px]">call</span>Call Center: {{ $settings['navbar_call_center'] ?? setting('navbar_call_center', '(0771) 21555') }}
                </span>
                <span class="opacity-50">•</span>
                <span class="flex items-center gap-space-xs">
                    <span class="material-symbols-outlined text-[15px]">schedule</span>Layanan 24 Jam
                </span>
            </div>
        </div>
    </div>

    {{-- Main Navbar --}}
    <div class="h-20 bg-surface-container-lowest shadow-[0_1px_8px_rgba(28,34,62,0.06)]">
        <div class="h-full max-w-[1280px] mx-auto px-margin-mobile md:px-margin flex items-center justify-between">
            {{-- Logo --}}
            <div class="flex items-center gap-space-md shrink-0">
                <img alt="Logo PERUMDA Air Minum Tirta Kepri" class="h-8 w-auto object-contain rounded" src="{{ setting('site_icon') ? asset('storage/' . setting('site_icon')) : asset('img/icon.jpg') }}">
                <div class="flex flex-col justify-center leading-tight">
                    <span class="font-title-md text-title-md text-primary font-bold tracking-tight uppercase">{{ strtoupper($settings['company_short_name'] ?? setting('company_short_name', 'TIRTA KEPRI')) }}</span>
                    <span class="hidden sm:block font-label-sm text-label-sm text-on-surface-variant font-medium tracking-wide">PERUMDA AIR MINUM PROV. KEPRI</span>
                </div>
            </div>

            {{-- Nav Links --}}
            <nav class="hidden lg:flex items-center gap-space-sm">
                <a class="px-space-sm py-space-xs rounded-lg font-label-md text-label-md {{ request()->routeIs('home') ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }} transition-all" href="/">
                    Beranda
                </a>
                <a class="px-space-sm py-space-xs rounded-lg font-label-md text-label-md {{ request()->routeIs('news.*') ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface' }} transition-all" href="{{ route('news.index') }}">
                    Berita &amp; Pengumuman
                </a>
                <a class="px-space-sm py-space-xs rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-all" href="https://www.tirtakepri.co.id" target="_blank">
                    Tentang Kami
                </a>
            </nav>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-space-md shrink-0">
                <div class="hidden lg:flex items-center gap-space-xs px-space-sm py-space-xs rounded-full bg-surface-container-low">
                    <span class="material-symbols-outlined text-status-success text-[18px]">support_agent</span>
                    <div class="flex flex-col text-left pr-space-xs">
                        <span class="font-label-sm text-label-sm text-on-surface-variant leading-none">Pengaduan WA</span>
                        <span class="font-label-md text-label-md text-primary font-bold leading-tight">{{ $settings['navbar_wa_center'] ?? setting('navbar_wa_center', '0811-778-2155') }}</span>
                    </div>
                </div>
                <a href="{{ route('login') }}" class="w-9 h-9 rounded-full bg-primary hover:bg-on-primary-fixed-variant text-on-primary flex items-center justify-center transition-all shadow-sm focus:outline-none" title="Masuk ke Halaman Login">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                </a>
                {{-- Hamburger Button --}}
                <button id="mobile-menu-btn" class="lg:hidden p-1 text-primary focus:outline-none rounded-lg hover:bg-surface-container-low transition-colors">
                    <span class="material-symbols-outlined text-[26px]">menu</span>
                </button>
            </div>
        </div>
    </div>
    
    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-surface-container-lowest border-t border-surface-border shadow-md absolute w-full left-0 top-full flex flex-col p-4 gap-2">
         <a href="/" class="font-label-md text-label-md py-2 border-b border-surface-border {{ request()->routeIs('home') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">Beranda</a>
         <a href="{{ route('news.index') }}" class="font-label-md text-label-md py-2 border-b border-surface-border {{ request()->routeIs('news.*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">Berita &amp; Pengumuman</a>
         <a href="https://www.tirtakepri.co.id" class="font-label-md text-label-md py-2 border-b border-surface-border text-on-surface-variant" target="_blank">Tentang Kami</a>
         
         <div class="mt-4 flex items-center gap-3 p-3 rounded-lg bg-surface-container-low border border-surface-border">
            <span class="material-symbols-outlined text-status-success text-[18px]">support_agent</span>
            <div class="flex flex-col text-left pr-space-xs">
                <span class="font-label-sm text-label-sm text-on-surface-variant leading-none">Layanan Pengaduan WA</span>
                <span class="font-label-md text-label-md text-primary font-bold leading-tight mt-1">{{ $settings['navbar_wa_center'] ?? setting('navbar_wa_center', '0811-778-2155') }}</span>
            </div>
         </div>
    </div>
    
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            if(menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                this.innerHTML = '<span class="material-symbols-outlined text-[26px]">close</span>';
            } else {
                menu.classList.add('hidden');
                this.innerHTML = '<span class="material-symbols-outlined text-[26px]">menu</span>';
            }
        });
    </script>
</header>