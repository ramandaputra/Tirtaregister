@php
    $src = $data ?? $pendaftaran ?? $pelanggan ?? null;
    $no_reg = $src->registration_number ?? $src->nomor_registrasi ?? $src->nomorreg ?? null;
    $nama = $src->full_name ?? $src->nama_lengkap ?? $src->nama ?? null;
    $alamat = $src->installation_address ?? $src->alamat_pasang ?? $src->alamat ?? null;
    $rt = $src->rt ?? null;
    $rw = $src->rw ?? null;
    $tanggal_daftar = $src->created_at ?? $src->tgldaftar ?? null;
    $no_hp = $src->phone_number ?? $src->telepon ?? $src->telp ?? $src->no_hp ?? $src->hp ?? null;
    $registration = $src; // Prevent undefined variable error
@endphp

@extends(auth()->check() ? 'layouts.admin' : 'layouts.blank')

@section('title', 'Preview Resi Pendaftaran')

@section('content')
<style>
  .receipt-wrapper {
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 72rem; /* Sama dengan max-w-6xl */
    margin: 0 auto;
  }

  .receipt-card {
    background: #ffffff;
    max-width: 650px;
    margin: 0 auto;
    width: 100%;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    padding: 32px;
    border: 1px solid #e2e8f0;
    position: relative;
    color: #000;
  }

  .receipt-card * {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .receipt-card .header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    border-bottom: 2px solid #000000;
    padding-bottom: 16px;
  }

  .receipt-card .logo-box {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .receipt-card .logo-box img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
  }

  .receipt-card .header-text {
    text-align: center;
    flex-grow: 1;
  }

  .receipt-card .header-text h3 {
    font-size: 15px;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: #000000;
    margin: 0;
  }

  .receipt-card .header-text h2 {
    font-size: 15px;
    font-weight: 700;
    color: #000000;
    margin: 2px 0;
  }

  .receipt-card .header-text p {
    font-size: 11px;
    color: #000000;
    line-height: 1.4;
    margin: 0;
  }

  .receipt-card .title-section {
    text-align: center;
    margin: 24px 0 20px;
  }

  .receipt-card .title-section h1 {
    font-size: 15px;
    font-weight: 800;
    text-decoration: underline;
    color: #000000;
    letter-spacing: 0.3px;
    margin: 0;
  }

  .receipt-card .title-section .doc-no {
    font-size: 13px;
    font-weight: 700;
    color: #000000;
    margin-top: 4px;
  }

  .receipt-card .info-list {
    display: grid;
    grid-template-columns: 210px 15px 1fr;
    row-gap: 14px;
    font-size: 13.5px;
    color: #000000;
    margin-bottom: 35px;
  }

  .receipt-card .info-label {
    font-weight: 600;
    color: #000000;
  }

  .receipt-card .info-colon {
    font-weight: bold;
    text-align: center;
  }

  .receipt-card .info-value {
    font-weight: 600;
    color: #000000;
    word-break: break-word;
  }

  .receipt-card .signature-section {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
    padding-right: 20px;
  }

  .receipt-card .signature-box {
    text-align: center;
    width: 220px;
  }

  .receipt-card .signature-date {
    font-size: 13px;
    color: #000000;
    margin-bottom: 4px;
  }

  .receipt-card .signature-title {
    font-size: 13px;
    font-weight: 600;
    color: #000000;
    margin-bottom: 8px;
  }

  .receipt-card .barcode-container {
    display: flex;
    justify-content: center;
    margin-top: 4px;
  }

  @media (max-width: 540px) {
    .receipt-card {
      padding: 20px;
    }
    .receipt-card .info-list {
      grid-template-columns: 1fr;
      row-gap: 6px;
    }
    .receipt-card .info-colon {
      display: none;
    }
    .receipt-card .info-value {
      margin-bottom: 10px;
    }
  }

  /* Cetak (Print) Styling */
  @media print {
    @page {
      margin: 0; /* Menghilangkan margin bawaan browser */
    }
    body {
      background: #ffffff !important;
      -webkit-print-color-adjust: exact;
    }
    /* Sembunyikan elemen layout admin */
    aside, 
    .lg\:hidden, 
    #mobile-sidebar-overlay,
    .action-buttons, .public-action-buttons {
      display: none !important;
    }
    /* Hapus padding pada main container */
    main {
      padding: 0 !important;
      margin: 0 !important;
    }
    .receipt-wrapper {
      padding-top: 15mm; /* Sedikit jarak di atas kertas agar kop tidak terpotong printer */
      width: 100%;
      max-width: 100%;
    }
    .receipt-card {
      box-shadow: none !important;
      border: none !important;
      padding: 0 15mm !important; /* Jarak kiri kanan di kertas */
      max-width: 100% !important;
      width: 100% !important;
      margin: 0 !important;
    }
  }
</style>

<div class="receipt-wrapper">
  <!-- Tombol Navigasi & Print (Header Banner) KHUSUS ADMIN -->
  @if(auth()->check())
  <div class="action-buttons w-full max-w-[650px] mx-auto bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
    <div>
      <h1 class="text-2xl font-bold tracking-tight">Pratinjau Resi Pendaftaran</h1>
      <p class="text-white/80 text-sm mt-1">
        No. Registrasi: <span class="font-semibold">{{ $registration->no_reg ?? ($no_reg ?? '-') }}</span>
      </p>
    </div>
    <div class="flex items-center gap-3 shrink-0">
        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2">
          <span class="material-symbols-outlined text-[18px]">arrow_back</span>
          Kembali
        </a>
        <button onclick="window.print()" class="px-4 py-2 bg-white text-primary hover:bg-gray-100 rounded-xl text-sm font-bold shadow-sm transition flex items-center gap-2">
          <span class="material-symbols-outlined text-[18px]">print</span>
          Cetak / Simpan PDF
        </button>
    </div>
  </div>
  @endif

  <!-- Kertas Resi -->
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
      <div class="doc-no">No. {{ $registration->no_reg ?? ($no_reg ?? '0001/REG/1/X/2026') }}</div>
    </div>

    <div class="info-list">
      <div class="info-label">Nama Sesuai KTP</div>
      <div class="info-colon">:</div>
      <div class="info-value">{{ strtoupper($registration->nama ?? ($nama ?? 'SABTU ARDIANSYAH')) }}</div>

      <div class="info-label">Alamat Lokasi yang akan dipasang</div>
      <div class="info-colon">:</div>
      <div class="info-value">
        {{ strtoupper($registration->alamat ?? ($alamat ?? 'JL. USMAN HARUN GG SELANGAT NO: 17')) }}
        @if(!empty($registration->rt) || !empty($registration->rw))
          , RT: {{ $registration->rt ?? '-' }} RW: {{ $registration->rw ?? '-' }}
        @elseif(!empty($rt) || !empty($rw))
          , RT: {{ $rt ?? '-' }} RW: {{ $rw ?? '-' }}
        @else
          , RT: RW:
        @endif
      </div>

      <div class="info-label">Tanggal Pendaftaran</div>
      <div class="info-colon">:</div>
      <div class="info-value">
        @if(isset($registration->created_at))
          {{ \Carbon\Carbon::parse($registration->created_at)->format('d/m/Y') }}
        @elseif(isset($tanggal_daftar))
          {{ \Carbon\Carbon::parse($tanggal_daftar)->format('d/m/Y') }}
        @else
          01/10/2026
        @endif
      </div>

      <div class="info-label">Nomor HP / Telp</div>
      <div class="info-colon">:</div>
      <div class="info-value">{{ $registration->no_hp ?? ($no_hp ?? '- / 0852-6400-3574') }}</div>
    </div>

    <div class="signature-section">
      <div class="signature-box">
        <div class="signature-date">
          {{ $kota ?? 'Tanjungpinang' }}, 
          @if(isset($registration->created_at))
            {{ \Carbon\Carbon::parse($registration->created_at)->locale('id')->translatedFormat('d F Y') }}
          @elseif(isset($tanggal_daftar))
            {{ \Carbon\Carbon::parse($tanggal_daftar)->locale('id')->translatedFormat('d F Y') }}
          @else
            01 Oktober 2026
          @endif
        </div>
        <div class="signature-title">Petugas</div>
        <div class="barcode-container" id="qrcode-resi" style="display: flex; justify-content: center; margin-top: 8px; margin-bottom: 4px;">
          <!-- QR Code akan di-generate di sini -->
        </div>
        <div class="signature-line" style="font-size: 11px; font-weight: 600; color: #333; margin-top: 10px;">
          Pelayanan Perumda Tirta Kepri
        </div>
      </div>
    </div>
  </div>
</div>

  @if(!auth()->check())
  <!-- Tombol Publik di Bawah Resi -->
  <div class="public-action-buttons w-full max-w-[650px] mx-auto mt-10 flex justify-center pb-12">
    <button onclick="selesaikanPendaftaran()" class="px-8 py-4 bg-primary hover:bg-[#004e69] text-white rounded-2xl text-lg font-bold shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 flex items-center gap-3 border border-white/20">
      <span class="material-symbols-outlined text-[28px]">print</span>
      Selesaikan & Unduh Resi
    </button>
  </div>
  @endif

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Generate QR Code (Barcode Kotak/Petak)
    new QRCode(document.getElementById("qrcode-resi"), {
      text: "{{ $registration->no_reg ?? ($no_reg ?? '0001/REG/1/X/2026') }}",
      width: 75,
      height: 75,
      colorDark : "#000000",
      colorLight : "#ffffff",
      correctLevel : QRCode.CorrectLevel.M
    });
  });
</script>

<script>
    function selesaikanPendaftaran() {
        // 1. Otomatis download/print resi
        window.print();

        // 2. Setelah dialog print selesai/ditutup, kembalikan ke home
        window.onafterprint = function() {
            window.location.href = "{{ url('/') }}";
        };

        // Fallback jika browser tidak mendukung onafterprint dengan sempurna
        setTimeout(function() {
            window.location.href = "{{ url('/') }}";
        }, 2000); 
    }
</script>
@endsection