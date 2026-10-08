@php
    // Mendukung data dari tabel pendaftaran maupun pelanggan
    $data = $pendaftaran ?? $pelanggan ?? null;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - {{ optional($data)->nomor_registrasi ?? optional($data)->nomorreg ?? 'Pendaftaran Baru' }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arial:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #000;
        }

        /* Pengaturan Cetak / Print A4 */
        @media print {
            body {
                background: white !important;
                padding: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .receipt-container {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
            }
            @page {
                size: A4;
                margin: 20mm 15mm 20mm 15mm;
            }
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-6 sm:py-10 px-4">

    <!-- Tombol Navigasi / Cetak (Tidak tercetak) -->
    <div class="max-w-[794px] mx-auto mb-6 flex flex-wrap items-center justify-between gap-3 no-print">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-slate-700 hover:text-slate-900 bg-white px-4 py-2 rounded-lg border border-slate-300 shadow-sm transition">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali ke Beranda
        </a>
        <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#006689] hover:bg-[#004c68] text-white text-sm font-bold rounded-lg shadow transition">
            <span class="material-symbols-outlined text-[20px]">print</span>
            Cetak / Simpan PDF
        </button>
    </div>

    <!-- Lembar Dokumen Kertas -->
    <div class="receipt-container max-w-[794px] mx-auto bg-white p-8 sm:p-14 shadow-lg border border-slate-200">
        
        <!-- Kop Surat -->
        <header class="flex items-center justify-between pb-3 relative">
            <!-- Logo Kiri: Logo Pemprov Kepri -->
            <div class="w-20 shrink-0 flex items-center justify-center">
                <img src="{{ asset('images/logo-kepri.png') }}" 
                     alt="Logo Pemprov Kepri" 
                     class="h-20 w-auto object-contain"
                     onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/4/4b/Lambang_Provinsi_Kepulauan_Riau.png'">
            </div>

            <!-- Teks Kop Surat -->
            <div class="text-center flex-1 px-4">
                <h1 class="text-lg sm:text-xl font-bold tracking-tight uppercase leading-tight">
                    PEMERINTAH PROVINSI KEPULAUAN RIAU
                </h1>
                <h2 class="text-xl sm:text-2xl font-bold uppercase tracking-tight leading-tight mt-0.5">
                    PERUMDA AIR MINUM TIRTA KEPRI
                </h2>
                <p class="text-xs sm:text-sm mt-1 leading-snug">
                    Jl. MT. Haryono No. 87 Telp.(0771) 21574, Email: perumda@tirtakepri.co.id - Tanjungpinang
                </p>
            </div>

            <!-- Logo Kanan: Logo Tirta Kepri -->
            <div class="w-20 shrink-0 flex items-center justify-center">
                <img src="{{ asset('images/logo-tirta-kepri.png') }}" 
                     alt="Logo Tirta Kepri" 
                     class="h-20 w-auto object-contain"
                     onerror="this.src='https://via.placeholder.com/80x80?text=TIRTA+KEPRI'">
            </div>
        </header>

        <!-- Garis Kop Surat Ganda (Tebal & Tipis) -->
        <div class="border-t-2 border-black mt-2 mb-8"></div>

        <!-- Judul Dokumen & Nomor Registrasi -->
        <div class="text-center my-6">
            <h3 class="text-base sm:text-lg font-bold underline tracking-wide uppercase">
                BUKTI PENDAFTARAN &amp; DAFTAR TUNGGU LANGGANAN BARU
            </h3>
            <p class="text-sm font-bold mt-1">
                No. {{ $data->nomor_registrasi ?? $data->nomorreg ?? '0001/REG/1/' . Carbon\Carbon::parse($data->created_at ?? $data->tgldaftar ?? now())->format('m/Y') }}
            </p>
        </div>

        <!-- Tabel / Baris Informasi Data Pelanggan -->
        <div class="my-10 text-sm sm:text-base leading-relaxed">
            <table class="w-full border-collapse">
                <tbody>
                    <tr class="align-top">
                        <td class="w-64 py-2 font-normal">Nama Sesuai KTP</td>
                        <td class="w-6 py-2 text-center">:</td>
                        <td class="py-2 font-bold uppercase">{{ $data->nama_lengkap ?? $data->nama ?? '-' }}</td>
                    </tr>
                    <tr class="align-top">
                        <td class="py-2 font-normal">Alamat Lokasi yang akan dipasang</td>
                        <td class="py-2 text-center">:</td>
                        <td class="py-2 uppercase">
                            {{ $data->alamat_pasang ?? $data->alamat ?? '-' }}
                            @if(!empty($data->rt) || !empty($data->rw))
                                , RT: {{ $data->rt ?? '-' }}, RW: {{ $data->rw ?? '-' }}
                            @endif
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td class="py-2 font-normal">Tanggal Pendaftaran</td>
                        <td class="py-2 text-center">:</td>
                        <td class="py-2">
                            {{ isset($data->created_at) ? \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') : (isset($data->tgldaftar) ? \Carbon\Carbon::parse($data->tgldaftar)->format('d/m/Y') : date('d/m/Y')) }}
                        </td>
                    </tr>
                    <tr class="align-top">
                        <td class="py-2 font-normal">Nomor HP / Telp</td>
                        <td class="py-2 text-center">:</td>
                        <td class="py-2">
                            {{ !empty($data->telepon) ? $data->telepon : (!empty($data->telp) ? $data->telp : '-') }} / {{ $data->no_hp ?? $data->nomor_telepon ?? $data->hp ?? '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Kolom Tanda Tangan Petugas -->
        <div class="mt-20 flex justify-end">
            <div class="w-64 text-center text-sm sm:text-base">
                <p class="mb-2">
                    Tanjungpinang, {{ isset($data->created_at) ? \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y') : (isset($data->tgldaftar) ? \Carbon\Carbon::parse($data->tgldaftar)->translatedFormat('d F Y') : \Carbon\Carbon::now()->translatedFormat('d F Y')) }}
                </p>
                <p class="font-normal mb-20">
                    Ttd Petugas
                </p>
                <div>
                    <span class="inline-block border-b border-black w-48">&nbsp;</span>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
