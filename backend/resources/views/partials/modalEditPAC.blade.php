<div
    id="modalEditPAC"
    class="fixed inset-0 bg-black/50 hidden items-start justify-center z-50 p-6 overflow-y-auto"
>
    <div class="relative w-full max-w-[896px] rounded-[16px] bg-white shadow-2xl">
        <div class="flex flex-col">
            <div class="flex items-center justify-between border-b border-[#E5E7EB] px-8 py-6">
                <div class="space-y-1">
                    <h2 class="text-[24px] font-bold leading-8 text-[#1D1D1D]">
                        Edit PAC
                    </h2>
                    <p class="text-sm text-[#717182]">
                        Update informasi PAC yang dipilih
                    </p>
                </div>

                <button
                    onclick="closeEditPACModal()"
                    class="flex h-10 w-10 items-center justify-center rounded-[12px] text-[24px] text-[#1D1D1D] hover:bg-[#F5F7F8]"
                    type="button"
                >
                    ×
                </button>
            </div>

            <form id="formEditPAC" method="POST" class="flex flex-col">

                @csrf
                @method('PUT')

                <div class="space-y-8 px-8 pt-6 pb-6 max-h-[calc(100vh-300px)] overflow-y-auto">

                    <div class="space-y-3">
                        <div>
                            <h3 class="text-[18px] font-semibold text-[#1D1D1D]">Informasi Dasar PAC</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Nama PAC</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="text"
                                    name="nama_pac"
                                    id="editNamaPAC"
                                    required
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Kecamatan</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="text"
                                    name="kecamatan"
                                    id="editKecamatan"
                                    required
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <!-- Baris 2 Kiri: Tanggal Penetapan SK -->
                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Tanggal Penetapan SK</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="date"
                                    name="tanggal_berdiri"
                                    id="editTanggalBerdiri"
                                    required
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                                <p class="text-xs text-[#717182]">Tanggal dikeluarkannya SK kepengurusan PAC.</p>
                            </div>

                            <!-- Baris 2 Kanan: Status PAC -->
                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Status PAC</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <select
                                    name="status"
                                    id="editStatus"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm font-medium text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                                    <option value="aktif">Aktif</option>
                                    <option value="akan_expire">Akan Expire (Masa SK &le; 30 Hari)</option>
                                    <option value="tidak_aktif">Tidak Aktif (SK Kedaluwarsa)</option>
                                    <option value="pending">Pending</option>
                                </select>
                                <p class="text-xs text-[#717182]">Status otomatis tersinkronisasi dari tanggal kedaluwarsa.</p>
                            </div>

                            <!-- Baris 3 Kiri: Tanggal Kedaluwarsa SK (Tepat di Bawah Tanggal Penetapan SK) -->
                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Tanggal Kedaluwarsa SK</span>
                                </div>
                                <input
                                    type="date"
                                    name="tanggal_kedaluwarsa"
                                    id="editTanggalKedaluwarsa"
                                    oninput="syncStatusFromExpiry('editTanggalKedaluwarsa', 'editStatus', 'editStatusHelper')"
                                    onchange="syncStatusFromExpiry('editTanggalKedaluwarsa', 'editStatus', 'editStatusHelper')"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                                <p id="editStatusHelper" class="text-xs text-[#717182] mt-1">Status otomatis menyesuaikan tanggal kedaluwarsa SK.</p>
                            </div>

                            <!-- Baris 3 Kanan: Aturan Status SK Otomatis (Tepat di Bawah Status PAC) -->
                            <div class="space-y-2">
                                <div class="text-sm font-medium text-[#1D1D1D]">Ketentuan Status SK Otomatis</div>
                                <div class="rounded-[12px] border border-gray-200 bg-gray-50 p-3 text-xs text-[#555] space-y-1.5">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-green-500 shrink-0"></span>
                                        <span><strong>Aktif:</strong> Masa SK masih berlaku (&gt; 30 hari)</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-amber-500 shrink-0"></span>
                                        <span><strong>Akan Expire:</strong> Sisa masa berlaku &le; 30 hari</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-red-500 shrink-0"></span>
                                        <span><strong>Tidak Aktif:</strong> Tanggal SK sudah kedaluwarsa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <h3 class="text-[18px] font-semibold text-[#1D1D1D]">Alamat Lengkap</h3>
                        </div>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Alamat Jalan</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="text"
                                    name="alamat"
                                    id="editAlamat"
                                    placeholder="Contoh: Jl. Raya Cibadak No.123"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                        <span>Desa/Kelurahan</span>
                                        <span class="text-[#D4183D]">*</span>
                                    </div>
                                    <input
                                        type="text"
                                        name="desa"
                                        id="editDesa"
                                        class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                    >
                                </div>
                                <div class="space-y-2">
                                    <div class="text-sm font-medium text-[#1D1D1D]">Kode Pos</div>
                                    <input
                                        type="text"
                                        name="kode_pos"
                                        id="editKodePos"
                                        class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <h3 class="text-[18px] font-semibold text-[#1D1D1D]">Informasi Ketua PAC</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>Nama Ketua</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="text"
                                    name="ketua_pac"
                                    id="editKetua"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center gap-1 text-sm font-medium text-[#1D1D1D]">
                                    <span>No. Telepon</span>
                                    <span class="text-[#D4183D]">*</span>
                                </div>
                                <input
                                    type="text"
                                    name="telepon"
                                    id="editTelepon"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="text-sm font-medium text-[#1D1D1D]">Email</div>
                                <input
                                    type="email"
                                    name="email"
                                    id="editEmail"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="text-sm font-medium text-[#1D1D1D]">Jumlah Anggota</div>
                                <input
                                    type="number"
                                    name="jumlah_anggota"
                                    id="editJumlahAnggota"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="text-sm font-medium text-[#1D1D1D]">Nomor SK</div>
                                <input
                                    type="text"
                                    name="nomor_sk"
                                    id="editNomorSK"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>

                            <div class="space-y-2">
                                <div class="text-sm font-medium text-[#1D1D1D]">Alumni LKD</div>
                                <input
                                    type="number"
                                    name="alumni_lkd"
                                    id="editAlumniLKD"
                                    min="0"
                                    class="h-11 w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A]"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="text-sm font-medium text-[#1D1D1D]">Deskripsi/Keterangan</div>
                        <textarea
                            name="deskripsi"
                            id="editDeskripsi"
                            rows="5"
                            class="h-[114px] w-full rounded-[12px] border border-[#E5E7EB] bg-white px-4 py-3 text-sm text-[#1D1D1D] outline-none focus:border-[#0F5E3A] resize-none"
                        ></textarea>
                    </div>

                </div>
                <div class="border-t border-[#E5E7EB] bg-white px-8 py-6">
                    <div class="grid grid-cols-3 gap-4">
                        <button
                            type="button"
                            onclick="closeEditPACModal()"
                            class="flex h-12 items-center justify-center rounded-[12px] border border-[#E5E7EB] text-sm font-medium text-[#1D1D1D] hover:bg-[#F5F7F8] transition"
                        >
                            Batal
                        </button>
                        <button
                            type="button"
                            onclick="hapusPAC()"
                            class="flex h-12 items-center justify-center rounded-[12px] bg-red-600 text-sm font-medium text-white transition hover:bg-red-700"
                        >
                            Hapus PAC
                        </button>
                        <button
                            type="submit"
                            class="flex h-12 items-center justify-center rounded-[12px] bg-[#0F5E3A] text-sm font-medium text-white transition hover:bg-[#15633D]"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

<script>
function hapusPAC() {
    if(confirm('Apakah Anda yakin ingin menghapus PAC ini? Data yang dihapus tidak dapat dikembalikan.')) {
        const formAction = document.getElementById('formEditPAC').action;
        const deleteAction = formAction.replace('/update/', '/delete/');
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = deleteAction;
        
        const tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = document.querySelector('#formEditPAC input[name="_token"]').value;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(tokenInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

            </form>

        </div>

    </div>

</div>
