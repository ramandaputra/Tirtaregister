@php
    $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['site_title'] ?? setting('site_title', 'Portal Resmi - PERUMDA Air Minum Tirta Kepri') }}</title>

    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">

    <!-- Tailwind Config & Script -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#006689",
                        "civic-amber": "#FFC10D",
                        "on-tertiary-fixed": "#001f23",
                        "error": "#ba1a1a",
                        "on-secondary-container": "#585d7d",
                        "status-success": "#0F9D58",
                        "surface-container-low": "#eaf5ff",
                        "outline": "#6e7980",
                        "tertiary-fixed-dim": "#75d5e2",
                        "on-error-container": "#93000a",
                        "tertiary-container": "#41a6b2",
                        "status-critical": "#D32F2F",
                        "on-primary-fixed-variant": "#004c68",
                        "on-primary": "#ffffff",
                        "on-surface": "#081e2a",
                        "surface-container-lowest": "#ffffff",
                        "error-container": "#ffdad6",
                        "surface-border": "#D5E2E8",
                        "on-surface-variant": "#3e484f",
                        "primary-fixed": "#c3e8ff",
                        "outline-variant": "#bdc8d0",
                        "secondary-fixed": "#dde1ff",
                        "inverse-surface": "#1f3340",
                        "surface-tint": "#006689",
                        "surface-container-highest": "#d0e5f7",
                        "on-background": "#081e2a",
                        "secondary-container": "#d3d8fd",
                        "surface-variant": "#d0e5f7",
                        "on-error": "#ffffff",
                        "on-secondary-fixed": "#141a35",
                        "inverse-on-surface": "#e5f2ff",
                        "surface-container": "#dff0ff",
                        "on-tertiary-fixed-variant": "#004f56",
                        "secondary-fixed-dim": "#bfc5e9",
                        "on-primary-fixed": "#001e2c",
                        "primary-container": "#00a4db",
                        "tertiary-fixed": "#92f1fe",
                        "on-secondary": "#ffffff",
                        "inverse-primary": "#79d1ff",
                        "on-secondary-fixed-variant": "#3f4563",
                        "primary-fixed-dim": "#79d1ff",
                        "surface-bright": "#f6faff",
                        "surface-ice": "#F4F8FA",
                        "tertiary": "#006972",
                        "on-primary-container": "#00354a",
                        "surface-container-high": "#d6ebfd",
                        "on-tertiary-container": "#00373c",
                        "background": "#f6faff",
                        "surface": "#f6faff",
                        "on-tertiary": "#ffffff",
                        "surface-dim": "#c8ddee",
                        "secondary": "#575d7c"
                    },
                    borderRadius: {
                        DEFAULT: "0.125rem",
                        lg: "0.25rem",
                        xl: "0.5rem",
                        full: "0.75rem"
                    },
                    spacing: {
                        "margin-mobile": "1rem",
                        "space-md": "1rem",
                        "margin": "2rem",
                        "gutter": "1.5rem",
                        "space-xl": "2.5rem",
                        "gutter-mobile": "1rem",
                        "space-sm": "0.5rem",
                        "space-lg": "1.5rem",
                        "space-xs": "0.25rem"
                    },
                    fontFamily: {
                        "label-md": ["Plus Jakarta Sans", "sans-serif"],
                        "display-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "body-lg": ["Inter", "sans-serif"],
                        "headline-sm": ["Plus Jakarta Sans", "sans-serif"],
                        "label-sm": ["Plus Jakarta Sans", "sans-serif"],
                        "body-md": ["Inter", "sans-serif"],
                        "display-lg-mobile": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-xl": ["Plus Jakarta Sans", "sans-serif"],
                        "body-sm": ["Inter", "sans-serif"],
                        "headline-md": ["Plus Jakarta Sans", "sans-serif"],
                        "headline-xl-mobile": ["Plus Jakarta Sans", "sans-serif"],
                        "title-md": ["Plus Jakarta Sans", "sans-serif"]
                    },
                    fontSize: {
                        "label-md": ["13px", { lineHeight: "18px", fontWeight: "600" }],
                        "display-lg": ["48px", { lineHeight: "56px", fontWeight: "700" }],
                        "body-lg": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "headline-sm": ["20px", { lineHeight: "28px", fontWeight: "600" }],
                        "label-sm": ["11px", { lineHeight: "16px", fontWeight: "600" }],
                        "body-md": ["14px", { lineHeight: "20px", fontWeight: "400" }],
                        "display-lg-mobile": ["32px", { lineHeight: "40px", fontWeight: "700" }],
                        "headline-xl": ["36px", { lineHeight: "44px", fontWeight: "700" }],
                        "body-sm": ["12px", { lineHeight: "18px", fontWeight: "400" }],
                        "headline-md": ["24px", { lineHeight: "32px", fontWeight: "600" }],
                        "headline-xl-mobile": ["26px", { lineHeight: "34px", fontWeight: "700" }],
                        "title-md": ["16px", { lineHeight: "24px", fontWeight: "600" }]
                    }
                }
            }
        };
    </script>
    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
            main > :first-child { margin-top: 0 !important; }
            main > :last-child { margin-bottom: 0 !important; }
        }
        ::-webkit-scrollbar { display: none; }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
</head>
<body class="bg-surface-ice text-on-surface antialiased">

    {{-- Panggil Navbar Partial yang Sudah Dibuat --}}
    @include('layouts.partials.navbar')

    {{-- Konten Utama Halaman Welcome --}}
    <main class="w-full pt-28 bg-surface-ice min-h-screen">
        <div class="flex flex-col w-full max-w-[1280px] mx-auto px-margin-mobile md:px-margin">
            <section class="relative w-full bg-surface-container-lowest overflow-hidden py-space-md md:py-space-xl">
                <div class="absolute -right-24 -top-24 w-96 h-96 rounded-full bg-primary-fixed/30 blur-3xl pointer-events-none"></div>
                <div class="absolute -left-20 bottom-0 w-80 h-80 rounded-full bg-tertiary-fixed/20 blur-2xl pointer-events-none"></div>
                <div class="relative max-w-[1280px] mx-auto px-margin-mobile md:px-margin">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-mobile md:gap-gutter items-center">
                        <div class="lg:col-span-7 space-y-space-md">
                            <div class="inline-flex items-center gap-space-xs px-space-sm py-space-xs rounded-full bg-surface-container-low text-primary">
                                <img src="{{ setting('site_icon') ? asset('storage/' . setting('site_icon')) : asset('img/logo tirta.png') }}" alt="Logo" class="w-6 h-6 object-contain">
                                <span class="font-label-sm text-label-sm uppercase tracking-wider">
                                    {{ $settings['hero_badge'] ?? setting('hero_badge', 'Layanan Pasang Baru Mandiri & Cepat') }}
                                </span>
                            </div>
                            <h1 class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-on-surface font-bold tracking-tight leading-tight">
                                {{ $settings['home_hero_title'] ?? setting('home_hero_title', 'Pendaftaran Sambungan Baru Air Bersih') }}
                                <span class="text-primary">{{ $settings['company_name'] ?? setting('company_name', 'PERUMDA Tirta Kepri') }}</span>
                            </h1>
                            <p class="font-body-md md:font-body-lg text-body-md md:text-body-lg text-on-surface-variant leading-relaxed max-w-2xl">
                                {{ $settings['home_hero_subtitle'] ?? setting('home_hero_subtitle', 'Kemudahan pengajuan pemasangan instalasi meter air bersih secara online untuk masyarakat dan instansi di wilayah Provinsi Kepulauan Riau (Tanjungpinang, Bintan, dan sekitarnya). Aman, transparan, dan dapat dipantau langsung.') }}
                            </p>
                            <!-- CTA Button -->
                            <div class="pt-space-xs mb-space-sm flex flex-wrap gap-3">
                                <a href="{{ $settings['home_hero_cta_url'] ?? setting('home_hero_cta_url', 'https://tirtakepri.co.id/tarif/') }}" target="_blank" class="inline-flex items-center justify-center h-12 px-space-lg rounded-xl bg-primary text-on-primary font-label-md text-label-md font-semibold hover:bg-on-primary-fixed-variant transition-colors shadow-sm">
                                    {{ $settings['home_hero_cta_text'] ?? setting('home_hero_cta_text', 'Cek Tagihan Air') }}
                                </a>
                            </div>
                            <!-- Quick Tracking Search Bar -->
                            <div class="pt-space-sm">
                                <div class="p-space-sm bg-surface-container-low rounded-xl shadow-sm">
                                    <label class="block font-label-md text-label-md text-on-surface mb-space-xs">
                                        Sudah pernah mendaftar? Lacak Progres Pengajuan Anda
                                    </label>
                                    <form class="flex flex-col sm:flex-row items-stretch gap-space-xs" id="trackForm" onsubmit="event.preventDefault(); window.handleTracking(event); return false;">
                                        <div class="relative flex-1">
                                            <span class="absolute inset-y-0 left-0 pl-space-sm flex items-center pointer-events-none text-on-surface-variant">
                                                <span class="material-symbols-outlined text-[20px]">search</span>
                                            </span>
                                            <input class="w-full h-11 pl-10 pr-space-md rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-body-md placeholder:text-outline focus:outline-none shadow-sm" id="trackInput" placeholder="Masukkan Nomor Registrasi 000/REG/0/0/0000 atau NIK" required="" type="text">
                                        </div>
                                        <button class="h-11 px-space-lg rounded-lg bg-primary text-on-primary font-label-md text-label-md font-semibold hover:bg-on-primary-fixed-variant transition-colors flex items-center justify-center gap-space-xs shrink-0 shadow-sm" type="submit" onclick="event.preventDefault(); window.handleTracking(event); return false;">
                                            <span class="material-symbols-outlined text-[18px]">travel_explore</span>
                                            <span>Cek Status</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- Trust Badges -->
                            <div class="pt-space-xs flex flex-wrap items-center gap-space-lg text-on-surface-variant font-body-sm text-body-sm">
                                <div class="flex items-center gap-space-xs">
                                    <span class="material-symbols-outlined text-primary text-[18px]">verified</span>
                                    <span>{{ $settings['badge_1'] ?? setting('badge_1', 'Resmi Pemprov Kepri') }}</span>
                                </div>
                                <div class="flex items-center gap-space-xs">
                                    <span class="material-symbols-outlined text-primary text-[18px]">lock</span>
                                    <span>{{ $settings['badge_2'] ?? setting('badge_2', 'Data Terenkripsi') }}</span>
                                </div>
                                <!-- <div class="flex items-center gap-space-xs">
                                    <span class="material-symbols-outlined text-primary text-[18px]">schedule</span>
                                    <span>{{ $settings['badge_3'] ?? setting('badge_3', 'Survei Maks. 3 Hari') }}</span>
                                </div> -->
                            </div>
                        </div>
                        <!-- Hero Visual / Stat Panel -->
                        <div class="lg:col-span-5 relative">
                            <div class="relative rounded-2xl bg-surface-container p-space-md overflow-hidden shadow-sm">
                                <div class="relative h-64 rounded-xl overflow-hidden mb-space-md" id="hero-slideshow">
                                    @for($i = 1; $i <= 5; $i++)
                                        @php
                                            $isFirst = $i == 1;
                                            $tag = $settings['hero_card_tag_'.$i] ?? setting('hero_card_tag_'.$i, $isFirst ? 'Infrastruktur Terintegrasi' : '');
                                            $title = $settings['hero_card_title_'.$i] ?? setting('hero_card_title_'.$i, $isFirst ? 'Waduk Sei Gesek & Kolam Kolong Enam' : '');
                                            $subtitle = $settings['hero_card_subtitle_'.$i] ?? setting('hero_card_subtitle_'.$i, $isFirst ? 'Sumber air baku utama pemenuhan kebutuhan Pulau Bintan & Tanjungpinang' : '');
                                            
                                            $defaultImg = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAsl3UmPJr0ZlnnruhXUIMVx7nPSiAn4pZn1jfUVtyO27_kN-XT3aO7I1vhaYUjcWK5jTkBfh2bjD5ZcJQ1jiMWLCJ_CKDQKebZJsWbbSzwBl9ETsjGs6rXXu_nMs2fES60KfIBYtf9BGJ3G3bXJLv5po9WaUeTAk8Y0AMvKEJwih2EV7kw9NhlzWfcw5nFXScSFwOKTJ2gQWXzL3OxRbVfa_vw_tfOk5W3sPAIcRZRqZLqqovWCawiEA';
                                            $heroImage = $settings['hero_image_'.$i] ?? setting('hero_image_'.$i);
                                            $image = $heroImage ? asset('storage/' . $heroImage) : ($isFirst ? $defaultImg : '');
                                        @endphp
                                        
                                        @if($image || $title)
                                        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out hero-slide {{ $isFirst ? 'opacity-100' : 'opacity-0 pointer-events-none' }}">
                                            @if($image)
                                            <img class="w-full h-full object-cover" 
                                                 alt="{{ $title }}" 
                                                 src="{{ $image }}">
                                            @else
                                            <div class="w-full h-full bg-surface-dim"></div>
                                            @endif
                                            <div class="absolute inset-0 bg-gradient-to-t from-inverse-surface/90 via-inverse-surface/20 to-transparent flex items-end p-space-md">
                                                <div class="text-inverse-on-surface">
                                                    @if($tag)
                                                    <span class="inline-block px-space-xs py-0.5 rounded bg-civic-amber text-on-surface font-label-sm text-label-sm font-bold uppercase mb-1">
                                                        {{ $tag }}
                                                    </span>
                                                    @endif
                                                    @if($title)
                                                    <p class="font-headline-sm text-headline-sm font-semibold text-white leading-snug">
                                                        {{ $title }}
                                                    </p>
                                                    @endif
                                                    @if($subtitle)
                                                    <p class="font-body-sm text-body-sm text-surface-container-highest">
                                                        {{ $subtitle }}
                                                    </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endfor

                                    <!-- Slideshow Indicators -->
                                    <div class="absolute bottom-3 right-3 flex gap-1.5 z-10" id="hero-indicators">
                                        <!-- Indicators di-inject via JS -->
                                    </div>
                                </div>
                                <!-- Mini stats row -->
                                <div class="grid grid-cols-2 gap-space-sm">
                                    <div class="bg-surface-container-lowest p-space-sm rounded-lg shadow-sm">
                                        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase">
                                            {{ $settings['stat_1_title'] ?? setting('stat_1_title', 'Kapasitas Produksi') }}
                                        </p>
                                        <p class="font-headline-sm text-headline-sm text-primary font-bold">
                                            {{ $settings['stat_1_value'] ?? setting('stat_1_value', '450+ Ltr/dtk') }}
                                        </p>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant">
                                            {{ $settings['stat_1_sub'] ?? setting('stat_1_sub', 'Standar Kontinuitas 24 Jam') }}
                                        </p>
                                    </div>
                                    <div class="bg-surface-container-lowest p-space-sm rounded-lg shadow-sm">
                                        <p class="font-label-sm text-label-sm text-on-surface-variant uppercase">
                                            {{ $settings['stat_2_title'] ?? setting('stat_2_title', 'Biaya Transparan') }}
                                        </p>
                                        <p class="font-headline-sm text-headline-sm text-tertiary font-bold">
                                            {{ $settings['stat_2_value'] ?? setting('stat_2_value', 'Sesuai SK') }}
                                        </p>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant">
                                            {{ $settings['stat_2_sub'] ?? setting('stat_2_sub', 'Tanpa Biaya Tambahan Liar') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main Selection Section: 2 Large Prominent Cards -->
            <section id="pilihan-pendaftaran" class="w-full py-space-md md:py-space-xl px-margin-mobile md:px-margin">
                <div class="max-w-[1280px] mx-auto">
                    <div class="text-center max-w-3xl mx-auto mb-space-lg md:mb-space-xl">
                        <span class="inline-flex items-center gap-space-xs px-space-sm py-space-xs rounded-full bg-primary/10 text-primary font-label-sm text-label-sm uppercase tracking-wide">
                            Langkah Awal Registrasi
                        </span>
                        <h2 class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-on-surface font-bold mt-space-xs mb-space-xs">
                            Pilih Kategori Permohonan Sambungan Baru
                        </h2>
                        <p class="font-body-md md:font-body-lg text-body-md md:text-body-lg text-on-surface-variant">
                            Silakan pilih peruntukan bangunan Anda untuk mendapatkan persyaratan formulir dan skema tarif yang tepat sesuai regulasi daerah.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter-mobile md:gap-gutter items-stretch">
                        <!-- CARD 1: Sambungan Rumah Tangga -->
                        <div class="flex flex-col justify-between items-center text-center bg-surface-container-lowest rounded-2xl p-space-xl shadow-md hover:shadow-xl transition-all duration-300 relative border border-transparent">
                            <div class="flex flex-col items-center">
                                <div class="mb-space-md">
                                    <span class="px-space-sm py-1 rounded-full bg-civic-amber/20 text-on-surface font-label-sm text-label-sm uppercase font-bold tracking-wider">
                                        Paling Populer • Residensial
                                    </span>
                                </div>
                                <div class="w-20 h-20 rounded-2xl bg-surface-container-low flex items-center justify-center text-primary transition-all duration-300 shadow-sm mb-space-md">
                                    <span class="material-symbols-outlined text-[48px]">home</span>
                                </div>
                                <h3 class="font-headline-md text-headline-md text-on-surface font-bold transition-colors mb-space-xs">
                                    Sambungan Rumah Tangga
                                </h3>
                                <p class="font-body-md text-body-md text-on-surface-variant max-w-md leading-relaxed">
                                    Pemasangan baru air bersih untuk rumah tinggal pribadi, komplek hunian keluarga, dan indekos.
                                </p>
                            </div>
                            <div class="w-full pt-space-lg mt-space-md border-t border-surface-container">
                                <a href="{{ route('public.register.rumah-tangga') }}" class="w-full h-12 rounded-lg bg-primary text-on-primary font-label-md text-label-md font-semibold hover:bg-on-primary-fixed-variant transition-all flex items-center justify-center gap-space-xs shadow-md">
                                    <span>Pilih &amp; Daftar Sekarang</span>
                                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>

                        <!-- CARD 2: Sambungan Fasilitas Umum & Sosial -->
                        <div class="flex flex-col justify-between items-center text-center bg-surface-container-lowest rounded-2xl p-space-xl shadow-md hover:shadow-xl transition-all duration-300 relative border border-transparent">
                            <div class="flex flex-col items-center">
                                <div class="mb-space-md">
                                    <span class="px-space-sm py-1 rounded-full bg-tertiary-container/30 text-on-tertiary-container font-label-sm text-label-sm uppercase font-bold tracking-wider">
                                        Sosial &amp; Fasum
                                    </span>
                                </div>
                                <div class="w-20 h-20 rounded-2xl bg-surface-container-low flex items-center justify-center text-tertiary transition-all duration-300 shadow-sm mb-space-md">
                                    <span class="material-symbols-outlined text-[48px]">domain</span>
                                </div>
                                <h3 class="font-headline-md text-headline-md text-on-surface font-bold transition-colors mb-space-xs">
                                    Sambungan Fasilitas Umum
                                </h3>
                                <p class="font-body-md text-body-md text-on-surface-variant max-w-md leading-relaxed">
                                    Layanan bersubsidi khusus tempat ibadah, sarana pendidikan, panti sosial, dan fasilitas warga.
                                </p>
                            </div>
                            <div class="w-full pt-space-lg mt-space-md border-t border-surface-container">
                                <a href="{{ route('public.register.fasilitas-umum') }}" class="w-full h-12 rounded-lg bg-tertiary text-on-tertiary font-label-md text-label-md font-semibold hover:bg-on-tertiary-fixed-variant transition-all flex items-center justify-center gap-space-xs shadow-md">
                                    <span>Pilih &amp; Daftar Sekarang</span>
                                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 4 Langkah Mudah Pasang Baru -->
            <section class="w-full bg-surface-container-low py-space-md md:py-space-xl px-margin-mobile md:px-margin rounded-2xl">
                <div class="max-w-[1280px] mx-auto">
                    <div class="flex flex-col md:flex-row md:items-end justify-between mb-space-md md:mb-space-lg gap-space-sm md:gap-space-md">
                        <div>
                            <span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-bold">Alur Pendaftaran Terpadu</span>
                            <h2 class="font-headline-xl-mobile md:font-headline-xl text-headline-xl-mobile md:text-headline-xl text-on-surface font-bold mt-1">
                                4 Langkah Mudah Pasang Baru
                            </h2>
                        </div>
                        <p class="font-body-md text-body-md text-on-surface-variant max-w-md">
                            Proses resmi, transparan, dan dapat dipantau setiap saat tanpa perlu bolak-balik ke kantor cabang.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter-mobile md:gap-gutter relative">
                        <!-- Step 1 -->
                        <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between">
                            <div class="space-y-space-sm">
                                <div class="flex items-center justify-between">
                                    <span class="w-9 h-9 rounded-full bg-primary text-on-primary font-title-md text-title-md font-bold flex items-center justify-center">1</span>
                                    <span class="material-symbols-outlined text-primary text-[24px]">app_registration</span>
                                </div>
                                <h3 class="font-title-md text-title-md text-on-surface font-bold">Pilih Kategori &amp; Formulir Online</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Tentukan kategori bangunan, lengkapi identitas pemohon, dan unggah berkas KTP serta bukti kepemilikan/pengurus.
                                </p>
                            </div>
                            <span class="mt-space-md font-label-sm text-label-sm text-primary font-semibold">Estimasi: 5 - 10 Menit</span>
                        </div>
                        <!-- Step 2 -->
                        <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between">
                            <div class="space-y-space-sm">
                                <div class="flex items-center justify-between">
                                    <span class="w-9 h-9 rounded-full bg-primary text-on-primary font-title-md text-title-md font-bold flex items-center justify-center">2</span>
                                    <span class="material-symbols-outlined text-primary text-[24px]">engineering</span>
                                </div>
                                <h3 class="font-title-md text-title-md text-on-surface font-bold">Verifikasi &amp; Survei Lapangan</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Petugas teknis {{ $settings['company_short_name'] ?? setting('company_short_name', 'PERUMDA Tirta Kepri') }} mendatangi lokasi Anda untuk mengukur jarak pipa distribusi dan tekanan jaringan.
                                </p>
                            </div>
                            <span class="mt-space-md font-label-sm text-label-sm text-primary font-semibold">Estimasi: 1 - 3 Hari Kerja</span>
                        </div>
                        <!-- Step 3 -->
                        <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between">
                            <div class="space-y-space-sm">
                                <div class="flex items-center justify-between">
                                    <span class="w-9 h-9 rounded-full bg-primary text-on-primary font-title-md text-title-md font-bold flex items-center justify-center">3</span>
                                    <span class="material-symbols-outlined text-primary text-[24px]">receipt_long</span>
                                </div>
                                <h3 class="font-title-md text-title-md text-on-surface font-bold">Terbit SPK &amp; Pembayaran Resmi</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Rincian biaya pemasangan diterbitkan secara transparan (cashless) melalui Bank Kepri Riau, Mandiri, BNI, atau loket resmi.
                                </p>
                            </div>
                            <span class="mt-space-md font-label-sm text-label-sm text-primary font-semibold">Sistem Cashless Bebas Pungli</span>
                        </div>
                        <!-- Step 4 -->
                        <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col justify-between">
                            <div class="space-y-space-sm">
                                <div class="flex items-center justify-between">
                                    <span class="w-9 h-9 rounded-full bg-status-success text-on-primary font-title-md text-title-md font-bold flex items-center justify-center">4</span>
                                    <span class="material-symbols-outlined text-status-success text-[24px]">water</span>
                                </div>
                                <h3 class="font-title-md text-title-md text-on-surface font-bold">Pemasangan Meter &amp; Air Mengalir</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Pemasangan fisik meteran air, pengujian kelancaran debit, dan penandatanganan Berita Acara Pemasangan (BAP).
                                </p>
                            </div>
                            <span class="mt-space-md font-label-sm text-label-sm text-status-success font-semibold">Siap Digunakan Pelanggan</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- FAQ & Quick Helpdesk -->
            <section class="w-full py-space-md md:py-space-xl px-margin-mobile md:px-margin">
                <div class="max-w-[1280px] mx-auto">
                    <div class="w-full">
                        <div class="w-full bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm space-y-space-md">
                            <div>
                                <span class="px-space-sm py-1 rounded-full bg-primary/10 text-primary font-label-sm text-label-sm uppercase font-bold">
                                    Bantuan &amp; Konsultasi
                                </span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold mt-space-xs">
                                    Pusat Layanan Konsultasi Pasang Baru
                                </h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                                    Petugas Customer Care siap memandu proses pengisian formulir dan verifikasi berkas permohonan Anda.
                                </p>
                            </div>
                            <div class="flex flex-col gap-space-md">
                                <!-- Baris Atas: WhatsApp 3 Cabang -->
                                <div class="p-space-md rounded-2xl bg-gradient-to-br from-status-success/10 to-status-success/5 border border-status-success/20 shadow-sm">
                                    <div class="flex items-center gap-4 mb-5">
                                        <div class="w-12 h-12 rounded-xl bg-status-success text-white flex items-center justify-center shrink-0 shadow-md shadow-status-success/30">
                                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7"><path d="M12.031 0C5.394 0 0 5.394 0 12.031a11.97 11.97 0 001.6 5.96L0 24l6.17-1.6a11.97 11.97 0 005.861 1.53h.005c6.634 0 12.028-5.394 12.028-12.031S18.665 0 12.031 0zM12.036 21.905h-.003a9.944 9.944 0 01-5.068-1.378l-.363-.215-3.774.989.998-3.68-.236-.375a9.957 9.957 0 01-1.524-5.215c0-5.512 4.484-9.997 10.002-9.997 2.671 0 5.18 1.04 7.067 2.93a9.972 9.972 0 012.923 7.07c-.001 5.511-4.485 9.996-9.998 9.996zm5.485-7.493c-.301-.151-1.782-.879-2.059-.979-.277-.1-.478-.151-.678.151-.2.301-.777.979-.953 1.18-.175.201-.352.226-.653.076a8.212 8.212 0 01-2.417-1.492 9.074 9.074 0 01-1.684-2.096c-.176-.301-.019-.464.132-.614.136-.135.301-.352.452-.527.151-.176.201-.301.301-.502.1-.2.05-.376-.025-.527-.075-.151-.678-1.631-.928-2.234-.244-.588-.493-.508-.678-.517-.175-.008-.376-.008-.577-.008a1.1 1.1 0 00-.791.368c-.277.301-1.055 1.029-1.055 2.51s1.08 2.912 1.23 3.113c.151.2 2.122 3.238 5.139 4.54.718.311 1.278.497 1.714.636.72.189 1.376.162 1.895.098.58-.073 1.782-.728 2.033-1.431.251-.703.251-1.306.175-1.431-.075-.126-.276-.201-.577-.352z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="font-title-lg text-title-lg text-on-surface font-extrabold tracking-tight">Hubungi WhatsApp Cabang</p>
                                            <p class="text-sm text-on-surface-variant mt-0.5">Pilih cabang terdekat untuk respon layanan instan.</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <!-- Cabang 1 -->
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['branch_1_wa'] ?? '08117782155') }}" target="_blank" class="relative overflow-hidden flex flex-col justify-center p-4 rounded-xl bg-white border border-status-success/10 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                                            <div class="absolute top-0 right-0 p-3 opacity-0 group-hover:opacity-100 transition-opacity translate-x-2 group-hover:translate-x-0 duration-300">
                                                <span class="material-symbols-outlined text-status-success text-[20px]">arrow_outward</span>
                                            </div>
                                            <span class="text-[11px] font-bold text-status-success uppercase tracking-widest mb-1">{{ $settings['branch_1_name'] ?? 'Tanjungpinang' }}</span>
                                            <span class="text-lg font-extrabold text-on-surface group-hover:text-primary transition-colors flex items-center gap-1.5"><svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-status-success"><path d="M12.031 0C5.394 0 0 5.394 0 12.031a11.97 11.97 0 001.6 5.96L0 24l6.17-1.6a11.97 11.97 0 005.861 1.53h.005c6.634 0 12.028-5.394 12.028-12.031S18.665 0 12.031 0zM12.036 21.905h-.003a9.944 9.944 0 01-5.068-1.378l-.363-.215-3.774.989.998-3.68-.236-.375a9.957 9.957 0 01-1.524-5.215c0-5.512 4.484-9.997 10.002-9.997 2.671 0 5.18 1.04 7.067 2.93a9.972 9.972 0 012.923 7.07c-.001 5.511-4.485 9.996-9.998 9.996zm5.485-7.493c-.301-.151-1.782-.879-2.059-.979-.277-.1-.478-.151-.678.151-.2.301-.777.979-.953 1.18-.175.201-.352.226-.653.076a8.212 8.212 0 01-2.417-1.492 9.074 9.074 0 01-1.684-2.096c-.176-.301-.019-.464.132-.614.136-.135.301-.352.452-.527.151-.176.201-.301.301-.502.1-.2.05-.376-.025-.527-.075-.151-.678-1.631-.928-2.234-.244-.588-.493-.508-.678-.517-.175-.008-.376-.008-.577-.008a1.1 1.1 0 00-.791.368c-.277.301-1.055 1.029-1.055 2.51s1.08 2.912 1.23 3.113c.151.2 2.122 3.238 5.139 4.54.718.311 1.278.497 1.714.636.72.189 1.376.162 1.895.098.58-.073 1.782-.728 2.033-1.431.251-.703.251-1.306.175-1.431-.075-.126-.276-.201-.577-.352z"></path></svg> {{ $settings['branch_1_wa'] ?? '0811-778-2155' }}</span>
                                        </a>
                                        <!-- Cabang 2 -->
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['branch_2_wa'] ?? '08123456789') }}" target="_blank" class="relative overflow-hidden flex flex-col justify-center p-4 rounded-xl bg-white border border-status-success/10 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                                            <div class="absolute top-0 right-0 p-3 opacity-0 group-hover:opacity-100 transition-opacity translate-x-2 group-hover:translate-x-0 duration-300">
                                                <span class="material-symbols-outlined text-status-success text-[20px]">arrow_outward</span>
                                            </div>
                                            <span class="text-[11px] font-bold text-status-success uppercase tracking-widest mb-1">{{ $settings['branch_2_name'] ?? 'Kijang' }}</span>
                                            <span class="text-lg font-extrabold text-on-surface group-hover:text-primary transition-colors flex items-center gap-1.5"><svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-status-success"><path d="M12.031 0C5.394 0 0 5.394 0 12.031a11.97 11.97 0 001.6 5.96L0 24l6.17-1.6a11.97 11.97 0 005.861 1.53h.005c6.634 0 12.028-5.394 12.028-12.031S18.665 0 12.031 0zM12.036 21.905h-.003a9.944 9.944 0 01-5.068-1.378l-.363-.215-3.774.989.998-3.68-.236-.375a9.957 9.957 0 01-1.524-5.215c0-5.512 4.484-9.997 10.002-9.997 2.671 0 5.18 1.04 7.067 2.93a9.972 9.972 0 012.923 7.07c-.001 5.511-4.485 9.996-9.998 9.996zm5.485-7.493c-.301-.151-1.782-.879-2.059-.979-.277-.1-.478-.151-.678.151-.2.301-.777.979-.953 1.18-.175.201-.352.226-.653.076a8.212 8.212 0 01-2.417-1.492 9.074 9.074 0 01-1.684-2.096c-.176-.301-.019-.464.132-.614.136-.135.301-.352.452-.527.151-.176.201-.301.301-.502.1-.2.05-.376-.025-.527-.075-.151-.678-1.631-.928-2.234-.244-.588-.493-.508-.678-.517-.175-.008-.376-.008-.577-.008a1.1 1.1 0 00-.791.368c-.277.301-1.055 1.029-1.055 2.51s1.08 2.912 1.23 3.113c.151.2 2.122 3.238 5.139 4.54.718.311 1.278.497 1.714.636.72.189 1.376.162 1.895.098.58-.073 1.782-.728 2.033-1.431.251-.703.251-1.306.175-1.431-.075-.126-.276-.201-.577-.352z"></path></svg> {{ $settings['branch_2_wa'] ?? '0812-345-6789' }}</span>
                                        </a>
                                        <!-- Cabang 3 -->
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['branch_3_wa'] ?? '08134567890') }}" target="_blank" class="relative overflow-hidden flex flex-col justify-center p-4 rounded-xl bg-white border border-status-success/10 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                                            <div class="absolute top-0 right-0 p-3 opacity-0 group-hover:opacity-100 transition-opacity translate-x-2 group-hover:translate-x-0 duration-300">
                                                <span class="material-symbols-outlined text-status-success text-[20px]">arrow_outward</span>
                                            </div>
                                            <span class="text-[11px] font-bold text-status-success uppercase tracking-widest mb-1">{{ $settings['branch_3_name'] ?? 'Tj. Uban' }}</span>
                                            <span class="text-lg font-extrabold text-on-surface group-hover:text-primary transition-colors flex items-center gap-1.5"><svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-status-success"><path d="M12.031 0C5.394 0 0 5.394 0 12.031a11.97 11.97 0 001.6 5.96L0 24l6.17-1.6a11.97 11.97 0 005.861 1.53h.005c6.634 0 12.028-5.394 12.028-12.031S18.665 0 12.031 0zM12.036 21.905h-.003a9.944 9.944 0 01-5.068-1.378l-.363-.215-3.774.989.998-3.68-.236-.375a9.957 9.957 0 01-1.524-5.215c0-5.512 4.484-9.997 10.002-9.997 2.671 0 5.18 1.04 7.067 2.93a9.972 9.972 0 012.923 7.07c-.001 5.511-4.485 9.996-9.998 9.996zm5.485-7.493c-.301-.151-1.782-.879-2.059-.979-.277-.1-.478-.151-.678.151-.2.301-.777.979-.953 1.18-.175.201-.352.226-.653.076a8.212 8.212 0 01-2.417-1.492 9.074 9.074 0 01-1.684-2.096c-.176-.301-.019-.464.132-.614.136-.135.301-.352.452-.527.151-.176.201-.301.301-.502.1-.2.05-.376-.025-.527-.075-.151-.678-1.631-.928-2.234-.244-.588-.493-.508-.678-.517-.175-.008-.376-.008-.577-.008a1.1 1.1 0 00-.791.368c-.277.301-1.055 1.029-1.055 2.51s1.08 2.912 1.23 3.113c.151.2 2.122 3.238 5.139 4.54.718.311 1.278.497 1.714.636.72.189 1.376.162 1.895.098.58-.073 1.782-.728 2.033-1.431.251-.703.251-1.306.175-1.431-.075-.126-.276-.201-.577-.352z"></path></svg> {{ $settings['branch_3_wa'] ?? '0813-456-7890' }}</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Baris Bawah: Call Center & Lokasi -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                                    <!-- Call Center -->
                                    <div class="relative overflow-hidden flex flex-col p-space-md rounded-2xl bg-gradient-to-br from-primary/10 to-primary/5 border border-primary/20 hover:shadow-md transition-all duration-300 group cursor-default">
                                        <div class="absolute -right-4 -top-4 opacity-[0.03] group-hover:opacity-10 transition-opacity duration-500 group-hover:scale-110 transform">
                                            <span class="material-symbols-outlined text-[120px] text-primary">headset_mic</span>
                                        </div>
                                        <div class="w-12 h-12 rounded-xl bg-primary text-white flex items-center justify-center shrink-0 mb-4 shadow-md shadow-primary/30 relative z-10 group-hover:-translate-y-1 transition-transform">
                                            <span class="material-symbols-outlined text-[24px]">call</span>
                                        </div>
                                        <div class="min-w-0 relative z-10">
                                            <p class="font-label-sm text-label-sm text-primary uppercase font-bold tracking-widest mb-1">Call Center Resmi</p>
                                            <p class="text-2xl font-extrabold text-on-surface truncate">
                                                {{ $settings['navbar_call_center'] ?? setting('navbar_call_center', '(0771) 21555') }}
                                            </p>
                                            <p class="text-sm font-medium text-on-surface-variant mt-2 flex items-center gap-1.5">
                                                <span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
                                                {{ $settings['office_hours'] ?? setting('office_hours', 'Senin - Jumat: 08.00 - 15.00 WIB') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Lokasi -->
                                    <div class="relative overflow-hidden flex flex-col p-space-md rounded-2xl bg-gradient-to-br from-secondary/10 to-secondary/5 border border-secondary/20 hover:shadow-md transition-all duration-300 group cursor-default">
                                        <div class="absolute -right-4 -top-4 opacity-[0.03] group-hover:opacity-10 transition-opacity duration-500 group-hover:scale-110 transform">
                                            <span class="material-symbols-outlined text-[120px] text-secondary">location_on</span>
                                        </div>
                                        <div class="w-12 h-12 rounded-xl bg-secondary text-white flex items-center justify-center shrink-0 mb-4 shadow-md shadow-secondary/30 relative z-10 group-hover:-translate-y-1 transition-transform">
                                            <span class="material-symbols-outlined text-[24px]">location_on</span>
                                        </div>
                                        <div class="min-w-0 relative z-10">
                                            <p class="font-label-sm text-label-sm text-secondary uppercase font-bold tracking-widest mb-1">Kantor Pusat Pelayanan</p>
                                            <p class="text-base font-semibold text-on-surface leading-relaxed pr-8">
                                                {{ $settings['footer_address'] ?? setting('footer_address', 'Jl. MT Haryono No. 56, Batu 3, Tanjungpinang') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-space-xs p-space-sm rounded-lg bg-surface-ice flex items-center justify-between flex-wrap gap-space-xs">
                                <p class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-space-xs">
                                    <span class="material-symbols-outlined text-primary text-[16px]">security</span>
                                    <span>Portal Terkoneksi dengan Sistem Manajemen Pelanggan (SIM-PDAM)</span>
                                </p>
                                <span class="font-label-sm text-label-sm text-status-success font-semibold flex items-center gap-space-xs">
                                    <span class="inline-block w-2 h-2 rounded-full bg-status-success"></span>
                                    Layanan Pelanggan Aktif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Interactive Client-side Script -->
            <script>
                window.closeTrackingModal = function() {
                    const modal = document.getElementById('trackingModal');
                    const content = document.getElementById('trackingModalContent');
                    content.classList.remove('scale-100', 'opacity-100');
                    content.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        modal.classList.remove('flex');
                        modal.classList.add('hidden');
                    }, 300);
                }

                window.showTrackingModal = function() {
                    const modal = document.getElementById('trackingModal');
                    const content = document.getElementById('trackingModalContent');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    setTimeout(() => {
                        content.classList.remove('scale-95', 'opacity-0');
                        content.classList.add('scale-100', 'opacity-100');
                    }, 10);
                }

                window.handleTracking = function(e) {
                    if (e) e.preventDefault();
                    const val = document.getElementById('trackInput').value.trim();
                    if (!val) return;

                    // Reset UI Modal ke Loading
                    const iconWrapper = document.getElementById('trackingModalIconWrapper');
                    const icon = document.getElementById('trackingModalIcon');
                    const statusText = document.getElementById('trackingModalStatus');
                    const messageText = document.getElementById('trackingModalMessage');
                    const qrWrapper = document.getElementById('trackingModalQRWrapper');
                    const qrCode = document.getElementById('trackingModalQRCode');
                    
                    qrWrapper.classList.add('hidden');
                    qrWrapper.classList.remove('flex');
                    qrCode.innerHTML = '';

                    iconWrapper.className = 'w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center mb-4';
                    icon.className = 'material-symbols-outlined text-3xl text-blue-500 animate-spin';
                    icon.textContent = 'sync';
                    
                    statusText.className = 'text-xl font-bold text-gray-800 mb-2';
                    statusText.textContent = 'Mencari Data...';
                    messageText.innerHTML = 'Mencari data permohonan untuk <b>' + val + '</b>...';

                    showTrackingModal();

                    fetch('{{ route("public.track") }}?query=' + encodeURIComponent(val), {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        icon.classList.remove('animate-spin');
                        if (data.success) {
                            iconWrapper.className = 'w-16 h-16 rounded-full bg-green-50 flex items-center justify-center mb-4';
                            icon.className = 'material-symbols-outlined text-4xl text-green-500';
                            icon.textContent = 'check_circle';
                            statusText.textContent = 'Data Ditemukan!';
                            statusText.classList.replace('text-gray-800', 'text-green-600');
                            messageText.innerHTML = 'Pendaftar: <b>' + data.message.replace('Data ditemukan: ', '') + '</b><br><span class="inline-block mt-3 px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">' + data.status + '</span>';
                            
                            if (data.receipt_url) {
                                qrWrapper.classList.remove('hidden');
                                qrWrapper.classList.add('flex');
                                new QRCode(qrCode, {
                                    text: data.receipt_url,
                                    width: 120,
                                    height: 120,
                                    colorDark: "#000000",
                                    colorLight: "#ffffff",
                                    correctLevel: QRCode.CorrectLevel.M
                                });
                                document.getElementById('trackingModalReceiptBtn').href = data.receipt_url;
                            }
                        } else {
                            iconWrapper.className = 'w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mb-4';
                            icon.className = 'material-symbols-outlined text-4xl text-red-500';
                            icon.textContent = 'error';
                            statusText.textContent = 'Tidak Ditemukan';
                            statusText.classList.replace('text-gray-800', 'text-red-600');
                            messageText.innerHTML = 'Data registrasi tidak ditemukan di sistem. Periksa kembali NIK atau Nomor Registrasi Anda.';
                        }
                    })
                    .catch(err => {
                        icon.classList.remove('animate-spin');
                        iconWrapper.className = 'w-16 h-16 rounded-full bg-red-50 flex items-center justify-center mb-4';
                        icon.className = 'material-symbols-outlined text-4xl text-red-500';
                        icon.textContent = 'warning';
                        statusText.textContent = 'Kesalahan Jaringan';
                        statusText.classList.replace('text-gray-800', 'text-red-600');
                        messageText.innerHTML = 'Gagal menghubungi server. Pastikan koneksi internet Anda stabil.';
                    });
                };

                window.toggleFaq = function(id) {
                    const el = document.getElementById(id);
                    const icon = document.getElementById(id + '-icon');
                    if (el.classList.contains('hidden')) {
                        el.classList.remove('hidden');
                        icon.textContent = 'expand_less';
                    } else {
                        el.classList.add('hidden');
                        icon.textContent = 'expand_more';
                    }
                };

                // Slideshow Logic
                document.addEventListener("DOMContentLoaded", () => {
                    const slides = document.querySelectorAll('.hero-slide');
                    if (slides.length > 1) {
                        const indicatorsContainer = document.getElementById('hero-indicators');
                        slides.forEach((_, i) => {
                            const dot = document.createElement('div');
                            dot.className = `w-2 h-2 rounded-full transition-colors ${i === 0 ? 'bg-white' : 'bg-white/40'}`;
                            indicatorsContainer.appendChild(dot);
                        });
                        const dots = indicatorsContainer.children;
                        let currentSlide = 0;
                        
                        setInterval(() => {
                            slides[currentSlide].classList.remove('opacity-100');
                            slides[currentSlide].classList.add('opacity-0', 'pointer-events-none');
                            dots[currentSlide].classList.remove('bg-white');
                            dots[currentSlide].classList.add('bg-white/40');
                            
                            currentSlide = (currentSlide + 1) % slides.length;
                            
                            slides[currentSlide].classList.add('opacity-100');
                            slides[currentSlide].classList.remove('opacity-0', 'pointer-events-none');
                            dots[currentSlide].classList.add('bg-white');
                            dots[currentSlide].classList.remove('bg-white/40');
                        }, 5000); // 5 seconds per slide
                    }
                });
            </script>
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')
    
    <!-- Tracking Modal Pop-up -->
    <div id="trackingModal" class="fixed inset-0 z-[9999] hidden items-center justify-center">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeTrackingModal()"></div>
        
        <!-- Modal Content -->
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="trackingModalContent">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-bold text-gray-800 font-label-md">Status Pendaftaran</h3>
                <button onclick="closeTrackingModal()" class="text-gray-400 hover:text-gray-600 transition bg-gray-100 hover:bg-gray-200 rounded-full p-1">
                    <span class="material-symbols-outlined text-[18px] block">close</span>
                </button>
            </div>
            
            <!-- Body -->
            <div class="p-6 flex flex-col items-center text-center">
                <div id="trackingModalIconWrapper" class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                    <span id="trackingModalIcon" class="material-symbols-outlined text-3xl text-blue-500">sync</span>
                </div>
                <h4 id="trackingModalStatus" class="text-xl font-bold text-gray-800 mb-2">Mencari Data...</h4>
                <p id="trackingModalMessage" class="text-gray-500 text-sm leading-relaxed">Mohon tunggu sebentar.</p>
                
                <div id="trackingModalQRWrapper" class="mt-5 hidden flex-col items-center w-full">
                    <div id="trackingModalQRCode" class="p-3 bg-white rounded-xl shadow-sm border border-gray-100 mb-3 inline-block"></div>
                    <a id="trackingModalReceiptBtn" href="#" target="_blank" class="px-4 py-2 bg-blue-50 hover:bg-blue-100 text-primary rounded-lg text-sm font-bold transition-colors inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">receipt_long</span>
                        Buka Bukti Pendaftaran
                    </a>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-center">
                <button onclick="closeTrackingModal()" class="w-full py-3 bg-primary hover:bg-[#004e69] text-white rounded-xl text-sm font-bold shadow-md transition-colors">
                    Kembali
                </button>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
</body>
</html>

