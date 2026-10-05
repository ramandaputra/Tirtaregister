<!DOCTYPE html><html lang="id" style=""><head><meta charset="utf-8"><meta content="width=device-width, initial-scale=1.0" name="viewport"><meta content="web_standard" name="shell-type"><link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"><link href="https://fonts.googleapis.com" rel="preconnect"><link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Plus+Jakarta+Sans:wght@600;700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"><style>@layer base{html,body{margin:0;padding:0;}body{overscroll-behavior:none;}main>:first-child{margin-top:0!important;}main>:last-child{margin-bottom:0!important;}}::-webkit-scrollbar{display:none;}</style><script src="https://cdn.tailwindcss.com"></script><script id="tailwind-config">tailwind.config={darkMode:"class",theme:{extend:{"colors":{"primary":"#006689","civic-amber":"#FFC10D","on-tertiary-fixed":"#001f23","error":"#ba1a1a","on-secondary-container":"#585d7d","status-success":"#0F9D58","surface-container-low":"#eaf5ff","outline":"#6e7980","tertiary-fixed-dim":"#75d5e2","on-error-container":"#93000a","tertiary-container":"#41a6b2","status-critical":"#D32F2F","on-primary-fixed-variant":"#004c68","on-primary":"#ffffff","on-surface":"#081e2a","surface-container-lowest":"#ffffff","error-container":"#ffdad6","surface-border":"#D5E2E8","on-surface-variant":"#3e484f","primary-fixed":"#c3e8ff","outline-variant":"#bdc8d0","secondary-fixed":"#dde1ff","inverse-surface":"#1f3340","surface-tint":"#006689","surface-container-highest":"#d0e5f7","on-background":"#081e2a","secondary-container":"#d3d8fd","surface-variant":"#d0e5f7","on-error":"#ffffff","on-secondary-fixed":"#141a35","inverse-on-surface":"#e5f2ff","surface-container":"#dff0ff","on-tertiary-fixed-variant":"#004f56","secondary-fixed-dim":"#bfc5e9","on-primary-fixed":"#001e2c","primary-container":"#00a4db","tertiary-fixed":"#92f1fe","on-secondary":"#ffffff","inverse-primary":"#79d1ff","on-secondary-fixed-variant":"#3f4563","primary-fixed-dim":"#79d1ff","surface-bright":"#f6faff","surface-ice":"#F4F8FA","tertiary":"#006972","on-primary-container":"#00354a","surface-container-high":"#d6ebfd","on-tertiary-container":"#00373c","background":"#f6faff","surface":"#f6faff","on-tertiary":"#ffffff","surface-dim":"#c8ddee","secondary":"#575d7c"},"borderRadius":{"DEFAULT":"0.125rem","lg":"0.25rem","xl":"0.5rem","full":"0.75rem"},"spacing":{"margin-mobile":"1rem","space-md":"1rem","margin":"2rem","gutter":"1.5rem","space-xl":"2.5rem","gutter-mobile":"1rem","space-sm":"0.5rem","space-lg":"1.5rem","space-xs":"0.25rem"},"fontFamily":{"label-md":["Plus Jakarta Sans"],"display-lg":["Plus Jakarta Sans"],"body-lg":["Inter"],"headline-sm":["Plus Jakarta Sans"],"label-sm":["Plus Jakarta Sans"],"body-md":["Inter"],"display-lg-mobile":["Plus Jakarta Sans"],"headline-xl":["Plus Jakarta Sans"],"body-sm":["Inter"],"headline-md":["Plus Jakarta Sans"],"headline-xl-mobile":["Plus Jakarta Sans"],"title-md":["Plus Jakarta Sans"]},"fontSize":{"label-md":["13px",{"lineHeight":"18px","fontWeight":"600"}],"display-lg":["48px",{"lineHeight":"56px","fontWeight":"700"}],"body-lg":["16px",{"lineHeight":"24px","fontWeight":"400"}],"headline-sm":["20px",{"lineHeight":"28px","fontWeight":"600"}],"label-sm":["11px",{"lineHeight":"16px","fontWeight":"600"}],"body-md":["14px",{"lineHeight":"20px","fontWeight":"400"}],"display-lg-mobile":["32px",{"lineHeight":"40px","fontWeight":"700"}],"headline-xl":["36px",{"lineHeight":"44px","fontWeight":"700"}],"body-sm":["12px",{"lineHeight":"18px","fontWeight":"400"}],"headline-md":["24px",{"lineHeight":"32px","fontWeight":"600"}],"headline-xl-mobile":["26px",{"lineHeight":"34px","fontWeight":"700"}],"title-md":["16px",{"lineHeight":"24px","fontWeight":"600"}]}}}};</script></head><body class="bg-surface-ice text-on-surface antialiased"><main class="w-full bg-surface-ice min-h-screen"><div class="flex flex-col w-full">
<!-- Interactive script for active navbar & filtering tabs -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
      // Synchronize App Shell active menu state
      const navLinks = document.querySelectorAll('header nav a');
      navLinks.forEach(link => {
        if (link.getAttribute('data-path') === 'berita') {
          link.classList.add('bg-primary-container', 'text-on-primary-container', 'font-semibold');
          link.classList.remove('text-on-surface-variant');
        } else {
          link.classList.remove('bg-primary-container', 'text-on-primary-container', 'font-semibold');
          link.classList.add('text-on-surface-variant');
        }
      });

      // Quick filter tabs functionality
      const filterBtns = document.querySelectorAll('.filter-pill');
      const newsCards = document.querySelectorAll('.news-card');

      filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          filterBtns.forEach(b => {
            b.classList.remove('bg-primary', 'text-on-primary', 'shadow-sm');
            b.classList.add('bg-surface-container-low', 'text-on-surface-variant', 'hover:bg-surface-container');
          });
          btn.classList.add('bg-primary', 'text-on-primary', 'shadow-sm');
          btn.classList.remove('bg-surface-container-low', 'text-on-surface-variant', 'hover:bg-surface-container');

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

{{-- Panggil Navbar Partial yang Sudah Dibuat --}}
    @include('layouts.partials.navbar')

<!-- Main Content Layout -->
<div class="max-w-7xl mx-auto px-6 py-12 w-full space-y-10">
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
        Semua (48)
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

  <!-- 3-Column Modern News Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
    <!-- Card 1: Gangguan Aliran -->
    <article class="news-card bg-surface-container-lowest rounded-2xl border border-surface-border shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col h-full group" data-cat="gangguan">
      <div class="relative aspect-[16/10] overflow-hidden bg-surface-ice">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDIovxMQp_38nhM0Ue27Hb2WcP_wnxJHvu4w5eXSHeQ00-S5wYjuagNM1Nn9wNoxyHptVbD_fpUd4VoD4upOUQpwa5b00SzU_5hYKyztuGbTKRfGNY3WrEaTRwtRQsAWNwjt2ENtSe6nwDSFCJWt5yzdZA-UJOKhbvxoPw4SDxlcbkN6ykOGlsINdLArXATyaBqiETY5-Sx-bUyeG7jiibEevAd7-6SVtPMiWHr0-0x8PDSCxYrzGIzqg" alt="Perbaikan Pipa Tirta Kepri" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
        <div class="absolute top-3.5 left-3.5 flex items-center gap-2">
          <span class="px-3 py-1 rounded-full bg-civic-amber text-on-surface font-semibold text-xs shadow-sm">
            Gangguan Aliran
          </span>
        </div>
      </div>
      <div class="p-6 flex flex-col flex-1 justify-between">
        <div>
          <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium mb-2.5">
            <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
            <span class="">15 Mei 2025</span>
            <span class="">•</span>
            <span class="text-error font-semibold flex items-center gap-1">
              <span class="w-1.5 h-1.5 rounded-full bg-error animate-pulse"></span> Estimasi: 8 Jam
            </span>
          </div>
          <h3 class="text-base md:text-lg font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2 leading-snug mb-2 cursor-pointer">
            Jadwal Intermittent Distribusi Air Bersih Wilayah Bintan Center Sehubungan Pembersihan Bak Sedimentasi
          </h3>
          <p class="text-sm text-on-surface-variant line-clamp-3 leading-relaxed mb-4">
            Pembersihan rutin bak penampungan sedimen IPA Gesek dilakukan bertahap guna menjaga standar kejernihan air minum sesuai Permenkes.
          </p>
        </div>
        <div class="pt-4 border-t border-surface-border flex items-center justify-between mt-auto">
          <span class="text-xs text-on-surface-variant font-medium">Wilayah Bintan Center</span>
          <a href="#" class="text-xs font-semibold text-primary group-hover:text-primary-container inline-flex items-center gap-1 transition-colors">
            Detail Jadwal <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </article>

    <!-- Card 2: Tata Kelola -->
    <article class="news-card bg-surface-container-lowest rounded-2xl border border-surface-border shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col h-full group" data-cat="kegiatan">
      <div class="relative aspect-[16/10] overflow-hidden bg-surface-ice">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBlEtlY7kLCifXb3IrJAGNI1Mqdj8nlerBXyszHafo4sare7dyhmF2S-I8YB4c7wVV3lcKD43Z5HpgWbV896NH5DntXkoa6mO-BMOzEEU9FQbmJf7nw_2nKNMb8--GoI6iIWgTYTJq-CrtVAK-dLBqy0wWC367JaS0mB5InjXSkwR9UfDfqHTekTa4tmfmVKPeORkE6HnQnEo2u_1W77qog-IvKpxRtTmuvxE13UxfHgB3hocYX8xGXlA" alt="Rapat BPKP Kepri" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
        <div class="absolute top-3.5 left-3.5 flex items-center gap-2">
          <span class="px-3 py-1 rounded-full bg-primary-fixed text-on-primary-fixed-variant font-semibold text-xs shadow-sm">
            Berita Kegiatan
          </span>
        </div>
      </div>
      <div class="p-6 flex flex-col flex-1 justify-between">
        <div>
          <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium mb-2.5">
            <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
            <span class="">13 Mei 2025</span>
            <span class="">•</span>
            <span class="">Tata Kelola Publik</span>
          </div>
          <h3 class="text-base md:text-lg font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2 leading-snug mb-2 cursor-pointer">
            PERUMDA Tirta Kepri Gandeng BPKP Kepri Perkuat Tata Kelola dan Transparansi Layanan Publik
          </h3>
          <p class="text-sm text-on-surface-variant line-clamp-3 leading-relaxed mb-4">
            Penandatanganan komitmen bersama dalam pengawasan Good Corporate Governance (GCG) untuk akuntabilitas operasional dan efisiensi air tak berekening.
          </p>
        </div>
        <div class="pt-4 border-t border-surface-border flex items-center justify-between mt-auto">
          <span class="text-xs text-on-surface-variant font-medium">Kantor Pusat Tanjungpinang</span>
          <a href="#" class="text-xs font-semibold text-primary group-hover:text-primary-container inline-flex items-center gap-1 transition-colors">
            Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </article>

    <!-- Card 3: Layanan QRIS -->
    <article class="news-card bg-surface-container-lowest rounded-2xl border border-surface-border shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col h-full group" data-cat="layanan">
      <div class="relative aspect-[16/10] overflow-hidden bg-surface-ice">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDozzfU-mZTxEvYx-HdEFdh3MqXSOAybaTamz6Cf6PbNE0xIV2LL5AKuoXJte9onIZERVMkNN7Ye8PJGmhSJi8bTBG-7nG5j_Jb6s9kR7HwlP-RZnF7BBAohgSo88PE7S4Jrg06-KF0lrtEvGbo8n52Z3hqpgJLOxY9KBRYIbOJlUU1F02kr9nbo1tDhCcvPEWDrzXzPmJdZfnZSb4yStAQyOwH0JbQ8CqsGr3MCQokbXAnrS-alS1rjQ" alt="Pembayaran QRIS" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
        <div class="absolute top-3.5 left-3.5 flex items-center gap-2">
          <span class="px-3 py-1 rounded-full bg-status-success/15 text-status-success font-semibold text-xs shadow-sm">
            Layanan Pelanggan
          </span>
        </div>
      </div>
      <div class="p-6 flex flex-col flex-1 justify-between">
        <div>
          <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium mb-2.5">
            <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
            <span class="">10 Mei 2025</span>
            <span class="">•</span>
            <span class="text-status-success font-semibold flex items-center gap-0.5">
              <span class="material-symbols-outlined text-[14px]">verified</span> Bebas Antre
            </span>
          </div>
          <h3 class="text-base md:text-lg font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2 leading-snug mb-2 cursor-pointer">
            Sosialisasi Kemudahan Pembayaran Rekening Air Bersih Melalui Mobile Banking &amp; QRIS Nasional
          </h3>
          <p class="text-sm text-on-surface-variant line-clamp-3 leading-relaxed mb-4">
            Kini pelanggan di pulau-pulau dapat melunasi tagihan bulanan tepat waktu tanpa antre di loket melalui 20+ kanal perbankan dan e-wallet nasional.
          </p>
        </div>
        <div class="pt-4 border-t border-surface-border flex items-center justify-between mt-auto">
          <span class="text-xs text-on-surface-variant font-medium">Online &amp; Loket Mitra</span>
          <a href="#" class="text-xs font-semibold text-primary group-hover:text-primary-container inline-flex items-center gap-1 transition-colors">
            Panduan Bayar <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </article>

    <!-- Card 4: Konservasi Sumber Air -->
    <article class="news-card bg-surface-container-lowest rounded-2xl border border-surface-border shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col h-full group" data-cat="gangguan">
      <div class="relative aspect-[16/10] overflow-hidden bg-surface-ice">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAw0aY1gVD2qUUVwNLA3cX5zUbWQ_HcwNMLOw-FJdRq1T9gWJXFLZ9lpxWy18YDuKKwfpCl-br8tYZ-BHuFSXYCgtVfJhTh8wIOOt_LmajANlltQOgkYAiF2fu4WdFQJPx0b44_ZPJQrAsFO3uzbVEyGInhUeJ2F4WjegtSsoiNsvvjVMT-vjjMyVfG7ScVNJ9c5l28_-wlW4mQYnUDIH3_aSOmn7MP8_xbI08BPvgVqIpdKuJHOzcnhg" alt="Waduk Sei Pulai" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
        <div class="absolute top-3.5 left-3.5 flex items-center gap-2">
          <span class="px-3 py-1 rounded-full bg-primary-container text-on-primary-container font-semibold text-xs shadow-sm">
            Pengumuman
          </span>
        </div>
      </div>
      <div class="p-6 flex flex-col flex-1 justify-between">
        <div>
          <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium mb-2.5">
            <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
            <span class="">07 Mei 2025</span>
            <span class="">•</span>
            <span class="">Waduk &amp; Sumber Baku</span>
          </div>
          <h3 class="text-base md:text-lg font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2 leading-snug mb-2 cursor-pointer">
            Himbauan Penghematan dan Penampungan Air Selama Periode Musim Kemarau di Pulau Bintan
          </h3>
          <p class="text-sm text-on-surface-variant line-clamp-3 leading-relaxed mb-4">
            Menjaga kestabilan debit waduk Sei Pulai dan Kolong Enam, masyarakat dianjurkan menampung air secara bijak dan segera melaporkan titik kebocoran.
          </p>
        </div>
        <div class="pt-4 border-t border-surface-border flex items-center justify-between mt-auto">
          <span class="text-xs text-on-surface-variant font-medium">Wilayah Bintan &amp; TPI</span>
          <a href="#" class="text-xs font-semibold text-primary group-hover:text-primary-container inline-flex items-center gap-1 transition-colors">
            Baca Himbauan <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </article>

    <!-- Card 5: Infrastruktur Jaringan -->
    <article class="news-card bg-surface-container-lowest rounded-2xl border border-surface-border shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col h-full group" data-cat="kegiatan">
      <div class="relative aspect-[16/10] overflow-hidden bg-surface-ice">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuD8lSUweS1ll5j5huUnzTWcP-Q4U8hrLi7AF8X_X4gJDaY8bVM-mSDGoEp6cEMFVuh38CikheCPECTezNOqa5vpp8uCXvw0YfCJX-Xub1nL0hi-FZTUs2pDZYKHZFS9jcIWf0aQqKk97wVbHw1WJ9pXBK49QAfwjuxMIcSWIP_yb47g3n_HWTmX-Cj0pTZwsebyGQewIQKrBtEI7OxRSuHNRhw8XjUOH7_6oNlF8CEPa-Sc7edtMbc5DQ" alt="Pipa Dompak" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
        <div class="absolute top-3.5 left-3.5 flex items-center gap-2">
          <span class="px-3 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-semibold text-xs shadow-sm">
            Infrastruktur
          </span>
        </div>
      </div>
      <div class="p-6 flex flex-col flex-1 justify-between">
        <div>
          <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium mb-2.5">
            <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
            <span class="">03 Mei 2025</span>
            <span class="">•</span>
            <span class="text-status-success font-semibold">Progress: 100% Selesai</span>
          </div>
          <h3 class="text-base md:text-lg font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2 leading-snug mb-2 cursor-pointer">
            Penyelesaian Pemasangan Jaringan Pipa Distribusi Baru Sepanjang 4,2 KM di Kawasan Dompak
          </h3>
          <p class="text-sm text-on-surface-variant line-clamp-3 leading-relaxed mb-4">
            Ekspansi pipa transmisi HDPE 300 mm memastikan suplai air bersih terpadu bagi kawasan perkantoran pemprov serta hunian sekitar.
          </p>
        </div>
        <div class="pt-4 border-t border-surface-border flex items-center justify-between mt-auto">
          <span class="text-xs text-on-surface-variant font-medium">Pusat Pemprov Dompak</span>
          <a href="#" class="text-xs font-semibold text-primary group-hover:text-primary-container inline-flex items-center gap-1 transition-colors">
            Rincian Proyek <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </article>

    <!-- Card 6: Tirta Mengajar CSR -->
    <article class="news-card bg-surface-container-lowest rounded-2xl border border-surface-border shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col h-full group" data-cat="layanan">
      <div class="relative aspect-[16/10] overflow-hidden bg-surface-ice">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8K0ONdUzl_gJKd54FsGhqZAWSLcQQ1kdGJJl3SCwd3k4Yx-EXkNFFIaNEi_H_ThkeNsSDaVF12FtkwjbHNr-vy5F_liTaw9nmSIaAewoVuOAhgOSl-67J9FVUwjUMO7msCz6HYWyL7NLM1sOXhSe1Xu0_0Q0auMO_L8nsaPUmqhFZMXYNYttW1JbMo3HDn1BHG8qLoHBn3JEkCgYrB5ghMnKlg4YYcao2RiqaejHUcT9WAfocqV_mXA" alt="CSR Edukasi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
        <div class="absolute top-3.5 left-3.5 flex items-center gap-2">
          <span class="px-3 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-semibold text-xs shadow-sm">
            CSR &amp; Edukasi
          </span>
        </div>
      </div>
      <div class="p-6 flex flex-col flex-1 justify-between">
        <div>
          <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium mb-2.5">
            <span class="material-symbols-outlined text-[16px] text-primary">calendar_today</span>
            <span class="">28 April 2025</span>
            <span class="">•</span>
            <span class="">Generasi Muda</span>
          </div>
          <h3 class="text-base md:text-lg font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-2 leading-snug mb-2 cursor-pointer">
            Program Tirta Mengajar: Edukasi Konservasi Sumber Daya Air di SMA Negeri 1 Tanjungpinang
          </h3>
          <p class="text-sm text-on-surface-variant line-clamp-3 leading-relaxed mb-4">
            Menumbuhkan kesadaran generasi muda kepulauan tentang pentingnya efisiensi konsumsi air perpipaan dan pelestarian resapan daerah tangkapan air.
          </p>
        </div>
        <div class="pt-4 border-t border-surface-border flex items-center justify-between mt-auto">
          <span class="text-xs text-on-surface-variant font-medium">SMAN 1 Tanjungpinang</span>
          <a href="#" class="text-xs font-semibold text-primary group-hover:text-primary-container inline-flex items-center gap-1 transition-colors">
            Galeri Kegiatan <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
          </a>
        </div>
      </div>
    </article>
  </div><section class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary to-on-primary-container text-on-primary shadow-lg border border-primary-container/30 p-6 md:p-8"><div class="absolute -right-16 -bottom-16 w-64 h-64 bg-primary-container/20 rounded-full blur-3xl pointer-events-none"></div><div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center"><div class="lg:col-span-7 space-y-4"><div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-surface-container-lowest/15 border border-white/20 text-xs font-semibold backdrop-blur-sm"><span class="w-2 h-2 rounded-full bg-civic-amber animate-pulse"></span><span class="">Layanan Siaga 24/7 • Tim Reaksi Cepat (TRC)</span></div><h2 class="text-2xl md:text-3xl font-bold tracking-tight font-headline-xl text-white">Layanan Pengaduan &amp; Bantuan Cepat 24 Jam</h2><p class="text-sm md:text-base text-surface-container-low/90 leading-relaxed font-body-md">Mengalami gangguan distribusi air, pipa bocor, atau kendala meteran? Laporkan segera ke posko pengaduan resmi PERUMDA Air Minum Tirta Kepri. Tim teknis siap menindaklanjuti secara cepat dan terkoordinasi.</p><div class="flex flex-wrap items-center gap-3 pt-2"><a href="https://wa.me/6281270008888" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-status-success text-white font-semibold text-sm shadow hover:opacity-95 transition-all"><span class="material-symbols-outlined text-[18px]">chat</span><span class="">Kirim Laporan via WhatsApp</span></a><a href="tel:077121574" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white border border-white/25 font-semibold text-sm transition-all"><span class="material-symbols-outlined text-[18px]">call</span><span class="">Hotline: (0771) 21574</span></a></div></div><div class="lg:col-span-5 bg-white/10 backdrop-blur-md rounded-xl p-5 border border-white/15 space-y-3.5"><div class="text-xs font-bold uppercase tracking-wider text-surface-container-high">Kanal Kontak Resmi Pengaduan</div><div class="space-y-3"><div class="flex items-start gap-3"><span class="material-symbols-outlined text-civic-amber text-[20px] shrink-0 mt-0.5">headset_mic</span><div><div class="text-xs text-surface-container-low/80">Call Center / Hotline</div><div class="text-sm font-bold text-white">(0771) 21574 / 0811-778-21574</div></div></div><div class="flex items-start gap-3"><span class="material-symbols-outlined text-civic-amber text-[20px] shrink-0 mt-0.5">forum</span><div><div class="text-xs text-surface-container-low/80">WhatsApp Pengaduan Cepat</div><div class="text-sm font-bold text-white">0812-7000-8888</div><div class="text-[11px] text-surface-container-low/80">(Format: ID Pelanggan, Nama, Alamat, Foto &amp; Kendala)</div></div></div><div class="flex items-start gap-3"><span class="material-symbols-outlined text-civic-amber text-[20px] shrink-0 mt-0.5">mail</span><div><div class="text-xs text-surface-container-low/80">Email Laporan &amp; Pengaduan</div><div class="text-sm font-bold text-white">pengaduan@tirtakepri.co.id</div></div></div></div><div class="pt-2 border-t border-white/15 flex items-center justify-between text-xs text-surface-container-low/90"><span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px] text-status-success">verified</span> Posko Siaga 24 Jam</span><span class="text-[11px]">Wilayah Bintan &amp; Tanjungpinang</span></div></div></div></section>

  <!-- Pagination Modern & Simetris -->
  <nav class="bg-surface-container-lowest rounded-2xl p-4 md:p-5 shadow-sm border border-surface-border flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
    <p class="text-xs md:text-sm text-on-surface-variant">
      Menampilkan <strong class="text-on-surface font-semibold">1 - 6</strong> dari <strong class="text-on-surface font-semibold">48</strong> Berita
    </p>
    <div class="flex items-center gap-2">
      <button class="px-3.5 py-2 rounded-xl text-xs md:text-sm font-medium bg-surface-ice text-on-surface-variant hover:bg-surface-container transition-colors disabled:opacity-50 cursor-pointer flex items-center gap-1" disabled="">
        <span class="material-symbols-outlined text-[18px]">chevron_left</span>
        <span class="hidden sm:inline">Sebelumnya</span>
      </button>
      <div class="flex items-center gap-1.5">
        <button class="w-9 h-9 rounded-xl text-xs md:text-sm font-bold bg-primary text-on-primary shadow-sm flex items-center justify-center cursor-pointer">1</button>
        <button class="w-9 h-9 rounded-xl text-xs md:text-sm font-medium bg-surface-ice text-on-surface hover:bg-surface-container flex items-center justify-center transition-colors cursor-pointer">2</button>
        <button class="w-9 h-9 rounded-xl text-xs md:text-sm font-medium bg-surface-ice text-on-surface hover:bg-surface-container flex items-center justify-center transition-colors cursor-pointer">3</button>
        <span class="px-1.5 text-on-surface-variant font-bold text-xs">...</span>
        <button class="w-9 h-9 rounded-xl text-xs md:text-sm font-medium bg-surface-ice text-on-surface hover:bg-surface-container flex items-center justify-center transition-colors cursor-pointer">8</button>
      </div>
      <button class="px-3.5 py-2 rounded-xl text-xs md:text-sm font-medium bg-surface-ice text-on-surface-variant hover:bg-surface-container transition-colors cursor-pointer flex items-center gap-1">
        <span class="hidden sm:inline">Selanjutnya</span>
        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
      </button>
    </div>
  </nav>
</div>
</div></main>

{{-- Footer --}}
@include('layouts.partials.footer')

</body></html>