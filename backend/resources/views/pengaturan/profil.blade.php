@php
    $user = auth()->user();
    $userInitial = mb_strtoupper(mb_substr($user->name, 0, 1));
    $photoUrl = $user->photo ? '/storage/'.ltrim($user->photo, '/') : null;
@endphp

<div class="space-y-4">
    @if(session('success'))
        <div class="rounded-xl bg-green-100 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-xl bg-red-100 px-4 py-3 text-red-700">
            <ul class="list-inside list-disc space-y-1 text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="rounded-2xl border border-gray-200 bg-white p-6">
        <h2 class="mb-6 text-[20px] font-bold">Informasi Profil</h2>

        <form
            method="POST"
            action="{{ route('pengaturan.profil.update') }}"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="mb-10 flex flex-col gap-6 sm:flex-row sm:items-center">
                <div class="relative h-24 w-24 shrink-0 overflow-hidden rounded-full bg-[#EDF7F0] ring-4 ring-[#F2F7F4]">
                    @if($photoUrl)
                        <img
                            id="profilePhotoPreview"
                            src="{{ $photoUrl }}"
                            class="h-full w-full object-cover"
                            alt="Foto profil {{ $user->name }}"
                        >
                    @else
                        <img id="profilePhotoPreview" class="hidden h-full w-full object-cover" alt="Preview foto profil">
                    @endif

                    <div
                        id="profilePhotoFallback"
                        class="{{ $photoUrl ? 'hidden' : 'flex' }} h-full w-full items-center justify-center"
                    >
                        <span class="text-3xl font-bold text-[#15633D]">{{ $userInitial }}</span>
                    </div>
                </div>

                <div class="min-w-0">
                    <label
                        for="photo"
                        class="inline-flex cursor-pointer rounded-xl border px-5 py-3 hover:bg-gray-50"
                    >
                        Ganti Foto
                    </label>
                    <input
                        type="file"
                        name="photo"
                        id="photo"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="hidden"
                    >
                    <p id="photoFileName" class="mt-2 max-w-sm truncate text-xs text-gray-500">
                        JPG, PNG, atau WebP. Maksimal 2 MB.
                    </p>
                    <p id="photoSaveHint" class="mt-1 hidden text-xs font-medium text-[#15633D]">
                        Preview sudah diperbarui. Klik Simpan Perubahan untuk menyimpan foto.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium" for="name">Nama Lengkap</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full rounded-xl border px-4 py-3"
                        required
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium" for="email">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full rounded-xl border px-4 py-3"
                        required
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium" for="phone">No Telepon</label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        value="{{ old('phone', $user->phone) }}"
                        class="w-full rounded-xl border px-4 py-3"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium" for="jabatan">Jabatan</label>
                    <input
                        type="text"
                        name="jabatan"
                        id="jabatan"
                        value="{{ old('jabatan', $user->jabatan) }}"
                        class="w-full rounded-xl border px-4 py-3"
                    >
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button
                    type="submit"
                    class="rounded-xl bg-[#15633D] px-6 py-3 text-white hover:bg-[#0F5E3A]"
                >
                    Simpan Perubahan
                </button>
            </div>
        </form>

        @if($user->photo)
            <form
                method="POST"
                action="{{ route('pengaturan.profil.foto.delete') }}"
                class="mt-4 border-t pt-4"
            >
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-600">
                    Hapus Foto
                </button>
            </form>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const photoInput = document.getElementById('photo');
        const preview = document.getElementById('profilePhotoPreview');
        const fallback = document.getElementById('profilePhotoFallback');
        const fileName = document.getElementById('photoFileName');
        const saveHint = document.getElementById('photoSaveHint');
        let previewUrl;

        if (!photoInput || !preview) {
            return;
        }

        preview.addEventListener('error', () => {
            preview.classList.add('hidden');
            fallback.classList.remove('hidden');
            fallback.classList.add('flex');
        });

        photoInput.addEventListener('change', () => {
            const file = photoInput.files?.[0];

            if (!file) {
                return;
            }

            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
            }

            previewUrl = URL.createObjectURL(file);
            preview.src = previewUrl;
            preview.classList.remove('hidden');
            fallback.classList.add('hidden');
            fallback.classList.remove('flex');
            fileName.textContent = file.name;
            saveHint.classList.remove('hidden');
        });
    });
</script>
