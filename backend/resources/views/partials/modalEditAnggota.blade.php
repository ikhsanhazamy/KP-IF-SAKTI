<div id="modalEdit" class="fixed inset-0 z-[100] hidden items-start justify-center overflow-y-auto bg-black/40 p-4 sm:p-6">
    <div class="my-auto max-h-[calc(100vh-2rem)] w-full max-w-3xl overflow-y-auto rounded-3xl bg-white p-6 sm:p-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-[#1E1E1E]">Edit Anggota</h2>
                <p class="mt-2 text-gray-500">Perbarui data anggota Fatayat NU</p>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-3xl text-gray-400 hover:text-black">
                &times;
            </button>
        </div>

        <form id="formEditAnggota" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="mb-3 block text-lg font-medium">Nama Lengkap</label>
                <input type="text" name="nama" id="editNama" class="w-full rounded-2xl border border-gray-200 px-5 py-4" required>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-3 block text-lg font-medium">Email</label>
                    <input type="email" name="email" id="editEmail" class="w-full rounded-2xl border border-gray-200 px-5 py-4" required>
                </div>
                <div>
                    <label class="mb-3 block text-lg font-medium">Nomor Telepon</label>
                    <input type="text" name="telepon" id="editTelepon" class="w-full rounded-2xl border border-gray-200 px-5 py-4" required>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-3 block text-lg font-medium">PAC</label>
                    <input type="text" name="pac" id="editPac" class="w-full rounded-2xl border border-gray-200 px-5 py-4" required>
                </div>
                <div>
                    <label class="mb-3 block text-lg font-medium">Profesi</label>
                    <input type="text" name="profesi" id="editProfesi" class="w-full rounded-2xl border border-gray-200 px-5 py-4" required>
                </div>
            </div>

            <div>
                <label class="mb-3 block text-lg font-medium">Pendidikan</label>
                <select name="pendidikan" id="editPendidikan" class="w-full rounded-2xl border border-gray-200 px-5 py-4" required>
                    <option value="">Pilih Pendidikan</option>
                    @foreach(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'] as $pendidikan)
                        <option value="{{ $pendidikan }}">{{ $pendidikan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-3 block text-lg font-medium">Tanggal Lahir</label>
                    <input
                        type="date"
                        name="tanggal_lahir"
                        id="editTanggalLahir"
                        max="{{ now()->toDateString() }}"
                        class="w-full rounded-2xl border border-gray-200 px-5 py-4"
                        required
                    >
                </div>
                <div>
                    <label class="mb-3 block text-lg font-medium">Tanggal Bergabung</label>
                    <input type="date" name="tanggal_bergabung" id="editTanggal" class="w-full rounded-2xl border border-gray-200 px-5 py-4" required>
                </div>
            </div>

            <div>
                <label class="mb-3 block text-lg font-medium">Status</label>
                <select name="status" id="editStatus" class="w-full rounded-2xl border border-gray-200 px-5 py-4" required>
                    <option value="aktif">Aktif</option>
                    <option value="tidak_aktif">Tidak Aktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <button type="button" onclick="closeEditModal()" class="rounded-2xl border border-gray-200 px-8 py-4 hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="rounded-2xl bg-[#15633D] px-8 py-4 text-white hover:bg-[#0F5E3A]">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
