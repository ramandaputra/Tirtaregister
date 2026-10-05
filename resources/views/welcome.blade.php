<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
<body class="bg-surface-ice text-on-surface antialiased">

    {{-- Panggil Navbar Partial yang Sudah Dibuat --}}
    @include('layouts.partials.navbar')

    {{-- Konten Utama Halaman Welcome --}}
    <main class="w-full pt-28 bg-surface-ice min-h-screen">
        <div class="flex flex-col w-full max-w-[1280px] mx-auto px-margin">
            <section class="relative w-full bg-surface-container-lowest overflow-hidden py-space-xl">
<div class="absolute -right-24 -top-24 w-96 h-96 rounded-full bg-primary-fixed/30 blur-3xl pointer-events-none"></div>
<div class="absolute -left-20 bottom-0 w-80 h-80 rounded-full bg-tertiary-fixed/20 blur-2xl pointer-events-none"></div>
<div class="relative max-w-[1280px] mx-auto px-margin">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-center">
<div class="lg:col-span-7 space-y-space-md">
<div class="inline-flex items-center gap-space-xs px-space-sm py-space-xs rounded-full bg-surface-container-low text-primary">
<span class="material-symbols-outlined text-[16px]">water_drop</span>
<span class="font-label-sm text-label-sm uppercase tracking-wider">Layanan Pasang Baru Mandiri &amp; Cepat</span>
</div>
<h1 class="font-headline-xl text-headline-xl text-on-surface font-bold tracking-tight leading-tight">
            Pendaftaran Sambungan Baru Air Bersih <span class="text-primary">PERUMDA Tirta Kepri</span>
</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed max-w-2xl">
            Kemudahan pengajuan pemasangan instalasi meter air bersih secara online untuk masyarakat dan instansi di wilayah Provinsi Kepulauan Riau (Tanjungpinang, Bintan, dan sekitarnya). Aman, transparan, dan dapat dipantau langsung.
          </p>
<!-- Quick Tracking Search Bar -->
<div class="pt-space-sm">
<div class="p-space-sm bg-surface-container-low rounded-xl shadow-sm">
<label class="block font-label-md text-label-md text-on-surface mb-space-xs">
                Sudah pernah mendaftar? Lacak Progres Pengajuan Anda
              </label>
<form class="flex flex-col sm:flex-row items-stretch gap-space-xs" id="trackForm" onsubmit="event.preventDefault(); window.handleTracking();">
<div class="relative flex-1">
<span class="absolute inset-y-0 left-0 pl-space-sm flex items-center pointer-events-none text-on-surface-variant">
<span class="material-symbols-outlined text-[20px]">search</span>
</span>
<input class="w-full h-11 pl-10 pr-space-md rounded-lg bg-surface-container-lowest text-on-surface font-body-md text-body-md placeholder:text-outline focus:outline-none shadow-sm" id="trackInput" placeholder="Masukkan Nomor Registrasi (REG-XXXX) atau NIK KTP..." required="" type="text">
</div>
<button class="h-11 px-space-lg rounded-lg bg-primary text-on-primary font-label-md text-label-md font-semibold hover:bg-on-primary-fixed-variant transition-colors flex items-center justify-center gap-space-xs shrink-0 shadow-sm" type="submit">
<span class="material-symbols-outlined text-[18px]">travel_explore</span>
<span class="">Cek Status</span>
</button>
</form>
<div class="hidden mt-space-xs font-body-sm text-body-sm text-primary flex items-center gap-space-xs" id="trackingFeedback">
<span class="material-symbols-outlined text-[16px] text-status-success">check_circle</span>
<span id="feedbackText" class="">Nomor registrasi terverifikasi di pangkalan data BUMD.</span>
</div>
</div>
</div>
<!-- Trust Badges -->
<div class="pt-space-xs flex flex-wrap items-center gap-space-lg text-on-surface-variant font-body-sm text-body-sm">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-[18px]">verified</span>
<span class="">Resmi Pemprov Kepri</span>
</div>
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-[18px]">lock</span>
<span class="">Data Terenkripsi</span>
</div>
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-[18px]">schedule</span>
<span class="">Survei Maks. 3 Hari</span>
</div>
</div>
</div>
<!-- Hero Visual / Stat Panel -->
<div class="lg:col-span-5 relative">
<div class="relative rounded-2xl bg-surface-container p-space-md overflow-hidden shadow-sm">
<div class="relative h-64 rounded-xl overflow-hidden mb-space-md">
<img class="w-full h-full object-cover" data-alt="Modern clean water pipeline intake facility and reservoir in Kepulauan Riau, tropical blue sky, crystal clear water reflection, engineering precision, civic architectural backdrop in soft blue and white hues." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAsl3UmPJr0ZlnnruhXUIMVx7nPSiAn4pZn1jfUVtyO27_kN-XT3aO7I1vhaYUjcWK5jTkBfh2bjD5ZcJQ1jiMWLCJ_CKDQKebZJsWbbSzwBl9ETsjGs6rXXu_nMs2fES60KfIBYtf9BGJ3G3bXJLv5po9WaUeTAk8Y0AMvKEJwih2EV7kw9NhlzWfcw5nFXScSFwOKTJ2gQWXzL3OxRbVfa_vw_tfOk5W3sPAIcRZRqZLqqovWCawiEA">
<div class="absolute inset-0 bg-gradient-to-t from-inverse-surface/80 via-transparent to-transparent flex items-end p-space-md">
<div class="text-inverse-on-surface">
<span class="inline-block px-space-xs py-0.5 rounded bg-civic-amber text-on-surface font-label-sm text-label-sm font-bold uppercase mb-1">Infrastruktur Terintegrasi</span>
<p class="font-headline-sm text-headline-sm font-semibold text-white leading-snug">Waduk Sei Gesek &amp; Kolam Kolong Enam</p>
<p class="font-body-sm text-body-sm text-surface-container-highest">Sumber air baku utama pemenuhan kebutuhan Pulau Bintan &amp; Tanjungpinang</p>
</div>
</div>
</div>
<!-- Mini stats row -->
<div class="grid grid-cols-2 gap-space-sm">
<div class="bg-surface-container-lowest p-space-sm rounded-lg shadow-sm">
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase">Kapasitas Produksi</p>
<p class="font-headline-sm text-headline-sm text-primary font-bold">450+ Ltr/dtk</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Standar Kontinuitas 24 Jam</p>
</div>
<div class="bg-surface-container-lowest p-space-sm rounded-lg shadow-sm">
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase">Biaya Transparan</p>
<p class="font-headline-sm text-headline-sm text-tertiary font-bold">Sesuai SK</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Tanpa Biaya Tambahan Liar</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Main Selection Section: 2 Large Prominent Cards -->
<section class="w-full py-space-xl px-margin">
<div class="max-w-[1280px] mx-auto">
<div class="text-center max-w-3xl mx-auto mb-space-xl">
<span class="inline-flex items-center gap-space-xs px-space-sm py-space-xs rounded-full bg-primary/10 text-primary font-label-sm text-label-sm uppercase tracking-wide">
          Langkah Awal Registrasi
        </span>
<h2 class="font-headline-xl text-headline-xl text-on-surface font-bold mt-space-xs mb-space-xs">
          Pilih Kategori Permohonan Sambungan Baru
        </h2>
<p class="font-body-lg text-body-lg text-on-surface-variant">
          Silakan pilih peruntukan bangunan Anda untuk mendapatkan persyaratan formulir dan skema tarif yang tepat sesuai regulasi daerah.
        </p>
</div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter items-stretch"><!-- CARD 1: Sambungan Rumah Tangga -->
<div class="flex flex-col justify-between items-center text-center bg-surface-container-lowest rounded-2xl p-space-xl shadow-md hover:shadow-xl transition-all duration-300 relative group cursor-pointer border border-transparent hover:border-primary/20">
  <div class="flex flex-col items-center">
    <div class="mb-space-md">
      <span class="px-space-sm py-1 rounded-full bg-civic-amber/20 text-on-surface font-label-sm text-label-sm uppercase font-bold tracking-wider">
        Paling Populer • Residensial
      </span>
    </div>
    <div class="w-20 h-20 rounded-2xl bg-surface-container-low flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-on-primary transition-all duration-300 shadow-sm mb-space-md">
      <span class="material-symbols-outlined text-[48px]">home</span>
    </div>
    <h3 class="font-headline-md text-headline-md text-on-surface font-bold group-hover:text-primary transition-colors mb-space-xs">
      Sambungan Rumah Tangga
    </h3>
    <p class="font-body-md text-body-md text-on-surface-variant max-w-md leading-relaxed">
      Pemasangan baru air bersih untuk rumah tinggal pribadi, komplek hunian keluarga, dan indekos.
    </p>
  </div>
  <div class="w-full pt-space-lg mt-space-md border-t border-surface-container">
    <button class="w-full h-12 rounded-lg bg-primary text-on-primary font-label-md text-label-md font-semibold hover:bg-on-primary-fixed-variant transition-all flex items-center justify-center gap-space-xs shadow-md" onclick="alert('Membuka Formulir Pendaftaran Sambungan Rumah Tangga...')" type="button">
      <span class="">Pilih &amp; Daftar Sekarang</span>
      <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
    </button>
  </div>
</div>

<!-- CARD 2: Sambungan Fasilitas Umum & Sosial -->
<div class="flex flex-col justify-between items-center text-center bg-surface-container-lowest rounded-2xl p-space-xl shadow-md hover:shadow-xl transition-all duration-300 relative group cursor-pointer border border-transparent hover:border-tertiary/20">
  <div class="flex flex-col items-center">
    <div class="mb-space-md">
      <span class="px-space-sm py-1 rounded-full bg-tertiary-container/30 text-on-tertiary-container font-label-sm text-label-sm uppercase font-bold tracking-wider">
        Sosial &amp; Fasum
      </span>
    </div>
    <div class="w-20 h-20 rounded-2xl bg-surface-container-low flex items-center justify-center text-tertiary group-hover:bg-tertiary group-hover:text-on-tertiary transition-all duration-300 shadow-sm mb-space-md">
      <span class="material-symbols-outlined text-[48px]">domain</span>
    </div>
    <h3 class="font-headline-md text-headline-md text-on-surface font-bold group-hover:text-tertiary transition-colors mb-space-xs">
      Sambungan Fasilitas Umum
    </h3>
    <p class="font-body-md text-body-md text-on-surface-variant max-w-md leading-relaxed">
      Layanan bersubsidi khusus tempat ibadah, sarana pendidikan, panti sosial, dan fasilitas warga.
    </p>
  </div>
  <div class="w-full pt-space-lg mt-space-md border-t border-surface-container">
    <button class="w-full h-12 rounded-lg bg-tertiary text-on-tertiary font-label-md text-label-md font-semibold hover:bg-on-tertiary-fixed-variant transition-all flex items-center justify-center gap-space-xs shadow-md" onclick="alert('Membuka Formulir Pendaftaran Fasilitas Umum &amp; Sosial...')" type="button">
      <span class="">Pilih &amp; Daftar Sekarang</span>
      <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
    </button>
  </div>
</div></div>
</div>
</section>
<!-- 4 Langkah Mudah Pasang Baru -->
<section class="w-full bg-surface-container-low py-space-xl px-margin">
<div class="max-w-[1280px] mx-auto">
<div class="flex flex-col md:flex-row md:items-end justify-between mb-space-lg gap-space-md">
<div>
<span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-bold">Alur Pendaftaran Terpadu</span>
<h2 class="font-headline-xl text-headline-xl text-on-surface font-bold mt-1">
            4 Langkah Mudah Pasang Baru
          </h2>
</div>
<p class="font-body-md text-body-md text-on-surface-variant max-w-md">
          Proses resmi, transparan, dan dapat dipantau setiap saat tanpa perlu bolak-balik ke kantor cabang.
        </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter relative">
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
              Petugas teknis PERUMDA Tirta Kepri mendatangi lokasi Anda untuk mengukur jarak pipa distribusi dan tekanan jaringan.
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
<!-- Educational / About Section (Apa itu PERUMDA TIRTA KEPRI) -->

<!-- FAQ & Quick Helpdesk -->
<section class="w-full pb-space-xl px-margin">
<div class="max-w-[1280px] mx-auto">
<div class="w-full"><div class="max-w-3xl mx-auto w-full bg-surface-container-lowest rounded-2xl p-space-lg shadow-sm space-y-space-md">
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
<div class="grid grid-cols-1 md:grid-cols-3 gap-space-sm">
<a class="flex flex-col p-space-sm rounded-xl bg-surface-container-low hover:bg-surface-container transition-colors" href="https://wa.me/628117782155" target="_blank">
<div class="w-10 h-10 rounded-lg bg-status-success text-on-primary flex items-center justify-center shrink-0 mb-space-xs">
<span class="material-symbols-outlined text-[20px]">chat</span>
</div>
<div class="min-w-0">
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase">WhatsApp Pendaftaran</p>
<p class="font-title-md text-title-md font-bold text-on-surface truncate">0811-778-2155</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Respon Cepat Hari Kerja</p>
</div>
</a>
<div class="flex flex-col p-space-sm rounded-xl bg-surface-container-low">
<div class="w-10 h-10 rounded-lg bg-primary text-on-primary flex items-center justify-center shrink-0 mb-space-xs">
<span class="material-symbols-outlined text-[20px]">call</span>
</div>
<div class="min-w-0">
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase">Call Center Resmi</p>
<p class="font-title-md text-title-md font-bold text-on-surface truncate">(0771) 21555</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Senin - Jumat: 08.00 - 15.00 WIB</p>
</div>
</div>
<div class="flex flex-col p-space-sm rounded-xl bg-surface-container-low">
<div class="w-10 h-10 rounded-lg bg-secondary text-on-secondary flex items-center justify-center shrink-0 mb-space-xs">
<span class="material-symbols-outlined text-[20px]">location_on</span>
</div>
<div class="min-w-0">
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase">Kantor Pusat Pelayanan</p>
<p class="font-body-sm text-body-sm text-on-surface font-semibold leading-snug">
Jl. MT Haryono No. 56, Batu 3, Tanjungpinang
</p>
</div>
</div>
</div>
<div class="pt-space-xs p-space-sm rounded-lg bg-surface-ice flex items-center justify-between flex-wrap gap-space-xs">
<p class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-[16px]">security</span>
<span class="">Portal Terkoneksi dengan Sistem Manajemen Pelanggan (SIM-PDAM)</span>
</p>
<span class="font-label-sm text-label-sm text-status-success font-semibold flex items-center gap-space-xs">
<span class="inline-block w-2 h-2 rounded-full bg-status-success"></span>
Layanan Pelanggan Aktif
</span>
</div>
</div></div>
</div>
</section>
<!-- Interactive Client-side Script -->
<script>
    window.handleTracking = function() {
      const val = document.getElementById('trackInput').value.trim();
      const feedback = document.getElementById('trackingFeedback');
      const feedbackText = document.getElementById('feedbackText');
      if (val) {
        feedback.classList.remove('hidden');
        feedbackText.textContent = 'Mencari data permohonan ' + val + '... Mohon tunggu pengalihan.';
        setTimeout(() => {
          alert('Status Registrasi [' + val + ']: Berkas Anda sedang dalam tahap verifikasi teknis wilayah. Hubungi 0811-778-2155 untuk info lanjut.');
        }, 600);
      }
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
  </script>
        </div>
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')
    
</body>
</html>