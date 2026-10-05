<header class="fixed top-0 left-0 right-0 z-50">
    {{-- Top Bar Info --}}
    <div class="w-full bg-primary text-on-primary py-space-xs">
        <div class="max-w-[1280px] mx-auto px-margin flex items-center justify-between font-body-sm text-body-sm">
            <div class="flex items-center gap-space-xs truncate">
                <span class="material-symbols-outlined text-[15px] shrink-0">verified</span>
                <span class="truncate">Portal Resmi Layanan Pelanggan PERUMDA Air Minum Tirta Kepri • Pemerintah Provinsi Kepulauan Riau</span>
            </div>
            <div class="hidden md:flex items-center gap-space-md shrink-0 font-label-sm text-label-sm">
                <span class="flex items-center gap-space-xs">
                    <span class="material-symbols-outlined text-[15px]">call</span>Call Center: (0771) 21555
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
        <div class="h-full max-w-[1280px] mx-auto px-margin flex items-center justify-between">
            {{-- Logo --}}
            <div class="flex items-center gap-space-md shrink-0">
                <img alt="Logo PERUMDA Air Minum Tirta Kepri" class="h-8 w-auto object-contain" src="{{asset('img/icon.jpg')}}">
                <div class="flex flex-col justify-center leading-tight">
                    <span class="font-title-md text-title-md text-primary font-bold tracking-tight uppercase">TIRTA KEPRI</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant font-medium tracking-wide">PERUMDA AIR MINUM PROV. KEPRI</span>
                </div>
            </div>

            {{-- Nav Links --}}
            <nav class="hidden xl:flex items-center gap-space-sm">
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
                        <span class="font-label-md text-label-md text-primary font-bold leading-tight">0811-778-2155</span>
                    </div>
                </div>
                <a href="{{ route('login') }}" class="w-9 h-9 rounded-full bg-primary hover:bg-on-primary-fixed-variant text-on-primary flex items-center justify-center transition-all shadow-sm focus:outline-none" title="Masuk ke Halaman Login">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                </a>
            </div>
        </div>
    </div>
    
</header>