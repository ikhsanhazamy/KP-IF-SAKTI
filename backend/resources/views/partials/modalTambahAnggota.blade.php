<div id="modalTambah" class="fixed inset-0 z-[100] hidden items-start justify-center overflow-y-auto bg-black/40 p-4 sm:p-6">
    <div class="relative my-auto max-h-[calc(100vh-2rem)] w-full max-w-3xl overflow-y-auto rounded-[28px] bg-white p-6 sm:p-8 md:p-10">
        <button
            type="button"
            onclick="closeTambahModal()"
            class="absolute right-6 top-5 text-3xl text-gray-500"
            aria-label="Tutup"
        >
            &times;
        </button>

        <h2 class="mb-8 text-4xl font-bold">Tambah Anggota Baru</h2>

        <form action="/anggota/store" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="mb-2 block font-medium">Nama Lengkap *</label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    placeholder="Hj. Nama Lengkap, S.Pd"
                    class="w-full rounded-2xl border px-5 py-4 outline-none"
                    required
                >
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block font-medium">Email *</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full rounded-2xl border px-5 py-4"
                        required
                    >
                </div>

                <div>
                    <label class="mb-2 block font-medium">No. Telepon *</label>
                    <input
                        type="text"
                        name="telepon"
                        value="{{ old('telepon') }}"
                        class="w-full rounded-2xl border px-5 py-4"
                        required
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block font-medium">PAC *</label>
                    <input
                        type="text"
                        name="pac"
                        value="{{ old('pac') }}"
                        class="w-full rounded-2xl border px-5 py-4"
                        required
                    >
                </div>

                <div>
                    <label class="mb-2 block font-medium">Profesi *</label>
                    <input
                        type="text"
                        name="profesi"
                        value="{{ old('profesi') }}"
                        class="w-full rounded-2xl border px-5 py-4"
                        required
                    >
                </div>
            </div>

            <div>
                <label class="mb-2 block font-medium">Pendidikan *</label>
                <select name="pendidikan" class="w-full rounded-2xl border px-5 py-4" required>
                    <option value="">Pilih Pendidikan</option>
                    @foreach(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'] as $pendidikan)
                        <option value="{{ $pendidikan }}" @selected(old('pendidikan') === $pendidikan)>
                            {{ $pendidikan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block font-medium">Tanggal Lahir *</label>
                    <input
                        type="date"
                        name="tanggal_lahir"
                        value="{{ old('tanggal_lahir') }}"
                        max="{{ now()->toDateString() }}"
                        class="w-full rounded-2xl border px-5 py-4"
                        required
                    >
                </div>

                <div>
                    <label class="mb-2 block font-medium">Tanggal Bergabung *</label>
                    <input
                        type="date"
                        name="tanggal_bergabung"
                        value="{{ old('tanggal_bergabung') }}"
                        class="w-full rounded-2xl border px-5 py-4"
                        required
                    >
                </div>
            </div>

            <div>
                <label class="mb-2 block font-medium">Status *</label>
                <select name="status" class="w-full rounded-2xl border px-5 py-4" required>
                    <option value="aktif" @selected(old('status', 'aktif') === 'aktif')>Aktif</option>
                    <option value="tidak_aktif" @selected(old('status') === 'tidak_aktif')>Tidak Aktif</option>
                </select>
            </div>

            <div>
                <label class="mb-2 block font-medium">Status Pernikahan *</label>
                <select name="status_pernikahan" class="w-full rounded-2xl border px-5 py-4" required>
                    <option value="kawin" @selected(old('status_pernikahan') === 'kawin')>Kawin</option>
                    <option value="belum_kawin" @selected(old('status_pernikahan', 'belum_kawin') === 'belum_kawin')>Belum Kawin</option>
                    <option value="cerai_hidup" @selected(old('status_pernikahan') === 'cerai_hidup')>Cerai Hidup</option>
                    <option value="cerai_mati" @selected(old('status_pernikahan') === 'cerai_mati')>Cerai Mati</option>
                </select>
            </div>

            @if($errors->any())
                <div class="rounded-2xl bg-red-50 px-5 py-4 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="grid grid-cols-2 gap-5 pt-4">
                <button type="button" onclick="closeTambahModal()" class="rounded-2xl border py-4">
                    Batal
                </button>
                <button type="submit" class="rounded-2xl bg-[#15633D] py-4 text-white">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
