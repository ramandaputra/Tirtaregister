<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Resmi - PERUMDA Air Minum Tirta Kepri</title>

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
            main > :first-child { margin-top: 0 !important; }
            main > :last-child { margin-bottom: 0 !important; }
        }
        ::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-surface-ice text-on-surface antialiased flex flex-col min-h-screen">

  {{-- Panggil Navbar Partial yang Sudah Dibuat --}}
    @include('layouts.partials.navbar')

    <!-- Main Content Layout -->
    <main class="flex-grow w-full">
        <div class="max-w-7xl mx-auto px-6 py-12 w-full space-y-10">
            <!-- Header Section Modern & Elegan -->
            <header class="flex flex-col items-center text-center max-w-3xl mx-auto space-y-4 pt-2 pb-2">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-primary-container/15 text-primary border border-primary-container/30 text-xs font-bold tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-primary-container animate-pulse"></span>
                    Pusat Informasi &amp; Publikasi
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-on-surface tracking-tight font-headline-xl leading-tight" style="margin-top: 50px;">
    Berita &amp; Pengumuman Resmi
</h1>
                <p class="text-sm md:text-base text-on-surface-variant font-body-md leading-relaxed max-w-2xl">
                    Dapatkan pembaruan terkini seputar operasional distribusi air bersih, jadwal pemeliharaan jaringan, dan informasi layanan PERUMDA Air Minum Tirta Kepri.
                </p>
            </header>

            <!-- Integrated Search & Filter Controls -->
            <div class="bg-surface-container-lowest rounded-2xl p-4 md:p-5 shadow-sm border border-surface-border flex flex-col md:flex-row items-center justify-between gap-4">
                <!-- Search Bar -->
                <div class="relative w-full md:w-80 shrink-0">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-on-surface-variant material-symbols-outlined text-[20px] pointer-events-none">search</span>
                    <input type="text" placeholder="Cari berita atau pengumuman..." class="w-full pl-10 pr-4 py-2.5 bg-surface-ice rounded-xl text-sm font-body-md text-on-surface border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary-container transition-all">
                </div>

                <!-- Category Filter Pills -->
                <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-1 md:pb-0 scrollbar-none">
                    <button class="filter-pill whitespace-nowrap px-4 py-2 rounded-xl text-xs md:text-sm font-semibold bg-primary text-on-primary shadow-sm transition-all cursor-pointer" data-category="all">
                        Semua ({{ $news->total() }})
                    </button>
                    <button class="filter-pill whitespace-nowrap px-4 py-2 rounded-xl text-xs md:text-sm font-medium bg-surface-ice text-on-surface-variant hover:bg-surface-container hover:text-on-surface border border-surface-border transition-all cursor-pointer" data-category="gangguan">
                        Gangguan &amp; Pemeliharaan
                    </button>
                    <button class="filter-pill whitespace-nowrap px-4 py-2 rounded-xl text-xs md:text-sm font-medium bg-surface-ice text-on-surface-variant hover:bg-surface-container hover:text-on-surface border border-surface-border transition-all cursor-pointer" data-category="kegiatan">
                        Berita Kegiatan
                    </button>
                    <button class="filter-pill whitespace-nowrap px-4 py-2 rounded-xl text-xs md:text-sm font-medium bg-surface-ice text-on-surface-variant hover:bg-surface-container hover:text-on-surface border border-surface-border transition-all cursor-pointer" data-category="layanan">
                        Layanan &amp; Edukasi
                    </button>
                </div>
            </div>

            <!-- 3-Column Modern News Grid (Data Dinamis dari Database) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
                @forelse($news as $item)
                    <article class="news-card bg-surface-container-lowest rounded-2xl border border-surface-border shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col h-full group" data-cat="{{ $item->category ?? 'kegiatan' }}">
                        <div class="relative aspect-[16/10] overflow-hidden bg-surface-ice">
                            <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/600x350' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                            <div class="absolute top-3.5 left-3.5 flex items-center gap-2">
                                <span class="px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed-variant font-semibold text-xs shadow-sm">
                                    {{ $item->category_label ?? 'Informasi' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1 justify-between">
                            <div>
                                <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium mb-2.5">
                                    <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
                                    <span>{{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : '' }}</span>
                                </div>
                                <h3 class="text-base md:text-lg font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2 leading-snug mb-2 cursor-pointer">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-sm text-on-surface-variant line-clamp-3 leading-relaxed mb-4">
                                    {{ Str::limit(strip_tags($item->content ?? $item->excerpt ?? ''), 120) }}
                                </p>
                            </div>
                            <div class="pt-4 border-t border-surface-border flex items-center justify-between mt-auto">
                                <span class="text-xs text-on-surface-variant font-medium">PERUMDA Tirta Kepri</span>
                                <a href="#" class="text-xs font-semibold text-primary group-hover:text-primary-container inline-flex items-center gap-1 transition-colors">
                                    Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12 bg-surface-container-lowest rounded-2xl border border-surface-border">
                        <span class="material-symbols-outlined text-4xl text-on-surface-variant mb-2">newspaper</span>
                        <p class="text-on-surface-variant font-medium">Belum ada berita yang dipublikasikan saat ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Section Pengaduan 24/7 -->
            <section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary to-on-primary-container text-on-primary shadow-lg border border-primary-container/30 p-6 md:p-8">
                <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-primary-container/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 space-y-4">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest/15 border border-white/20 text-xs font-semibold backdrop-blur-sm">
                            <span class="w-2 h-2 rounded-full bg-civic-amber animate-pulse"></span>
                            <span>Layanan Siaga 24/7 • Tim Reaksi Cepat (TRC)</span>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold tracking-tight font-headline-xl text-white">Layanan Pengaduan &amp; Bantuan Cepat 24 Jam</h2>
                        <p class="text-sm md:text-base text-surface-container-low/90 leading-relaxed font-body-md">Mengalami gangguan distribusi air, pipa bocor, atau kendala meteran? Laporkan segera ke posko pengaduan resmi PERUMDA Air Minum Tirta Kepri.</p>
                        <div class="flex flex-wrap items-center gap-3 pt-2">
                            <a href="https://wa.me/6281270008888" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-status-success text-white font-semibold text-sm shadow hover:opacity-95 transition-all">
                                <span class="material-symbols-outlined text-[18px]">chat</span>
                                <span>Kirim Laporan via WhatsApp</span>
                            </a>
                            <a href="tel:077121574" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white border border-white/25 font-semibold text-sm transition-all">
                                <span class="material-symbols-outlined text-[18px]">call</span>
                                <span>Hotline: (0771) 21574</span>
                            </a>
                        </div>
                    </div>
                    <div class="lg:col-span-5 bg-white/10 backdrop-blur-md rounded-xl p-5 border border-white/15 space-y-3.5">
                        <div class="text-xs font-bold uppercase tracking-wider text-surface-container-high">Kanal Kontak Resmi Pengaduan</div>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-civic-amber text-[20px] shrink-0 mt-0.5">headset_mic</span>
                                <div>
                                    <div class="text-xs text-surface-container-low/80">Call Center / Hotline</div>
                                    <div class="text-sm font-bold text-white">(0771) 21574 / 0811-778-21574</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-civic-amber text-[20px] shrink-0 mt-0.5">forum</span>
                                <div>
                                    <div class="text-xs text-surface-container-low/80">WhatsApp Pengaduan Cepat</div>
                                    <div class="text-sm font-bold text-white">0812-7000-8888</div>
                                    <div class="text-[11px] text-surface-container-low/80">(Format: ID Pelanggan, Nama, Alamat, Foto &amp; Kendala)</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-civic-amber text-[20px] shrink-0 mt-0.5">mail</span>
                                <div>
                                    <div class="text-xs text-surface-container-low/80">Email Laporan &amp; Pengaduan</div>
                                    <div class="text-sm font-bold text-white">pengaduan@tirtakepri.co.id</div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-2 border-t border-white/15 flex items-center justify-between text-xs text-surface-container-low/90">
                            <span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px] text-status-success">verified</span> Posko Siaga 24 Jam</span>
                            <span class="text-[11px]">Wilayah Bintan &amp; Tanjungpinang</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Pagination Dinamis Laravel -->
            <div class="mt-6">
                {{ $news->links() }}
            </div>
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')

    <!-- Hanya Script Khusus Filter Kategori Berita -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filterBtns = document.querySelectorAll('.filter-pill');
            const newsCards = document.querySelectorAll('.news-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterBtns.forEach(b => {
                        b.classList.remove('bg-primary', 'text-on-primary', 'shadow-sm');
                        b.classList.add('bg-surface-ice', 'text-on-surface-variant', 'hover:bg-surface-container');
                    });
                    btn.classList.add('bg-primary', 'text-on-primary', 'shadow-sm');
                    btn.classList.remove('bg-surface-ice', 'text-on-surface-variant', 'hover:bg-surface-container');

                    const category = btn.getAttribute('data-category');
                    newsCards.forEach(card => {
                        if (category === 'all' || card.getAttribute('data-cat') === category) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>