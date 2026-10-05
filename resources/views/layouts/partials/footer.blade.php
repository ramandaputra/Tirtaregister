<footer class="bg-on-surface text-white">

    <div class="max-w-[1280px] mx-auto px-margin py-space-xl">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-xl">

            {{-- Brand --}}
            <div class="lg:col-span-2">

                <div class="flex items-center gap-space-sm mb-space-md">

                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[28px]">
                            water_drop
                        </span>
                    </div>

                    <div>
                        <h2 class="font-headline-sm text-headline-sm font-bold">
                            PERUMDA Tirta Kepri
                        </h2>

                        <p class="font-body-sm text-body-sm text-slate-300">
                            Perusahaan Umum Daerah Air Minum
                        </p>
                    </div>

                </div>

                <p class="font-body-md text-body-md text-slate-300 leading-relaxed max-w-xl">
                    Portal resmi PERUMDA Air Minum Tirta Kepri.
                    Memberikan layanan air bersih yang berkualitas,
                    transparan, dan berkelanjutan bagi masyarakat
                    Provinsi Kepulauan Riau.
                </p>

            </div>


            {{-- Navigasi --}}
            <div>

                <h3 class="font-title-md text-title-md font-bold mb-space-md">
                    Navigasi
                </h3>

                <ul class="space-y-space-sm font-body-md text-body-md text-slate-300">

                    <li>
                        <a
                            href="{{ url('/') }}"
                            class="hover:text-white transition-colors"
                        >
                            Beranda
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="hover:text-white transition-colors"
                        >
                            Tentang Kami
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="hover:text-white transition-colors"
                        >
                            Berita &amp; Pengumuman
                        </a>
                    </li>

                    <li>
                        <a
                            href="#"
                            class="hover:text-white transition-colors"
                        >
                            Layanan
                        </a>
                    </li>

                </ul>

            </div>


            {{-- Kontak --}}
            <div>

                <h3 class="font-title-md text-title-md font-bold mb-space-md">
                    Hubungi Kami
                </h3>

                <div class="space-y-space-sm">

                    <div class="flex gap-space-sm">

                        <span class="material-symbols-outlined text-primary-fixed shrink-0">
                            location_on
                        </span>

                        <p class="font-body-md text-body-md text-slate-300">
                            Jl. MT Haryono No. 56,
                            Batu 3, Tanjungpinang
                        </p>

                    </div>

                    <div class="flex gap-space-sm">

                        <span class="material-symbols-outlined text-primary-fixed shrink-0">
                            call
                        </span>

                        <p class="font-body-md text-body-md text-slate-300">
                            (0771) 21555
                        </p>

                    </div>

                    <div class="flex gap-space-sm">

                        <span class="material-symbols-outlined text-primary-fixed shrink-0">
                            chat
                        </span>

                        <p class="font-body-md text-body-md text-slate-300">
                            0811-778-2155
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Copyright --}}
        <div class="border-t border-white/10 mt-space-xl pt-space-lg
                    flex flex-col md:flex-row
                    items-center justify-between gap-space-sm">

            <p class="font-body-sm text-body-sm text-slate-400 text-center md:text-left">
                © {{ date('Y') }} PERUMDA Air Minum Tirta Kepri.
                Seluruh hak cipta dilindungi.
            </p>

            <div class="flex items-center gap-space-md">

                <a
                    href="#"
                    class="font-body-sm text-body-sm text-slate-400 hover:text-white transition-colors"
                >
                    Kebijakan Privasi
                </a>

                <a
                    href="#"
                    class="font-body-sm text-body-sm text-slate-400 hover:text-white transition-colors"
                >
                    Syarat &amp; Ketentuan
                </a>

            </div>

        </div>

    </div>

</footer>