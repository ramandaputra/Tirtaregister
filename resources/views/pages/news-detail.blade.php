<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $news->title }} - PERUMDA Air Minum Tirta Kepri</title>

    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
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
        }
        ::-webkit-scrollbar { display: none; }
        
        /* Typography for Rich Text Content */
        .prose-custom p { margin-bottom: 1.5em; line-height: 1.8; color: #3e484f; }
        .prose-custom h2 { font-size: 1.75rem; font-weight: 700; margin-top: 2em; margin-bottom: 1em; color: #081e2a; font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.025em; }
        .prose-custom h3 { font-size: 1.35rem; font-weight: 600; margin-top: 1.5em; margin-bottom: 0.75em; color: #081e2a; font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.015em; }
        .prose-custom h4 { font-size: 1.15rem; font-weight: 600; margin-top: 1.25em; margin-bottom: 0.5em; color: #081e2a; font-family: 'Plus Jakarta Sans', sans-serif; }
        .prose-custom ul { list-style-type: disc; padding-left: 1.5em; margin-bottom: 1.5em; color: #3e484f; }
        .prose-custom ol { list-style-type: decimal; padding-left: 1.5em; margin-bottom: 1.5em; color: #3e484f; }
        .prose-custom li { margin-bottom: 0.5em; padding-left: 0.25em; }
        .prose-custom a { color: #006689; text-decoration: none; font-weight: 600; border-bottom: 2px solid #c3e8ff; transition: all 0.2s; }
        .prose-custom a:hover { color: #004c68; border-bottom-color: #006689; }
        .prose-custom img { border-radius: 1rem; margin-top: 2.5em; margin-bottom: 2.5em; max-width: 100%; height: auto; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .prose-custom blockquote { border-left: 4px solid #00a4db; padding: 1.25rem 1.5rem; font-style: italic; color: #1f3340; margin-top: 2em; margin-bottom: 2em; background-color: #f6faff; border-radius: 0 0.75rem 0.75rem 0; font-size: 1.05rem; line-height: 1.8; }
        .prose-custom strong { color: #081e2a; font-weight: 600; }
        .prose-custom hr { border-color: #D5E2E8; margin-top: 3em; margin-bottom: 3em; }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
</head>
<body class="bg-surface-ice text-on-surface antialiased flex flex-col min-h-screen">

    {{-- Panggil Navbar Partial yang Sudah Dibuat --}}
    @include('layouts.partials.navbar')

    <!-- Main Content Layout -->
    <main class="flex-grow w-full pt-28">
        <div class="max-w-7xl mx-auto px-6 py-8 md:py-12 w-full space-y-10">
            
            <!-- Header Section Modern & Elegan -->
            <header class="flex flex-col items-center text-center max-w-3xl mx-auto space-y-4 pt-2 pb-2">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-primary-container/15 text-primary border border-primary-container/30 text-xs font-bold tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-primary-container animate-pulse"></span>
                    Pusat Informasi &amp; Publikasi
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-on-surface tracking-tight font-headline-xl leading-tight">
                    Berita &amp; Pengumuman Resmi
                </h1>
                <p class="text-sm md:text-base text-on-surface-variant font-body-md leading-relaxed max-w-2xl">
                    Dapatkan pembaruan terkini seputar operasional distribusi air bersih, jadwal pemeliharaan jaringan, dan informasi layanan PERUMDA Air Minum Tirta Kepri.
                </p>
            </header>

            <!-- Breadcrumb -->
            <nav class="flex text-sm text-on-surface-variant font-medium" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                            <span class="material-symbols-outlined text-[18px]">home</span>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <span class="material-symbols-outlined text-[18px] text-outline-variant mx-1">chevron_right</span>
                            <a href="{{ route('news.index') }}" class="hover:text-primary transition-colors">Berita & Pengumuman</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <span class="material-symbols-outlined text-[18px] text-outline-variant mx-1">chevron_right</span>
                            <span class="text-outline line-clamp-1 max-w-[150px] md:max-w-xs">{{ $news->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Main Article Content -->
                <article class="lg:col-span-8 bg-surface-container-lowest rounded-3xl p-6 md:p-10 shadow-sm border border-surface-border">
                    <!-- Article Header -->
                    <header class="mb-8">
                        <div class="flex flex-wrap items-center gap-3 mb-4">
                            <span class="px-3.5 py-1.5 rounded-full bg-primary-fixed text-on-primary-fixed-variant font-semibold text-xs shadow-sm uppercase tracking-wider">
                                {{ $news->category_label ?? $news->category ?? 'Informasi' }}
                            </span>
                            <div class="flex items-center gap-1.5 text-sm text-on-surface-variant font-medium">
                                <span class="material-symbols-outlined text-[18px] text-primary">calendar_today</span>
                                <span>{{ $news->created_at ? $news->created_at->translatedFormat('l, d F Y') : '' }}</span>
                            </div>
                        </div>
                        <h1 class="text-3xl md:text-4xl lg:text-4xl font-bold text-on-surface tracking-tight font-headline-xl leading-tight mb-6">
                            {{ $news->title }}
                        </h1>
                        <div class="flex items-center justify-between py-4 border-y border-surface-border">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center text-on-primary-container font-bold text-lg">
                                    <span class="material-symbols-outlined">domain</span>
                                </div>
                            </div>
                        </div>
                    </header>

                    <!-- Article Hero Image -->
                    <div class="mb-10 rounded-2xl overflow-hidden bg-surface-ice border border-surface-border aspect-video">
                        <img src="{{ $news->image ? asset('storage/' . $news->image) : 'https://via.placeholder.com/800x450' }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Article Content -->
                    <div class="prose-custom font-body-lg text-on-surface-variant max-w-none">
                        {!! $news->content !!}
                    </div>
                </article>

                <!-- Sidebar (Related News & Info) -->
                <aside class="lg:col-span-4 space-y-8">
                    
                    <!-- Search Widget -->
                    <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-surface-border">
                        <h3 class="font-bold text-lg text-on-surface mb-4 font-headline-sm">Cari Berita</h3>
                        <form action="{{ route('news.index') }}" method="GET" class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant material-symbols-outlined text-[20px] pointer-events-none">search</span>
                            <input type="text" name="search" placeholder="Kata kunci..." class="w-full pl-10 pr-4 py-3 bg-surface-ice rounded-xl text-sm font-body-md text-on-surface border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary-container transition-all">
                        </form>
                    </div>

                    <!-- Related News -->
                    @if($relatedNews->count() > 0)
                    <div class="bg-surface-container-lowest rounded-3xl p-6 shadow-sm border border-surface-border">
                        <h3 class="font-bold text-lg text-on-surface mb-5 font-headline-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">feed</span>
                            Berita Terbaru Lainnya
                        </h3>
                        <div class="space-y-5">
                            @foreach($relatedNews as $related)
                            <a href="{{ route('news.show', $related->slug) }}" class="group flex gap-4 items-start">
                                <div class="w-24 h-20 shrink-0 rounded-xl overflow-hidden bg-surface-ice border border-surface-border">
                                    <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://via.placeholder.com/150x150' }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-out">
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2 leading-snug mb-1">
                                        {{ $related->title }}
                                    </h4>
                                    <div class="flex items-center gap-1.5 text-xs text-on-surface-variant font-medium">
                                        <span class="material-symbols-outlined text-[14px]">schedule</span>
                                        <span>{{ $related->created_at ? $related->created_at->diffForHumans() : '' }}</span>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <div class="mt-6 pt-5 border-t border-surface-border">
                            <a href="{{ route('news.index') }}" class="text-sm font-semibold text-primary hover:text-primary-container inline-flex items-center justify-center w-full gap-1 transition-colors">
                                Lihat Semua Berita <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                    @endif
                </aside>
            </div>

            <!-- Section Pengaduan 24/7 -->
            @php
                $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
            @endphp
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary to-on-primary-container text-on-primary shadow-lg border border-primary-container/30 p-6 md:p-8">
                <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-primary-container/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative z-10 max-w-4xl mx-auto text-center space-y-4">
                    <div class="inline-flex items-center justify-center gap-2 px-4 py-1.5 rounded-full bg-surface-container-lowest/15 border border-white/20 text-xs font-semibold backdrop-blur-sm mx-auto">
                            <span class="w-2 h-2 rounded-full bg-civic-amber animate-pulse"></span>
                            <span>{{ setting('news_247_badge', 'Layanan Siaga 24/7 • Tim Reaksi Cepat (TRC)') }}</span>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold tracking-tight font-headline-xl text-white">{{ setting('news_247_title', 'Layanan Pengaduan & Bantuan Cepat 24 Jam') }}</h2>
                        <p class="text-sm md:text-base text-surface-container-low/90 leading-relaxed font-body-md">{{ setting('news_247_subtitle', 'Mengalami gangguan distribusi air, pipa bocor, atau kendala meteran? Laporkan segera ke posko pengaduan resmi PERUMDA Air Minum Tirta Kepri.') }}</p>
                        <div class="flex flex-col gap-4 mt-4">
                            @php
                                $call = $settings['news_247_call'] ?? setting('news_247_call', '(0771) 21574');
                                $cleanCall = preg_replace('/[^0-9]/', '', $call);
                            @endphp
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['branch_1_wa'] ?? '08117782155') }}" target="_blank" class="flex flex-col items-center justify-center gap-2 px-3 py-3 rounded-xl bg-gradient-to-br from-status-success to-emerald-600 text-white font-semibold text-xs md:text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M12.031 0C5.394 0 0 5.394 0 12.031a11.97 11.97 0 001.6 5.96L0 24l6.17-1.6a11.97 11.97 0 005.861 1.53h.005c6.634 0 12.028-5.394 12.028-12.031S18.665 0 12.031 0zM12.036 21.905h-.003a9.944 9.944 0 01-5.068-1.378l-.363-.215-3.774.989.998-3.68-.236-.375a9.957 9.957 0 01-1.524-5.215c0-5.512 4.484-9.997 10.002-9.997 2.671 0 5.18 1.04 7.067 2.93a9.972 9.972 0 012.923 7.07c-.001 5.511-4.485 9.996-9.998 9.996zm5.485-7.493c-.301-.151-1.782-.879-2.059-.979-.277-.1-.478-.151-.678.151-.2.301-.777.979-.953 1.18-.175.201-.352.226-.653.076a8.212 8.212 0 01-2.417-1.492 9.074 9.074 0 01-1.684-2.096c-.176-.301-.019-.464.132-.614.136-.135.301-.352.452-.527.151-.176.201-.301.301-.502.1-.2.05-.376-.025-.527-.075-.151-.678-1.631-.928-2.234-.244-.588-.493-.508-.678-.517-.175-.008-.376-.008-.577-.008a1.1 1.1 0 00-.791.368c-.277.301-1.055 1.029-1.055 2.51s1.08 2.912 1.23 3.113c.151.2 2.122 3.238 5.139 4.54.718.311 1.278.497 1.714.636.72.189 1.376.162 1.895.098.58-.073 1.782-.728 2.033-1.431.251-.703.251-1.306.175-1.431-.075-.126-.276-.201-.577-.352z"></path></svg>
                                    <span class="tracking-wide">{{ $settings['branch_1_name'] ?? 'Tanjungpinang' }}</span>
                                </a>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['branch_2_wa'] ?? '08123456789') }}" target="_blank" class="flex flex-col items-center justify-center gap-2 px-3 py-3 rounded-xl bg-gradient-to-br from-status-success to-emerald-600 text-white font-semibold text-xs md:text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M12.031 0C5.394 0 0 5.394 0 12.031a11.97 11.97 0 001.6 5.96L0 24l6.17-1.6a11.97 11.97 0 005.861 1.53h.005c6.634 0 12.028-5.394 12.028-12.031S18.665 0 12.031 0zM12.036 21.905h-.003a9.944 9.944 0 01-5.068-1.378l-.363-.215-3.774.989.998-3.68-.236-.375a9.957 9.957 0 01-1.524-5.215c0-5.512 4.484-9.997 10.002-9.997 2.671 0 5.18 1.04 7.067 2.93a9.972 9.972 0 012.923 7.07c-.001 5.511-4.485 9.996-9.998 9.996zm5.485-7.493c-.301-.151-1.782-.879-2.059-.979-.277-.1-.478-.151-.678.151-.2.301-.777.979-.953 1.18-.175.201-.352.226-.653.076a8.212 8.212 0 01-2.417-1.492 9.074 9.074 0 01-1.684-2.096c-.176-.301-.019-.464.132-.614.136-.135.301-.352.452-.527.151-.176.201-.301.301-.502.1-.2.05-.376-.025-.527-.075-.151-.678-1.631-.928-2.234-.244-.588-.493-.508-.678-.517-.175-.008-.376-.008-.577-.008a1.1 1.1 0 00-.791.368c-.277.301-1.055 1.029-1.055 2.51s1.08 2.912 1.23 3.113c.151.2 2.122 3.238 5.139 4.54.718.311 1.278.497 1.714.636.72.189 1.376.162 1.895.098.58-.073 1.782-.728 2.033-1.431.251-.703.251-1.306.175-1.431-.075-.126-.276-.201-.577-.352z"></path></svg>
                                    <span class="tracking-wide">{{ $settings['branch_2_name'] ?? 'Kijang' }}</span>
                                </a>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['branch_3_wa'] ?? '08134567890') }}" target="_blank" class="flex flex-col items-center justify-center gap-2 px-3 py-3 rounded-xl bg-gradient-to-br from-status-success to-emerald-600 text-white font-semibold text-xs md:text-sm shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M12.031 0C5.394 0 0 5.394 0 12.031a11.97 11.97 0 001.6 5.96L0 24l6.17-1.6a11.97 11.97 0 005.861 1.53h.005c6.634 0 12.028-5.394 12.028-12.031S18.665 0 12.031 0zM12.036 21.905h-.003a9.944 9.944 0 01-5.068-1.378l-.363-.215-3.774.989.998-3.68-.236-.375a9.957 9.957 0 01-1.524-5.215c0-5.512 4.484-9.997 10.002-9.997 2.671 0 5.18 1.04 7.067 2.93a9.972 9.972 0 012.923 7.07c-.001 5.511-4.485 9.996-9.998 9.996zm5.485-7.493c-.301-.151-1.782-.879-2.059-.979-.277-.1-.478-.151-.678.151-.2.301-.777.979-.953 1.18-.175.201-.352.226-.653.076a8.212 8.212 0 01-2.417-1.492 9.074 9.074 0 01-1.684-2.096c-.176-.301-.019-.464.132-.614.136-.135.301-.352.452-.527.151-.176.201-.301.301-.502.1-.2.05-.376-.025-.527-.075-.151-.678-1.631-.928-2.234-.244-.588-.493-.508-.678-.517-.175-.008-.376-.008-.577-.008a1.1 1.1 0 00-.791.368c-.277.301-1.055 1.029-1.055 2.51s1.08 2.912 1.23 3.113c.151.2 2.122 3.238 5.139 4.54.718.311 1.278.497 1.714.636.72.189 1.376.162 1.895.098.58-.073 1.782-.728 2.033-1.431.251-.703.251-1.306.175-1.431-.075-.126-.276-.201-.577-.352z"></path></svg>
                                    <span class="tracking-wide">{{ $settings['branch_3_name'] ?? 'Tj. Uban' }}</span>
                                </a>
                            </div>
                            <a href="tel:{{ $cleanCall }}" class="flex justify-center items-center gap-2 px-4 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white border border-white/25 font-semibold text-sm shadow hover:shadow-md transition-all group">
                                <span class="material-symbols-outlined text-[20px] group-hover:scale-110 transition-transform">call</span>
                                <span>Hubungi Call Center: {{ $call }}</span>
                            </a>
                        </div>
                        <div class="pt-6 mt-2 border-t border-white/15 flex items-center justify-center gap-2 text-xs text-surface-container-low/90">
                            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px] text-status-success">verified</span> Posko Siaga 24 Jam</span>
                            <span class="opacity-50">&bull;</span>
                            <span>Wilayah Bintan &amp; Tanjungpinang</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')

</body>
</html>
