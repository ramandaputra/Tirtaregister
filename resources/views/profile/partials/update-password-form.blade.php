<section>
    <header>
        <h2 class="text-lg font-bold text-on-surface">
            Perbarui Kata Sandi
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 flex flex-col flex-grow">
        @csrf
        @method('put')

        <div class="space-y-5">

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold text-gray-700 mb-1">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full rounded-xl border border-surface-border bg-surface-ice focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary text-sm px-4 py-2.5 transition-colors" autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold text-gray-700 mb-1">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="w-full rounded-xl border border-surface-border bg-surface-ice focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary text-sm px-4 py-2.5 transition-colors" autocomplete="new-password" />
            @error('password', 'updatePassword')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full rounded-xl border border-surface-border bg-surface-ice focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary text-sm px-4 py-2.5 transition-colors" autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        </div> <!-- End of space-y-5 -->

        <div class="flex flex-wrap items-center gap-4 pt-6 mt-auto">
            <button type="submit" class="px-5 py-2.5 bg-primary hover:bg-primary/90 text-white font-semibold rounded-xl transition shadow-sm">
                Perbarui Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-medium text-status-success bg-emerald-50 px-3 py-1.5 rounded-lg flex items-center gap-1.5"
                >
                    <span class="w-2 h-2 rounded-full bg-status-success"></span>
                    Kata Sandi Diperbarui
                </p>
            @endif
        </div>
    </form>
</section>
