@php
    $src = $data ?? $pendaftaran ?? $pelanggan ?? null;
    $no_reg = !empty($src->registration_number) ? $src->registration_number : (!empty($src->nomor_registrasi) ? $src->nomor_registrasi : (!empty($src->nomorreg) ? $src->nomorreg : '-'));
    $nama = !empty($src->full_name) ? $src->full_name : (!empty($src->nama_lengkap) ? $src->nama_lengkap : (!empty($src->nama) ? $src->nama : '-'));
    $alamat = !empty($src->installation_address) ? $src->installation_address : (!empty($src->alamat_pasang) ? $src->alamat_pasang : (!empty($src->alamat) ? $src->alamat : '-'));
    $rt = $src->rt ?? null;
    $rw = $src->rw ?? null;
    $tanggal_daftar = $src->created_at ?? $src->tgldaftar ?? null;
    $no_hp = !empty($src->phone_number) ? $src->phone_number : (!empty($src->no_hp) ? $src->no_hp : (!empty($src->hp) ? $src->hp : (!empty($src->telepon) ? $src->telepon : (!empty($src->telp) ? $src->telp : '-'))));
    $registration = $src;

    $formattedDate = '01/10/2026';
    $signatureDate = '01 Oktober 2026';
    if (!empty($tanggal_daftar)) {
        try {
            $carbonDate = \Carbon\Carbon::parse($tanggal_daftar);
            $formattedDate = $carbonDate->format('d/m/Y');
            $signatureDate = $carbonDate->locale('id')->translatedFormat('d F Y');
        } catch (\Exception $e) {
            $formattedDate = (string) $tanggal_daftar;
            $signatureDate = (string) $tanggal_daftar;
        }
    }

    // Format nama file untuk download/cetak PDF: "No. Reg - Nama"
    // Ganti karakter terlarang nama file seperti / dan \ menjadi -
    $safeNoReg = trim(str_replace(['/', '\\'], '-', $no_reg ?? ''));
    $safeNama = trim(preg_replace('/[\/\\\\:*?"<>|]/', '', $nama ?? ''));
    $dispReg = ($safeNoReg !== '-' && $safeNoReg !== '') ? $safeNoReg : '';
    $dispNama = ($safeNama !== '-' && $safeNama !== '') ? $safeNama : '';

    if ($dispReg && $dispNama) {
        $downloadTitle = "{$dispReg} - {$dispNama}";
    } elseif ($dispReg) {
        $downloadTitle = $dispReg;
    } elseif ($dispNama) {
        $downloadTitle = $dispNama;
    } else {
        $downloadTitle = 'Resi Pendaftaran';
    }
@endphp

@extends(auth()->check() ? 'layouts.admin' : 'layouts.blank')

@section('title', $downloadTitle)
@section('full_title', $downloadTitle)

@section('content')
<style>
  /* Base Wrapper */
  .receipt-wrapper {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 650px;
    margin: 0 auto;
    padding: 0 16px;
    box-sizing: border-box;
  }

  @media (min-width: 640px) {
    .receipt-wrapper {
      padding: 0;
    }
  }

  /* Card Pratinjau di Layar (Sesuai Card Sebelumnya, Tidak Penuh Meniru Kertas) */
  .receipt-card {
    background: #ffffff;
    width: 100%;
    max-width: 650px;
    margin: 0 auto;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    padding: 32px;
    border: 1px solid #e2e8f0;
    position: relative;
    color: #000;
    box-sizing: border-box;
  }

  @media (max-width: 639px) {
    .receipt-card {
      padding: 24px 16px;
      border-radius: 10px;
    }
  }

  .receipt-card * {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  /* KOP SURAT (HEADER) */
  .receipt-card .header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    border-bottom: 2px solid #000000;
    padding-bottom: 12px;
  }

  @media (min-width: 640px) {
    .receipt-card .header {
      gap: 16px;
      padding-bottom: 16px;
    }
  }

  .receipt-card .logo-box {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  @media (min-width: 640px) {
    .receipt-card .logo-box {
      width: 60px;
      height: 60px;
    }
  }

  .receipt-card .logo-box img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
  }

  .receipt-card .header-text {
    text-align: center;
    flex: 1;
    min-width: 0;
  }

  .receipt-card .header-text h3 {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.3px;
    color: #000000;
    margin: 0;
    line-height: 1.25;
  }

  .receipt-card .header-text h2 {
    font-size: 12px;
    font-weight: 800;
    color: #000000;
    margin: 2px 0;
    line-height: 1.25;
  }

  .receipt-card .header-text p {
    font-size: 9.5px;
    color: #1a1a1a;
    line-height: 1.35;
    margin: 0;
  }

  @media (min-width: 640px) {
    .receipt-card .header-text h3 {
      font-size: 14px;
      letter-spacing: 0.5px;
    }
    .receipt-card .header-text h2 {
      font-size: 15px;
    }
    .receipt-card .header-text p {
      font-size: 11px;
      line-height: 1.4;
    }
  }

  /* TITLE SECTION */
  .receipt-card .title-section {
    text-align: center;
    margin: 16px 0 16px;
  }

  @media (min-width: 640px) {
    .receipt-card .title-section {
      margin: 24px 0 22px;
    }
  }

  .receipt-card .title-section h1 {
    font-size: 13px;
    font-weight: 800;
    text-decoration: underline;
    text-underline-offset: 3px;
    color: #000000;
    letter-spacing: 0.2px;
    margin: 0;
    line-height: 1.35;
  }

  @media (min-width: 640px) {
    .receipt-card .title-section h1 {
      font-size: 15px;
    }
  }

  .receipt-card .title-section .doc-no {
    font-size: 12px;
    font-weight: 700;
    color: #1e293b;
    margin-top: 4px;
    word-break: break-all;
  }

  @media (min-width: 640px) {
    .receipt-card .title-section .doc-no {
      font-size: 13px;
    }
  }

  /* INFO LIST */
  .receipt-card .info-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 30px;
  }

  .receipt-card .info-row {
    display: grid;
    grid-template-columns: 140px 12px 1fr;
    align-items: baseline;
    padding: 0;
    background: transparent;
    border: none;
    gap: 0;
  }

  @media (max-width: 480px) {
    .receipt-card .info-row {
      grid-template-columns: 125px 10px 1fr;
    }
    .receipt-card .info-row .info-label,
    .receipt-card .info-row .info-value {
      font-size: 12px;
    }
    .receipt-card .header-text h3 {
      font-size: 10px;
    }
    .receipt-card .header-text h2 {
      font-size: 11px;
    }
    .receipt-card .header-text p {
      font-size: 8.5px;
    }
  }

  @media (min-width: 640px) {
    .receipt-card .info-list {
      gap: 14px;
      margin-bottom: 35px;
    }

    .receipt-card .info-row {
      grid-template-columns: 210px 15px 1fr;
    }
  }

  .receipt-card .info-row .info-label {
    font-size: 13.5px;
    font-weight: 600;
    text-transform: none;
    letter-spacing: normal;
    color: #000000;
  }

  .receipt-card .info-row .info-colon {
    display: block;
    font-weight: bold;
    text-align: center;
    color: #000000;
  }

  .receipt-card .info-row .info-value {
    font-size: 13.5px;
    font-weight: 600;
    color: #000000;
    word-break: break-word;
    line-height: 1.4;
  }

  /* SIGNATURE SECTION */
  .receipt-card .signature-section {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    padding-right: 0;
  }

  @media (min-width: 640px) {
    .receipt-card .signature-section {
      justify-content: flex-end;
      padding-right: 15px;
    }
  }

  .receipt-card .signature-box {
    text-align: center;
    width: 220px;
    max-width: 100%;
  }

  .receipt-card .signature-date {
    font-size: 12px;
    color: #000000;
    margin-bottom: 4px;
  }

  @media (min-width: 640px) {
    .receipt-card .signature-date {
      font-size: 13px;
    }
  }

  .receipt-card .signature-title {
    font-size: 12px;
    font-weight: 600;
    color: #000000;
    margin-bottom: 6px;
  }

  @media (min-width: 640px) {
    .receipt-card .signature-title {
      font-size: 13px;
    }
  }

  .receipt-card .barcode-container {
    display: flex;
    justify-content: center;
    margin-top: 4px;
  }

  .receipt-card .signature-line {
    font-size: 11px;
    font-weight: 600;
    color: #333333;
    margin-top: 8px;
  }

  /* CETAK (PRINT) - MARGIN KERTAS RESMI: ATAS 3CM, KIRI 4CM, KANAN 3CM, BAWAH 3CM */
  @media print {
    @page {
      size: A4 portrait;
      margin-top: 20mm;    /* Atas 2 cm */
      margin-right: 20mm;  /* Kanan 2 cm */
      margin-bottom: 20mm; /* Bawah 2 cm */
      margin-left: 20mm;   /* Kiri 2 cm */
    }
    html, body {
      background: #ffffff !important;
      padding: 0 !important;
      margin: 0 !important;
      width: 100% !important;
      height: auto !important;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }
    aside, 
    header.lg\:hidden,
    .lg\:hidden, 
    #mobile-sidebar-overlay,
    .action-buttons, 
    .public-action-buttons,
    .status-alert-banner,
    .pb-10 {
      display: none !important;
    }
    main {
      padding: 0 !important;
      margin: 0 !important;
      width: 100% !important;
      max-width: 100% !important;
    }
    .receipt-wrapper {
      padding: 0 !important;
      margin: 0 !important;
      width: 100% !important;
      max-width: 100% !important;
    }
    .receipt-card {
      box-shadow: none !important;
      border: none !important;
      border-radius: 0 !important;
      width: 100% !important;
      max-width: 100% !important;
      min-height: auto !important;
      padding: 0 !important; /* Margin resmi 3cm/4cm/3cm/3cm sudah ditangani oleh @page */
      margin: 0 !important;
      box-sizing: border-box !important;
    }
    .receipt-card .header {
      gap: 16px !important;
      border-bottom: 2px solid #000000 !important;
      padding-bottom: 16px !important;
    }
    .receipt-card .logo-box {
      width: 60px !important;
      height: 60px !important;
    }
    .receipt-card .header-text h3 {
      font-size: 14px !important;
      line-height: 1.3 !important;
    }
    .receipt-card .header-text h2 {
      font-size: 15px !important;
      line-height: 1.3 !important;
    }
    .receipt-card .header-text p {
      font-size: 11px !important;
      line-height: 1.4 !important;
    }
    .receipt-card .title-section {
      margin: 24px 0 20px !important;
    }
    .receipt-card .title-section h1 {
      font-size: 15px !important;
    }
    .receipt-card .title-section .doc-no {
      font-size: 13px !important;
    }
    .receipt-card .info-list {
      gap: 14px !important;
      margin-bottom: 35px !important;
    }
    .receipt-card .info-row {
      display: grid !important;
      grid-template-columns: 210px 15px 1fr !important;
      align-items: baseline !important;
      padding: 0 !important;
      background: transparent !important;
      border: none !important;
      border-radius: 0 !important;
    }
    .receipt-card .info-row .info-label {
      font-size: 13.5px !important;
      font-weight: 600 !important;
      text-transform: none !important;
      letter-spacing: normal !important;
      color: #000000 !important;
    }
    .receipt-card .info-row .info-colon {
      display: block !important;
      font-weight: bold !important;
      color: #000000 !important;
    }
    .receipt-card .info-row .info-value {
      font-size: 13.5px !important;
      font-weight: 600 !important;
      color: #000000 !important;
    }
    .receipt-card .signature-section {
      justify-content: flex-end !important;
      padding-right: 15px !important;
      margin-top: 25px !important;
    }
    .receipt-card .signature-box {
      width: 220px !important;
    }
    .receipt-card .signature-date {
      font-size: 13px !important;
    }
    .receipt-card .signature-title {
      font-size: 13px !important;
    }
  }
</style>

<div class="receipt-wrapper">
  <!-- Header Banner Khusus ADMIN -->
  @if(auth()->check() || request()->routeIs('admin.*'))
  <div class="action-buttons w-full max-w-[650px] mx-auto bg-primary text-white rounded-2xl p-4 sm:p-5 shadow-md mb-6">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
      <div>
        <h1 class="text-lg sm:text-xl font-bold tracking-tight">Pratinjau Resi Pendaftaran</h1>
        <p class="text-white/80 text-xs mt-0.5">
          No. Registrasi: <span class="font-semibold text-white">{{ $no_reg ?? '-' }}</span>
        </p>
      </div>
      <div class="grid grid-cols-3 sm:flex sm:items-center gap-2 w-full sm:w-auto shrink-0 pt-3 sm:pt-0 border-t border-white/15 sm:border-0 mt-1 sm:mt-0">
        <button type="button" onclick="kembali()" class="h-10 px-3 sm:px-4 bg-white/15 hover:bg-white/25 active:scale-[0.98] text-white rounded-xl text-xs sm:text-sm font-semibold transition inline-flex items-center justify-center gap-1.5 cursor-pointer border border-white/25 whitespace-nowrap">
          <span class="material-symbols-outlined text-[18px]">arrow_back</span>
          <span>Kembali</span>
        </button>
        <button type="button" onclick="unduhResi()" class="h-10 px-3 sm:px-4 bg-white text-primary hover:bg-slate-100 active:scale-[0.98] rounded-xl text-xs sm:text-sm font-bold shadow-sm transition inline-flex items-center justify-center gap-1.5 cursor-pointer border border-white whitespace-nowrap">
          <span class="material-symbols-outlined text-[18px]">download</span>
          <span>Unduh</span>
        </button>
        <button type="button" onclick="cetakResi()" class="h-10 px-3 sm:px-4 bg-cyan-500 hover:bg-cyan-400 active:scale-[0.98] text-white rounded-xl text-xs sm:text-sm font-bold shadow-sm transition inline-flex items-center justify-center gap-1.5 cursor-pointer border border-cyan-400/30 whitespace-nowrap">
          <span class="material-symbols-outlined text-[18px]">print</span>
          <span>Cetak</span>
        </button>
      </div>
    </div>
  </div>
  @else
  <!-- Header Banner Khusus PELANGGAN -->
  <div class="status-alert-banner w-full max-w-[650px] mx-auto mb-6 bg-primary text-white rounded-2xl p-4 sm:p-5 shadow-md">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-xl bg-white/20 text-white flex items-center justify-center shrink-0">
          <span class="material-symbols-outlined text-[24px]">check_circle</span>
        </div>
        <div>
          <h2 class="font-bold text-sm sm:text-base text-white leading-tight">
            @if(isset($is_preview) && $is_preview)
              Bukti Pendaftaran Pasang Baru
            @else
              Pendaftaran Berhasil Dikirim!
            @endif
          </h2>
          <p class="text-white/80 text-xs mt-0.5">
            No. Registrasi: <span class="font-semibold text-white">{{ $no_reg ?? '-' }}</span>
          </p>
        </div>
      </div>
      <div class="grid grid-cols-2 sm:flex sm:items-center gap-2 w-full sm:w-auto shrink-0 pt-3 sm:pt-0 border-t border-white/15 sm:border-0 mt-1 sm:mt-0">
        <!-- Unduh Button -->
        <button type="button" onclick="unduhResi()" class="col-span-1 sm:w-auto h-10 px-3.5 sm:px-4 bg-white text-primary hover:bg-slate-100 active:scale-[0.98] rounded-xl text-xs sm:text-sm font-bold shadow-sm transition inline-flex items-center justify-center gap-1.5 cursor-pointer border border-white whitespace-nowrap">
          <span class="material-symbols-outlined text-[18px]">download</span>
          <span>Unduh</span>
        </button>

        <!-- Cetak Button -->
        <button type="button" onclick="cetakResi()" class="col-span-1 sm:w-auto h-10 px-3.5 sm:px-4 bg-cyan-500 hover:bg-cyan-400 active:scale-[0.98] text-white rounded-xl text-xs sm:text-sm font-bold shadow-sm transition inline-flex items-center justify-center gap-1.5 cursor-pointer border border-cyan-400/30 whitespace-nowrap">
          <span class="material-symbols-outlined text-[18px]">print</span>
          <span>Cetak</span>
        </button>

        <!-- Selesaikan Button -->
        <a href="{{ url('/') }}" class="col-span-2 sm:col-auto sm:w-auto h-10 px-4 bg-emerald-500 hover:bg-emerald-600 active:scale-[0.98] text-white rounded-xl text-xs sm:text-sm font-bold shadow-sm transition inline-flex items-center justify-center gap-1.5 border border-emerald-400/30 whitespace-nowrap">
          <span class="material-symbols-outlined text-[18px]">check_circle</span>
          <span>Selesaikan</span>
        </a>
      </div>
    </div>
  </div>
  @endif

  <!-- Kertas Resi Fisik -->
  <div class="receipt-card">
    <header class="header">
      <div class="logo-box">
        <img src="{{ asset('img/logokepri.png') }}" alt="Logo Kepri" onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/4/4b/Lambang_Provinsi_Kepulauan_Riau.png';">
      </div>
      <div class="header-text">
        <h3>PEMERINTAH PROVINSI KEPULAUAN RIAU</h3>
        <h2>PERUMDA AIR MINUM TIRTA KEPRI</h2>
        <p>Jl. MT. Haryono No. 87 Telp.(0771) 21574, Email. perumda@tirtakepri.co.id - Tanjungpinang</p>
      </div>
      <div class="logo-box">
        <img src="{{ asset('img/logo tirta.png') }}" alt="Logo Tirta Kepri" onerror="this.onerror=null; this.src='https://via.placeholder.com/80x80?text=TIRTA+KEPRI';">
      </div>
    </header>

    <div class="title-section">
      <h1>BUKTI PENDAFTARAN &amp; DAFTAR TUNGGU LANGGANAN BARU</h1>
      <div class="doc-no">No. {{ $no_reg ?? '0001/REG/1/X/2026' }}</div>
    </div>

    <div class="info-list">
      <div class="info-row">
        <div class="info-label">Nama Sesuai KTP</div>
        <div class="info-colon">:</div>
        <div class="info-value">{{ strtoupper($nama) }}</div>
      </div>

      <div class="info-row">
        <div class="info-label">Alamat Lokasi yang akan dipasang</div>
        <div class="info-colon">:</div>
        <div class="info-value">
          {{ strtoupper($alamat) }}
          @if(!empty($rt) || !empty($rw))
            , RT: {{ $rt ?: '-' }} RW: {{ $rw ?: '-' }}
          @endif
        </div>
      </div>

      <div class="info-row">
        <div class="info-label">Tanggal Pendaftaran</div>
        <div class="info-colon">:</div>
        <div class="info-value">{{ $formattedDate }}</div>
      </div>

      <div class="info-row">
        <div class="info-label">Nomor HP / Telp</div>
        <div class="info-colon">:</div>
        <div class="info-value">{{ $no_hp }}</div>
      </div>
    </div>

    <div class="signature-section">
      <div class="signature-box">
        <div class="signature-date">
          {{ $kota ?? 'Tanjungpinang' }}, {{ $signatureDate }}
        </div>
        <div class="signature-title">Petugas</div>
        <div class="barcode-container" id="qrcode-resi"></div>
        <div class="signature-line">
          Pelayanan Perumda Tirta Kepri
        </div>
      </div>
    </div>
  </div>

  <div class="pb-10"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
  const downloadFileName = @json($downloadTitle);

  // Set document.title agar saat cetak / print dialog nama filenya sesuai format "No. Reg - Nama"
  document.title = downloadFileName;

  window.addEventListener('beforeprint', function() {
    document.title = downloadFileName;
  });

  function kembali() {
    if (window.history.length > 1) {
      window.history.back();
    } else {
      window.location.href = "{{ route('admin.pelanggan.index') }}";
    }
  }

  function unduhResi() {
    document.title = downloadFileName;
    const btn = event?.currentTarget || document.querySelector('button[onclick*="unduhResi"]');
    let origHtml = '';
    if (btn) {
      origHtml = btn.innerHTML;
      btn.innerHTML = '<span class="material-symbols-outlined text-[18px] animate-spin">sync</span> Mengunduh...';
      btn.disabled = true;
    }

    if (typeof html2pdf !== 'undefined') {
      const element = document.querySelector('.receipt-card');
      const origBoxShadow = element.style.boxShadow;
      const origBorder = element.style.border;
      const origBorderRadius = element.style.borderRadius;
      const origPadding = element.style.padding;
      const origWidth = element.style.width;
      const origMaxWidth = element.style.maxWidth;

      // Bersihkan style kartu layar & samakan lebar dengan area cetak A4 (210mm - 40mm kiri - 30mm kanan = 140mm)
      element.style.boxShadow = 'none';
      element.style.border = 'none';
      element.style.borderRadius = '0';
      element.style.padding = '0';
      element.style.width = '140mm';
      element.style.maxWidth = '140mm';

      const opt = {
        margin:       [30, 40, 30, 30], // [atas 3cm, kiri 4cm, bawah 3cm, kanan 3cm]
        filename:     downloadFileName + '.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2, useCORS: true, logging: false },
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
      };

      html2pdf().set(opt).from(element).save().then(function() {
        element.style.boxShadow = origBoxShadow;
        element.style.border = origBorder;
        element.style.borderRadius = origBorderRadius;
        element.style.padding = origPadding;
        element.style.width = origWidth;
        element.style.maxWidth = origMaxWidth;
        if (btn) {
          btn.innerHTML = origHtml;
          btn.disabled = false;
        }
      }).catch(function(err) {
        element.style.boxShadow = origBoxShadow;
        element.style.border = origBorder;
        element.style.borderRadius = origBorderRadius;
        element.style.padding = origPadding;
        element.style.width = origWidth;
        element.style.maxWidth = origMaxWidth;
        console.warn('html2pdf fallback to window.print():', err);
        if (btn) {
          btn.innerHTML = origHtml;
          btn.disabled = false;
        }
        window.print();
      });
    } else {
      if (btn) {
        btn.innerHTML = origHtml;
        btn.disabled = false;
      }
      window.print();
    }
  }

  function cetakResi() {
    document.title = downloadFileName;
    window.print();
  }

  document.addEventListener("DOMContentLoaded", function() {
    document.title = downloadFileName;
    var qrContainer = document.getElementById("qrcode-resi");
    if (qrContainer && typeof QRCode !== "undefined") {
      new QRCode(qrContainer, {
        text: "{{ $no_reg ?? '0001/REG/1/X/2026' }}",
        width: 75,
        height: 75,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.M
      });
    }

    @if(!empty($auto_print))
      // Otomatis unduh saat halaman resi pertama kali terbuka setelah pendaftaran
      setTimeout(function() {
        unduhResi();
      }, 700);
    @endif
  });
</script>
@endsection
