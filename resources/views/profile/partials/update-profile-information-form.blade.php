<section>
    <header>
        <h2 class="text-lg font-bold text-on-surface">
            Informasi Profil
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            Perbarui nama dan alamat email akun Anda.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 flex flex-col flex-grow" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex flex-col items-center justify-center mb-8 text-center bg-gray-50/50 p-6 rounded-2xl border border-surface-border">
            <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-primary/10 flex items-center justify-center overflow-hidden border-4 border-white shadow-md mb-4 shrink-0">
                @if($user->profile_photo_path)
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Foto Profil" class="w-full h-full object-cover">
                @else
                    <span class="text-primary font-bold text-3xl">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                @endif
            </div>
            
            <div class="w-full max-w-sm overflow-hidden">
                <input id="profile_photo" name="profile_photo" type="file" accept="image/png, image/jpeg, image/jpg" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition cursor-pointer" />
                <p class="text-xs text-gray-400 mt-2">Gunakan rasio 1:1. Format: JPG, JPEG, PNG (Maks 2MB)</p>
                @error('profile_photo')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="space-y-5">
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input id="name" name="name" type="text" class="w-full rounded-xl border border-surface-border bg-surface-ice focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary text-sm px-4 py-2.5 transition-colors" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" class="w-full rounded-xl border border-surface-border bg-surface-ice focus:ring-2 focus:ring-primary/20 focus:bg-white focus:border-primary text-sm px-4 py-2.5 transition-colors" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4 pt-6 mt-auto">
            <button type="submit" class="px-5 py-2.5 bg-primary hover:bg-primary/90 text-white font-semibold rounded-xl transition shadow-sm">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-medium text-status-success bg-emerald-50 px-3 py-1.5 rounded-lg flex items-center gap-1.5"
                >
                    <span class="w-2 h-2 rounded-full bg-status-success"></span>
                    Tersimpan
                </p>
            @endif
        </div>
    </form>
</section>
