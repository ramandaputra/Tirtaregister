@extends('layouts.admin')

@section('content')
<div class="max-w-[1200px] mx-auto">
                <!-- Header Page Banner -->
                <div class="bg-primary text-white rounded-2xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">Pengaturan Konten Website Utama</h1>
                        <p class="text-white/80 text-sm mt-1">Atur elemen visual dan informasi website yang ditampilkan di halaman publik beranda (Welcome Page) secara berurutan.</p>
                    </div>
                    
                    <a href="{{ url('/') }}" target="_blank" 
                       class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-xl text-sm font-semibold transition flex items-center gap-2 shrink-0">
                        <span class="material-symbols-outlined text-[18px]">open_in_new</span>
                        <span>Lihat Pratinjau Website</span>
                    </a>
                </div>

                <!-- Alert Notification -->
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 flex items-center gap-3">
                        <span class="material-symbols-outlined text-status-success text-[24px]">check_circle</span>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 space-y-1">
                        <div class="flex items-center gap-2 font-semibold text-sm">
                            <span class="material-symbols-outlined text-[20px]">error</span>
                            <span>Terdapat kesalahan pengisian data:</span>
                        </div>
                        <ul class="list-disc list-inside text-xs pl-6">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Pengaturan -->
                <form action="{{ route('superadmin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- 0. IDENTITAS WEBSITE & FOOTER -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-border">
                        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-surface-border">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                                0
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-on-surface">Identitas Website & Footer</h2>
                                <p class="text-xs text-on-surface-variant">Judul tab browser, nama instansi, logo ikon, dan teks footer bawah</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Judul Tab Browser (Site Title)</label>
                                <input type="text" name="site_title" 
                                       value="{{ $settings['site_title'] ?? 'Portal Resmi - PERUMDA Air Minum Tirta Kepri' }}" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Nama Perusahaan (Company Name)</label>
                                <input type="text" name="company_name" 
                                       value="{{ $settings['company_name'] ?? 'PERUMDA Tirta Kepri' }}" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Logo Website (Icon)</label>
                                @if(isset($settings['site_icon']) && $settings['site_icon'])
                                    <div class="mb-3 flex items-center gap-4">
                                        <img src="{{ asset('storage/' . $settings['site_icon']) }}" class="w-12 h-12 rounded bg-surface-container-low object-contain border border-surface-border" alt="Preview">
                                        <span class="text-xs text-gray-500">Ikon saat ini. Upload gambar baru (1:1) untuk mengganti.</span>
                                    </div>
                                @endif
                                <input type="file" name="site_icon" accept="image/*" 
                                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi Singkat Footer</label>
                                <textarea name="footer_description" rows="2" 
                                          class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">{{ $settings['footer_description'] ?? 'Portal resmi PERUMDA Air Minum Tirta Kepri. Memberikan layanan air bersih yang berkualitas, transparan, dan berkelanjutan bagi masyarakat Provinsi Kepulauan Riau.' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 1. BAGIAN PALING ATAS: NAVBAR & TOPBAR -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-border">
                        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-surface-border">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                                1
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-on-surface">Top Bar & Header Navbar</h2>
                                <p class="text-xs text-on-surface-variant">Informasi paling atas website (Pengumuman running text & Kontak cepat)</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-on-surface mb-2">Teks Running / Pengumuman Topbar</label>
                                <input type="text" name="navbar_topbar_text" 
                                       value="{{ $settings['navbar_topbar_text'] ?? 'Portal Resmi Layanan Pelanggan PERUMDA Air Minum Tirta Kepri • Pemerintah Provinsi Kepulauan Riau' }}" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Nomor Call Center Resmi (Hanya 1)</label>
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-3 text-on-surface-variant text-[20px]">call</span>
                                    <input type="text" name="navbar_call_center" 
                                           value="{{ $settings['navbar_call_center'] ?? '(0771) 21555' }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                                </div>
                            </div>

                            <div class="md:col-span-2 mt-2">
                                <h3 class="font-bold text-sm text-primary mb-3">Kontak WhatsApp 3 Cabang</h3>
                            </div>
                            
                            <!-- Cabang 1 -->
                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-3 p-4 border border-surface-border rounded-lg bg-surface-container-lowest">
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nama Cabang 1</label>
                                    <input type="text" name="branch_1_name" value="{{ $settings['branch_1_name'] ?? 'Tanjungpinang' }}" class="w-full px-3 py-2.5 rounded-lg border border-surface-border text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">WhatsApp Cabang 1</label>
                                    <input type="text" name="branch_1_wa" value="{{ $settings['branch_1_wa'] ?? '0811-778-2155' }}" class="w-full px-3 py-2.5 rounded-lg border border-surface-border text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                                </div>
                            </div>

                            <!-- Cabang 2 -->
                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-3 p-4 border border-surface-border rounded-lg bg-surface-container-lowest">
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nama Cabang 2</label>
                                    <input type="text" name="branch_2_name" value="{{ $settings['branch_2_name'] ?? 'Kijang' }}" class="w-full px-3 py-2.5 rounded-lg border border-surface-border text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">WhatsApp Cabang 2</label>
                                    <input type="text" name="branch_2_wa" value="{{ $settings['branch_2_wa'] ?? '0812-345-6789' }}" class="w-full px-3 py-2.5 rounded-lg border border-surface-border text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                                </div>
                            </div>

                            <!-- Cabang 3 -->
                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-3 p-4 border border-surface-border rounded-lg bg-surface-container-lowest">
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">Nama Cabang 3</label>
                                    <input type="text" name="branch_3_name" value="{{ $settings['branch_3_name'] ?? 'Tanjung Uban' }}" class="w-full px-3 py-2.5 rounded-lg border border-surface-border text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-on-surface mb-1">WhatsApp Cabang 3</label>
                                    <input type="text" name="branch_3_wa" value="{{ $settings['branch_3_wa'] ?? '0813-456-7890' }}" class="w-full px-3 py-2.5 rounded-lg border border-surface-border text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. BAGIAN TENGAH ATAS: HERO SECTION / LANDING UTAMA -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-border">
                        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-surface-border">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                                2
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-on-surface">Hero Section (Halaman Depan Utama)</h2>
                                <p class="text-xs text-on-surface-variant">Judul utama, deskripsi perkenalan, dan tombol aksi utama pada beranda</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Judul Headline Beranda</label>
                                <input type="text" name="home_hero_title" 
                                       value="{{ $settings['home_hero_title'] ?? 'Layanan Air Minum Terpercaya Kepulauan Riau' }}" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm font-medium">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi Sub-Judul Beranda</label>
                                <textarea name="home_hero_subtitle" rows="3" 
                                          class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">{{ $settings['home_hero_subtitle'] ?? 'Memberikan pelayanan distribusi air bersih berkelanjutan, profesional, dan responsif untuk mendukung kenyamanan masyarakat Kepulauan Riau.' }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-on-surface mb-2">Teks Tombol Aksi (CTA)</label>
                                    <input type="text" name="home_hero_cta_text" 
                                           value="{{ $settings['home_hero_cta_text'] ?? 'Cek Tagihan Air' }}" 
                                           class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-on-surface mb-2">Link / URL Tombol Aksi</label>
                                    <input type="text" name="home_hero_cta_url" 
                                           value="{{ $settings['home_hero_cta_url'] ?? '/cek-tagihan' }}" 
                                           class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2B. SLIDESHOW HERO CARD -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-border">
                        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-surface-border">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                                2B
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-on-surface">Slideshow Hero Card</h2>
                                <p class="text-xs text-on-surface-variant">Atur hingga 5 gambar dan teks untuk kartu sorotan di beranda (otomatis berganti)</p>
                            </div>
                        </div>

                        <div class="space-y-8">
                            @for($i = 1; $i <= 5; $i++)
                            <div class="p-4 rounded-xl border border-surface-border bg-surface-container-lowest">
                                <h3 class="font-bold text-primary mb-4">Slide Ke-{{ $i }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-semibold text-on-surface mb-2">Tag Sorotan</label>
                                        <input type="text" name="hero_card_tag_{{ $i }}" 
                                               value="{{ $settings['hero_card_tag_'.$i] ?? ($i==1 ? 'Infrastruktur Terintegrasi' : '') }}" 
                                               class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-on-surface mb-2">Judul Sorotan</label>
                                        <input type="text" name="hero_card_title_{{ $i }}" 
                                               value="{{ $settings['hero_card_title_'.$i] ?? ($i==1 ? 'Waduk Sei Gesek & Kolam Kolong Enam' : '') }}" 
                                               class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi Sorotan</label>
                                        <textarea name="hero_card_subtitle_{{ $i }}" rows="2" 
                                                  class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">{{ $settings['hero_card_subtitle_'.$i] ?? ($i==1 ? 'Sumber air baku utama pemenuhan kebutuhan Pulau Bintan & Tanjungpinang' : '') }}</textarea>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-semibold text-on-surface mb-2">Upload Foto (Gambar Utama Slide)</label>
                                        @if(isset($settings['hero_image_'.$i]) && $settings['hero_image_'.$i])
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $settings['hero_image_'.$i]) }}" class="h-20 rounded border border-surface-border object-cover">
                                            </div>
                                        @endif
                                        <input type="file" name="hero_image_{{ $i }}" accept="image/*" class="w-full px-4 py-2 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                                        <p class="text-[11px] text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti gambar. Rekomendasi rasio: 16:9 atau landscape.</p>
                                    </div>
                                </div>
                            </div>
                            @endfor

                            <hr class="border-surface-border my-8">

                            <div class="mb-4">
                                <h3 class="font-bold text-lg text-on-surface">Data Mini Stats & Badges</h3>
                                <p class="text-xs text-on-surface-variant">Tampil statis di bawah hero card (tidak ikut slideshow)</p>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div class="space-y-3">
                                    <h3 class="font-bold text-sm text-primary">Statistik 1</h3>
                                    <input type="text" name="stat_1_title" placeholder="Judul (Mis: Kapasitas)" value="{{ $settings['stat_1_title'] ?? 'Kapasitas Produksi' }}" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm">
                                    <input type="text" name="stat_1_value" placeholder="Angka (Mis: 450+)" value="{{ $settings['stat_1_value'] ?? '450+ Ltr/dtk' }}" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm font-bold">
                                    <input type="text" name="stat_1_sub" placeholder="Sub-teks (Mis: Kontinuitas 24 Jam)" value="{{ $settings['stat_1_sub'] ?? 'Standar Kontinuitas 24 Jam' }}" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm">
                                </div>
                                <div class="space-y-3">
                                    <h3 class="font-bold text-sm text-primary">Statistik 2</h3>
                                    <input type="text" name="stat_2_title" placeholder="Judul" value="{{ $settings['stat_2_title'] ?? 'Biaya Transparan' }}" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm">
                                    <input type="text" name="stat_2_value" placeholder="Angka" value="{{ $settings['stat_2_value'] ?? 'Sesuai SK' }}" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm font-bold">
                                    <input type="text" name="stat_2_sub" placeholder="Sub-teks" value="{{ $settings['stat_2_sub'] ?? 'Tanpa Biaya Tambahan Liar' }}" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm">
                                </div>
                                <div class="space-y-3">
                                    <h3 class="font-bold text-sm text-primary">Tagline Badges</h3>
                                    <input type="text" name="badge_1" placeholder="Badge 1" value="{{ $settings['badge_1'] ?? 'Resmi Pemprov Kepri' }}" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm">
                                    <input type="text" name="badge_2" placeholder="Badge 2" value="{{ $settings['badge_2'] ?? 'Data Terenkripsi' }}" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm">
                                    <input type="text" name="badge_3" placeholder="Badge 3" value="{{ $settings['badge_3'] ?? 'Survei Maks. 3 Hari' }}" class="w-full px-3 py-2 rounded-lg border border-surface-border text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. BAGIAN BAGIAN INFORMASI / BANNER BERITA -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-border">
                        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-surface-border">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                                3
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-on-surface">Section Banner Berita & Pengumuman</h2>
                                <p class="text-xs text-on-surface-variant">Teks pengantar pada area portal berita dan pengumuman resmi</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Judul Banner Berita</label>
                                <input type="text" name="news_hero_title" 
                                       value="{{ $settings['news_hero_title'] ?? 'Pusat Berita & Pengumuman' }}" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi Subtitle Banner Berita</label>
                                <textarea name="news_hero_subtitle" rows="2" 
                                          class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">{{ $settings['news_hero_subtitle'] ?? 'Dapatkan kabar terbaru mengenai operasional, perawatan jaringan, hingga informasi pelayanan pelanggan PERUMDA Air Minum Tirta Kepri.' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 4. BAGIAN PALING BAWAH: FOOTER WEBSITE -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-border">
                        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-surface-border">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                                4
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-on-surface">Footer Website (Bagian Bawah)</h2>
                                <p class="text-xs text-on-surface-variant">Deskripsi perusahaan dan alamat kontak pada bagian dasar beranda</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi Singkat Perusahaan</label>
                                <textarea name="footer_description" rows="3" 
                                          class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">{{ $settings['footer_description'] ?? 'Memberikan pelayanan air bersih yang andal, berkualitas, dan berkelanjutan bagi masyarakat Kepulauan Riau.' }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Alamat Kantor Pusat</label>
                                <div class="relative flex items-center">
                                    <span class="material-symbols-outlined absolute left-3 text-on-surface-variant text-[20px]">location_on</span>
                                    <input type="text" name="footer_address" 
                                           value="{{ $settings['footer_address'] ?? 'Tanjungpinang, Kepulauan Riau' }}" 
                                           class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. SECTION PENGADUAN 24/7 (HALAMAN BERITA) -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-border">
                        <div class="flex items-center gap-3 pb-4 mb-6 border-b border-surface-border">
                            <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                                5
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-on-surface">Layanan Pengaduan 24/7 (Halaman Berita)</h2>
                                <p class="text-xs text-on-surface-variant">Banner kontak dan aduan cepat di bagian bawah halaman berita</p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Tag/Badge Status (Contoh: Layanan Siaga 24/7)</label>
                                <input type="text" name="news_247_badge" 
                                       value="{{ $settings['news_247_badge'] ?? 'Layanan Siaga 24/7 • Tim Reaksi Cepat (TRC)' }}" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Judul Utama Pengaduan</label>
                                <input type="text" name="news_247_title" 
                                       value="{{ $settings['news_247_title'] ?? 'Layanan Pengaduan & Bantuan Cepat 24 Jam' }}" 
                                       class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi Pengaduan</label>
                                <textarea name="news_247_subtitle" rows="2" 
                                          class="w-full px-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">{{ $settings['news_247_subtitle'] ?? 'Mengalami gangguan distribusi air, pipa bocor, atau kendala meteran? Laporkan segera ke posko pengaduan resmi PERUMDA Air Minum Tirta Kepri.' }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-on-surface mb-2">Nomor Telepon Hotline 24/7</label>
                                    <div class="relative flex items-center">
                                        <span class="material-symbols-outlined absolute left-3 text-on-surface-variant text-[20px]">call</span>
                                        <input type="text" name="news_247_call" 
                                               value="{{ $settings['news_247_call'] ?? '(0771) 21574' }}" 
                                               class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-surface-border focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                                    </div>
                                    <p class="text-[11px] text-on-surface-variant mt-2">* Nomor WhatsApp pengaduan menggunakan 3 nomor cabang yang telah diatur pada bagian "Top Bar & Header Navbar".</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-4 pb-8">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-primary text-white font-semibold shadow hover:bg-primary/90 transition focus:outline-none cursor-pointer">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            <span>Simpan Perubahan Settings</span>
                        </button>
                    </div>
                </form>
            </div>
@endsection
