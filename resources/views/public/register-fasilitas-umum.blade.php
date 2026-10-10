<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pasang Baru - Sambungan Fasilitas Umum</title>

    <!-- Google Fonts & Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

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
        @layer base { html, body { margin: 0; padding: 0; } body { overscroll-behavior: none; } }
        ::-webkit-scrollbar { display: none; }
        .form-input, .form-select {
            width: 100%; padding: 0.875rem 1rem; border-radius: 0.75rem; border: 1px solid #D5E2E8; background-color: #F4F8FA;
            color: #081e2a; font-family: 'Inter', sans-serif; font-size: 0.875rem; transition: all 0.2s ease-in-out;
        }
        .form-input:focus, .form-select:focus {
            outline: none; border-color: #FFC10D; background-color: #ffffff; box-shadow: 0 0 0 3px rgba(255, 193, 13, 0.2);
        }
        .form-label { display: block; margin-bottom: 0.5rem; font-size: 0.875rem; font-weight: 600; color: #3e484f; font-family: 'Plus Jakarta Sans', sans-serif; }
        .section-title { font-size: 1.25rem; font-weight: 700; color: #b48500; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; border-bottom: 2px solid #fef3c7; padding-bottom: 0.75rem; }
        #map { height: 300px; border-radius: 0.75rem; border: 1px solid #D5E2E8; z-index: 10; }
    </style>
</head>
<body class="bg-surface-ice text-on-surface antialiased flex flex-col min-h-screen">

    @include('layouts.partials.navbar')

    <main class="flex-grow w-full pt-28 pb-20">
        <div class="max-w-4xl mx-auto px-6 w-full space-y-10">
            <header class="flex flex-col items-center text-center space-y-4 pt-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200 text-xs font-bold tracking-wider uppercase">
                    <span class="material-symbols-outlined text-[16px]">domain</span>
                    Sambungan Fasilitas Umum / Perusahaan
                </div>
                <h1 class="text-3xl md:text-4xl font-bold tracking-tight leading-tight">Formulir Pendaftaran Pasang Baru</h1>
                <p class="text-sm md:text-base text-gray-600 max-w-2xl">Lengkapi data penanggung jawab dan detail instansi dengan benar untuk keperluan administrasi.</p>
            </header>

            <div class="bg-white rounded-3xl p-5 sm:p-8 md:p-12 shadow-lg border border-surface-border relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-yellow-400 to-orange-400"></div>
                
                @if(session('success'))
                <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-xl flex gap-3 items-start">
                    <span class="material-symbols-outlined text-green-600">check_circle</span>
                    <div><h4 class="font-bold text-green-700">Berhasil!</h4><p class="text-sm text-green-600 mt-1">{{ session('success') }}</p></div>
                </div>
                @endif
                
                @if($errors->any())
                <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-xl flex gap-3 items-start">
                    <span class="material-symbols-outlined text-red-600">error</span>
                    <div>
                        <h4 class="font-bold text-red-700">Terdapat Kesalahan:</h4>
                        <ul class="text-sm text-red-600 mt-1 list-disc list-inside">
                            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <form action="{{ route('public.register.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf
                    <input type="hidden" name="connection_type" value="Fasilitas Umum">
                    
                    <!-- Bagian A: Data Penanggung Jawab -->
                    <div>
                        <h2 class="section-title"><span class="material-symbols-outlined">badge</span> A. Data Penanggung Jawab</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-1 md:col-span-2">
                                <label class="form-label">Nama Penanggung Jawab (Sesuai KTP) <span class="text-red-500">*</span></label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" required class="form-input">
                            </div>
                            
                            <div>
                                <label class="form-label">No. KTP <span class="text-red-500">*</span></label>
                                <input type="number" name="nik" value="{{ old('nik') }}" required class="form-input">
                            </div>
                            
                            <div>
                                <label class="form-label">Upload KTP <span class="text-red-500">*</span></label>
                                <input type="file" name="ktp_file" accept=".jpg,.jpeg,.png" required class="form-input bg-white p-2 text-sm">
                            </div>
                            
                            <div>
                                <label class="form-label">No. KK <span class="text-red-500">*</span></label>
                                <input type="number" name="kk_number" value="{{ old('kk_number') }}" required class="form-input">
                            </div>
                            
                            <div>
                                <label class="form-label">Upload KK <span class="text-red-500">*</span></label>
                                <input type="file" name="kk_file" accept=".jpg,.jpeg,.png" required class="form-input bg-white p-2 text-sm">
                            </div>
                            
                            <div>
                                <label class="form-label">No. Handphone / WA <span class="text-red-500">*</span></label>
                                <input type="text" name="phone_number" value="{{ old('phone_number') }}" required class="form-input">
                            </div>
                            
                            <div>
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-input">
                            </div>
                            
                            <div class="col-span-1 md:col-span-2">
                                <label class="form-label">Pekerjaan/Jabatan <span class="text-red-500">*</span></label>
                                <select name="occupation_id" required class="form-select">
                                    <option value="">Pilih...</option>
                                    @foreach($occupations as $occ)
                                        <option value="{{ $occ->id }}" {{ old('occupation_id') == $occ->id ? 'selected' : '' }}>{{ $occ->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bagian B: Data Perusahaan/Instansi -->
                    <div>
                        <h2 class="section-title"><span class="material-symbols-outlined">corporate_fare</span> B. Data Perusahaan/Instansi</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-1 md:col-span-2">
                                <label class="form-label">Nama Perusahaan/Instansi <span class="text-red-500">*</span></label>
                                <input type="text" name="company_name" value="{{ old('company_name') }}" required class="form-input">
                            </div>
                            
                            <div>
                                <label class="form-label">Jenis Fasilitas <span class="text-red-500">*</span></label>
                                <select name="facility_type_id" required class="form-select">
                                    <option value="">Pilih Jenis...</option>
                                    @foreach($facilityTypes as $f)
                                        <option value="{{ $f->id }}" {{ old('facility_type_id') == $f->id ? 'selected' : '' }}>{{ $f->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="form-label">Kepemilikan Bangunan <span class="text-red-500">*</span></label>
                                <select name="ownership_id" required class="form-select">
                                    <option value="">Pilih...</option>
                                    @foreach($ownerships as $o)
                                        <option value="{{ $o->kepemilikanbangunan }}" {{ old('ownership_id') == $o->kepemilikanbangunan ? 'selected' : '' }}>{{ $o->kepemilikanbangunan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian C: Lokasi Pemasangan -->
                    <div>
                        <h2 class="section-title"><span class="material-symbols-outlined">location_on</span> C. Lokasi Pemasangan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-1 md:col-span-2">
                                <label class="form-label">Alamat Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="installation_address" required rows="2" class="form-input resize-none">{{ old('installation_address') }}</textarea>
                            </div>
                            
                            <div>
                                <label class="form-label">No. Rumah/Gedung <span class="text-red-500">*</span></label>
                                <input type="text" name="house_number" value="{{ old('house_number') }}" required class="form-input">
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label">RT <span class="text-red-500">*</span></label>
                                    <input type="text" name="rt" value="{{ old('rt') }}" required class="form-input" maxlength="3">
                                </div>
                                <div>
                                    <label class="form-label">RW <span class="text-red-500">*</span></label>
                                    <input type="text" name="rw" value="{{ old('rw') }}" required class="form-input" maxlength="3">
                                </div>
                            </div>
                            
                            <div>
                                <label class="form-label">Kelurahan <span class="text-red-500">*</span></label>
                                <select name="village_id" id="village_id" required class="form-select">
                                    <option value="">Pilih Kelurahan...</option>
                                    @foreach($villages as $v)
                                        <option value="{{ $v->kodekelurahan }}" data-kecamatan="{{ $v->kodekecamatan }}" {{ old('village_id') == $v->kodekelurahan ? 'selected' : '' }}>{{ $v->kelurahan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="form-label">Rayon (Area/Jalan) <span class="text-red-500">*</span></label>
                                <input type="text" name="rayon_id" id="rayon_id" value="{{ old('rayon_id') }}" required class="form-input" placeholder="Otomatis terisi dari map atau ketik manual...">
                            </div>
                            
                            <!-- Geolocation -->
                            <div class="col-span-1 md:col-span-2">
                                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-2 gap-3">
                                    <div>
                                        <label class="form-label mb-0">Pilih Lokasi di Map (Geolocation) <span class="text-red-500">*</span></label>
                                        <p class="text-xs text-gray-500 mt-1">Geser pin merah untuk menentukan koordinat lokasi secara presisi.</p>
                                    </div>
                                    <button type="button" id="btn-find-me" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-50 text-primary border border-blue-200 rounded-lg text-sm font-semibold hover:bg-blue-100 transition-colors w-full sm:w-auto justify-center">
                                        <span class="material-symbols-outlined text-[18px]">my_location</span>
                                        Temukan Lokasi Saya
                                    </button>
                                </div>
                                <div id="map"></div>
                                <div class="flex gap-4 mt-3">
                                    <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" readonly required placeholder="Latitude" class="form-input bg-gray-100 text-sm">
                                    <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" readonly required placeholder="Longitude" class="form-input bg-gray-100 text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian D: Data Bangunan/Fasilitas -->
                    <div>
                        <h2 class="section-title"><span class="material-symbols-outlined">architecture</span> D. Data Bangunan/Fasilitas</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-1 md:col-span-2">
                                <label class="form-label">Upload Foto Fasilitas/Gedung (Tampak Depan) <span class="text-red-500">*</span></label>
                                <input type="file" name="house_image_file" accept=".jpg,.jpeg,.png" required class="form-input bg-white p-2 text-sm">
                            </div>
                            
                            <div>
                                <label class="form-label">Peruntukkan <span class="text-red-500">*</span></label>
                                <select name="purpose_id" required class="form-select">
                                    <option value="">Pilih...</option>
                                    @foreach($purposes as $p)
                                        <option value="{{ $p->peruntukan }}" {{ old('purpose_id') == $p->peruntukan ? 'selected' : '' }}>{{ $p->peruntukan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="form-label">Jenis Bangunan <span class="text-red-500">*</span></label>
                                <select name="building_type_id" required class="form-select">
                                    <option value="">Pilih...</option>
                                    @foreach($buildingTypes as $b)
                                        <option value="{{ $b->jenis }}" {{ old('building_type_id') == $b->jenis ? 'selected' : '' }}>{{ $b->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label">Luas Tanah (m²) <span class="text-red-500">*</span></label>
                                    <input type="number" name="land_area" value="{{ old('land_area') }}" required class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Luas Bangunan (m²) <span class="text-red-500">*</span></label>
                                    <input type="number" name="building_area" value="{{ old('building_area') }}" required class="form-input">
                                </div>
                            </div>
                            
                            <div>
                                <label class="form-label">Jumlah Pengguna/Penghuni <span class="text-red-500">*</span></label>
                                <input type="number" name="occupants_count" value="{{ old('occupants_count') }}" required class="form-input">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bagian E: Kondisi Air -->
                    <div>
                        <h2 class="section-title"><span class="material-symbols-outlined">water_drop</span> E. Kondisi Air</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-1 md:col-span-2">
                                <label class="form-label">Air yang Digunakan Saat Ini <span class="text-red-500">*</span></label>
                                <select name="water_source_id" required class="form-select">
                                    <option value="">Pilih...</option>
                                    @foreach($waterSources as $w)
                                        <option value="{{ $w->id }}" {{ old('water_source_id') == $w->id ? 'selected' : '' }}>{{ $w->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-surface-border flex items-center justify-between flex-wrap gap-4">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-yellow-500 text-yellow-950 font-bold rounded-xl hover:bg-yellow-400 hover:shadow-lg hover:shadow-yellow-400/20 transition-all w-full md:w-auto ml-auto">
                            <span>Kirim Pengajuan</span>
                            <span class="material-symbols-outlined">send</span>
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="flex justify-center">
                <a href="{{ route('public.register.rumah-tangga') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-blue-700 transition-colors">
                    <span class="material-symbols-outlined">arrow_back</span> Daftar untuk Rumah Tangga
                </a>
            </div>
        </div>
    </main>

    @include('layouts.partials.footer')

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const villageSelect = document.getElementById('village_id');
            const rayonInput = document.getElementById('rayon_id');
            let pendingGeoData = null;

            let mapTriggeredVillageChange = false;

            villageSelect.addEventListener('change', function() {
                if (!mapTriggeredVillageChange && this.value) {
                    let kelurahanName = this.options[this.selectedIndex].text;
                    let searchName = kelurahanName.replace(/kelurahan\s+/ig, '').trim();
                    
                    // Langsung isi rayon dengan nama kelurahan agar tidak kosong/delay
                    rayonInput.value = searchName;

                    let query = encodeURIComponent(searchName + ", Kepulauan Riau");

                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}&limit=1`)
                        .then(res => res.json())
                        .then(data => {
                            if (data && data.length > 0) {
                                let lat = parseFloat(data[0].lat);
                                let lon = parseFloat(data[0].lon);
                                
                                map.setView([lat, lon], 15);
                                marker.setLatLng([lat, lon]);
                                
                                latInput.value = lat.toFixed(6);
                                lngInput.value = lon.toFixed(6);
                            }
                        })
                        .catch(err => console.error('Geocoding error:', err));
                }
                
                mapTriggeredVillageChange = false;
            });

            // ==========================================
            // 2. Leaflet Geolocation Map
            // ==========================================
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');
            
            // Default center (e.g., Tanjungpinang)
            let defaultLat = 0.9167; 
            let defaultLng = 104.4500;
            let zoomLevel = 13;

            if(latInput.value && lngInput.value) {
                defaultLat = parseFloat(latInput.value);
                defaultLng = parseFloat(lngInput.value);
                zoomLevel = 16;
            }

            const map = L.map('map').setView([defaultLat, defaultLng], zoomLevel);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const marker = L.marker([defaultLat, defaultLng], {draggable: true}).addTo(map);

            function updateInputs(lat, lng) {
                latInput.value = lat.toFixed(6);
                lngInput.value = lng.toFixed(6);
                reverseGeocode(lat, lng);
            }

            function reverseGeocode(lat, lng) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
                    .then(res => res.json())
                    .then(data => {
                        if (data && data.address) {
                            const addr = data.address;
                            
                            // Map kecamatan ke kode area (database rayon.sql) secara dinamis
                            const kecamatanMap = @json(\App\Models\Rayon::select('kodearea', 'area')->distinct()->get()->mapWithKeys(function($item) {
                                return [strtolower(trim($item->area)) => $item->kodearea];
                            }));

                            let kecamatanName = addr.city_district || addr.municipality || addr.county || addr.town || addr.suburb || '';
                            let matchedKodeArea = null;

                            if (kecamatanName) {
                                let searchKec = kecamatanName.toLowerCase();
                                for (const [key, code] of Object.entries(kecamatanMap)) {
                                    if (searchKec.includes(key) || key.includes(searchKec)) {
                                        matchedKodeArea = code;
                                        break;
                                    }
                                }
                            }

                            // 1. Pilih Kelurahan yang cocok berdasarkan data Geolocation
                            let options = villageSelect.options;
                            let kelurahanName = addr.village || addr.suburb || addr.neighbourhood || '';
                            let found = false;
                            
                            if (kelurahanName) {
                                let searchTxt = kelurahanName.toLowerCase().replace(/kelurahan\s+/g, '').trim();
                                for (let i = 1; i < options.length; i++) {
                                    let optText = options[i].text.toLowerCase().trim();
                                    if (optText.includes(searchTxt) || searchTxt.includes(optText)) {
                                        villageSelect.selectedIndex = i;
                                        found = true;
                                        break;
                                    }
                                }
                            }

                            // Jika tidak ketemu berdasarkan nama kelurahan, tapi kecamatannya ketemu, pilih kelurahan pertama di kecamatan itu
                            if (!found && matchedKodeArea) {
                                for (let i = 1; i < options.length; i++) {
                                    if (options[i].getAttribute('data-kecamatan') === matchedKodeArea) {
                                        villageSelect.selectedIndex = i;
                                        break;
                                    }
                                }
                            }

                            // 2. Isi kolom Rayon secara otomatis dari map
                            if (addr.road) {
                                rayonInput.value = addr.road;
                            } else if (addr.neighbourhood) {
                                rayonInput.value = addr.neighbourhood;
                            } else if (addr.suburb) {
                                rayonInput.value = addr.suburb;
                            }

                            pendingGeoData = addr;
                            mapTriggeredVillageChange = true;
                            villageSelect.dispatchEvent(new Event('change'));
                        }
                    })
                    .catch(err => console.error('Geocoding error:', err));
            }

            marker.on('dragend', function(e) {
                const pos = marker.getLatLng();
                updateInputs(pos.lat, pos.lng);
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateInputs(e.latlng.lat, e.latlng.lng);
            });
            
            const btnFindMe = document.getElementById('btn-find-me');
            if (btnFindMe) {
                btnFindMe.addEventListener('click', function() {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<span class="material-symbols-outlined text-[18px]">hourglass_empty</span> Mencari...';
                    this.disabled = true;

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;
                            map.setView([lat, lng], 17);
                            marker.setLatLng([lat, lng]);
                            updateInputs(lat, lng);
                            
                            btnFindMe.innerHTML = originalText;
                            btnFindMe.disabled = false;
                        }, function(error) {
                            alert("Gagal mendapatkan lokasi. Pastikan GPS aktif dan Anda mengizinkan akses lokasi pada browser.");
                            btnFindMe.innerHTML = originalText;
                            btnFindMe.disabled = false;
                        }, {
                            enableHighAccuracy: true,
                            timeout: 10000
                        });
                    } else {
                        alert("Browser Anda tidak mendukung fitur lokasi.");
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }
                });
            }
            
            // Try HTML5 geolocation if inputs are empty
            if(!latInput.value && navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    map.setView([lat, lng], 16);
                    marker.setLatLng([lat, lng]);
                    updateInputs(lat, lng);
                });
            }
        });
    </script>
</body>
</html>
