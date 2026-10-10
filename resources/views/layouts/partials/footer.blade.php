<footer class="bg-on-surface text-white">

    <div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin py-space-md md:py-space-xl">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-xl">

            {{-- Brand --}}
            <div class="lg:col-span-2">

                <div class="flex items-center gap-space-sm mb-space-md">

                    <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center">
                        <img src="{{ setting('site_icon') ? asset('storage/' . setting('site_icon')) : asset('img/logo tirta.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                    </div>

                    <div>
                        <h2 class="font-headline-sm text-headline-sm font-bold">
                            {{ $settings['company_name'] ?? setting('company_name', 'PERUMDA Tirta Kepri') }}
                        </h2>

                        <p class="font-body-sm text-body-sm text-slate-300">
                            Perusahaan Umum Daerah Air Minum
                        </p>
                    </div>

                </div>

                <p class="font-body-md text-body-md text-slate-300 leading-relaxed max-w-xl">
                    {{ $settings['footer_description'] ?? setting('footer_description', 'Portal resmi PERUMDA Air Minum Tirta Kepri. Memberikan layanan air bersih yang berkualitas, transparan, dan berkelanjutan bagi masyarakat Provinsi Kepulauan Riau.') }}
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
                            {{ $settings['footer_address'] ?? setting('footer_address', 'Jl. MT Haryono No. 56, Batu 3, Tanjungpinang') }}
                        </p>

                    </div>

                    <div class="flex gap-space-sm">
                        <span class="material-symbols-outlined text-primary-fixed shrink-0">
                            call
                        </span>
                        <p class="font-body-md text-body-md text-slate-300">
                            {{ $settings['navbar_call_center'] ?? setting('navbar_call_center', '(0771) 21555') }}
                        </p>
                    </div>

                    <div class="mt-4">
                        <p class="font-bold text-sm text-white mb-3 tracking-wide">WhatsApp Pelayanan Cabang</p>
                        <div class="flex flex-col gap-3">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['branch_1_wa'] ?? '08117782155') }}" target="_blank" class="flex items-center justify-between group hover:bg-white/10 p-2 -mx-2 rounded-lg transition-colors">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-status-success/20 text-status-success flex items-center justify-center group-hover:bg-status-success group-hover:text-white transition-colors">
                                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M12.031 0C5.394 0 0 5.394 0 12.031a11.97 11.97 0 001.6 5.96L0 24l6.17-1.6a11.97 11.97 0 005.861 1.53h.005c6.634 0 12.028-5.394 12.028-12.031S18.665 0 12.031 0zM12.036 21.905h-.003a9.944 9.944 0 01-5.068-1.378l-.363-.215-3.774.989.998-3.68-.236-.375a9.957 9.957 0 01-1.524-5.215c0-5.512 4.484-9.997 10.002-9.997 2.671 0 5.18 1.04 7.067 2.93a9.972 9.972 0 012.923 7.07c-.001 5.511-4.485 9.996-9.998 9.996zm5.485-7.493c-.301-.151-1.782-.879-2.059-.979-.277-.1-.478-.151-.678.151-.2.301-.777.979-.953 1.18-.175.201-.352.226-.653.076a8.212 8.212 0 01-2.417-1.492 9.074 9.074 0 01-1.684-2.096c-.176-.301-.019-.464.132-.614.136-.135.301-.352.452-.527.151-.176.201-.301.301-.502.1-.2.05-.376-.025-.527-.075-.151-.678-1.631-.928-2.234-.244-.588-.493-.508-.678-.517-.175-.008-.376-.008-.577-.008a1.1 1.1 0 00-.791.368c-.277.301-1.055 1.029-1.055 2.51s1.08 2.912 1.23 3.113c.151.2 2.122 3.238 5.139 4.54.718.311 1.278.497 1.714.636.72.189 1.376.162 1.895.098.58-.073 1.782-.728 2.033-1.431.251-.703.251-1.306.175-1.431-.075-.126-.276-.201-.577-.352z"></path></svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-slate-400 uppercase font-bold">{{ $settings['branch_1_name'] ?? 'Tanjungpinang' }}</span>
                                        <span class="text-sm text-slate-200 font-semibold group-hover:text-white">{{ $settings['branch_1_wa'] ?? '0811-778-2155' }}</span>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-slate-500 group-hover:text-white text-[16px] transition-colors">open_in_new</span>
                            </a>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['branch_2_wa'] ?? '08123456789') }}" target="_blank" class="flex items-center justify-between group hover:bg-white/10 p-2 -mx-2 rounded-lg transition-colors">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-status-success/20 text-status-success flex items-center justify-center group-hover:bg-status-success group-hover:text-white transition-colors">
                                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M12.031 0C5.394 0 0 5.394 0 12.031a11.97 11.97 0 001.6 5.96L0 24l6.17-1.6a11.97 11.97 0 005.861 1.53h.005c6.634 0 12.028-5.394 12.028-12.031S18.665 0 12.031 0zM12.036 21.905h-.003a9.944 9.944 0 01-5.068-1.378l-.363-.215-3.774.989.998-3.68-.236-.375a9.957 9.957 0 01-1.524-5.215c0-5.512 4.484-9.997 10.002-9.997 2.671 0 5.18 1.04 7.067 2.93a9.972 9.972 0 012.923 7.07c-.001 5.511-4.485 9.996-9.998 9.996zm5.485-7.493c-.301-.151-1.782-.879-2.059-.979-.277-.1-.478-.151-.678.151-.2.301-.777.979-.953 1.18-.175.201-.352.226-.653.076a8.212 8.212 0 01-2.417-1.492 9.074 9.074 0 01-1.684-2.096c-.176-.301-.019-.464.132-.614.136-.135.301-.352.452-.527.151-.176.201-.301.301-.502.1-.2.05-.376-.025-.527-.075-.151-.678-1.631-.928-2.234-.244-.588-.493-.508-.678-.517-.175-.008-.376-.008-.577-.008a1.1 1.1 0 00-.791.368c-.277.301-1.055 1.029-1.055 2.51s1.08 2.912 1.23 3.113c.151.2 2.122 3.238 5.139 4.54.718.311 1.278.497 1.714.636.72.189 1.376.162 1.895.098.58-.073 1.782-.728 2.033-1.431.251-.703.251-1.306.175-1.431-.075-.126-.276-.201-.577-.352z"></path></svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-slate-400 uppercase font-bold">{{ $settings['branch_2_name'] ?? 'Kijang' }}</span>
                                        <span class="text-sm text-slate-200 font-semibold group-hover:text-white">{{ $settings['branch_2_wa'] ?? '0812-345-6789' }}</span>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-slate-500 group-hover:text-white text-[16px] transition-colors">open_in_new</span>
                            </a>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['branch_3_wa'] ?? '08134567890') }}" target="_blank" class="flex items-center justify-between group hover:bg-white/10 p-2 -mx-2 rounded-lg transition-colors">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-status-success/20 text-status-success flex items-center justify-center group-hover:bg-status-success group-hover:text-white transition-colors">
                                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M12.031 0C5.394 0 0 5.394 0 12.031a11.97 11.97 0 001.6 5.96L0 24l6.17-1.6a11.97 11.97 0 005.861 1.53h.005c6.634 0 12.028-5.394 12.028-12.031S18.665 0 12.031 0zM12.036 21.905h-.003a9.944 9.944 0 01-5.068-1.378l-.363-.215-3.774.989.998-3.68-.236-.375a9.957 9.957 0 01-1.524-5.215c0-5.512 4.484-9.997 10.002-9.997 2.671 0 5.18 1.04 7.067 2.93a9.972 9.972 0 012.923 7.07c-.001 5.511-4.485 9.996-9.998 9.996zm5.485-7.493c-.301-.151-1.782-.879-2.059-.979-.277-.1-.478-.151-.678.151-.2.301-.777.979-.953 1.18-.175.201-.352.226-.653.076a8.212 8.212 0 01-2.417-1.492 9.074 9.074 0 01-1.684-2.096c-.176-.301-.019-.464.132-.614.136-.135.301-.352.452-.527.151-.176.201-.301.301-.502.1-.2.05-.376-.025-.527-.075-.151-.678-1.631-.928-2.234-.244-.588-.493-.508-.678-.517-.175-.008-.376-.008-.577-.008a1.1 1.1 0 00-.791.368c-.277.301-1.055 1.029-1.055 2.51s1.08 2.912 1.23 3.113c.151.2 2.122 3.238 5.139 4.54.718.311 1.278.497 1.714.636.72.189 1.376.162 1.895.098.58-.073 1.782-.728 2.033-1.431.251-.703.251-1.306.175-1.431-.075-.126-.276-.201-.577-.352z"></path></svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[10px] text-slate-400 uppercase font-bold">{{ $settings['branch_3_name'] ?? 'Tanjung Uban' }}</span>
                                        <span class="text-sm text-slate-200 font-semibold group-hover:text-white">{{ $settings['branch_3_wa'] ?? '0813-456-7890' }}</span>
                                    </div>
                                </div>
                                <span class="material-symbols-outlined text-slate-500 group-hover:text-white text-[16px] transition-colors">open_in_new</span>
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        {{-- Copyright --}}
        <div class="border-t border-white/10 mt-space-xl pt-space-lg
                    flex flex-col md:flex-row
                    items-center justify-between gap-space-sm">

            <p class="font-body-sm text-body-sm text-slate-400 text-center md:text-left">
                © {{ date('Y') }} {{ $settings['company_name'] ?? setting('company_name', 'PERUMDA Air Minum Tirta Kepri') }}.
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

