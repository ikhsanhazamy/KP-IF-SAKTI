import AnggotaIcon from "../assets/icons/anggota.svg";
import PertumbuhanIcon from "../assets/icons/pertumbuhan.svg";
import PacIcon from "../assets/icons/pac.svg";
import QrIcon from "../assets/icons/QR.svg";

function MembershipSection() {
  return (
    <section className="bg-[#f6f8f7] px-20 py-20">

      {/* HEADER */}
      <div className="text-center mb-16">
        <div className="inline-flex items-center gap-2 bg-[#eef3f0] text-[#1f7a4d] px-4 py-1 rounded-full text-sm">
          Manajemen Anggota
        </div>

        <h2 className="text-3xl font-semibold mt-4 text-gray-900">
          Sistem Data Keanggotaan Digital
        </h2>

        <p className="text-gray-500 mt-2 max-w-xl mx-auto">
          Platform terpadu untuk mengelola data anggota, profesi, pendidikan, dan administrasi organisasi
        </p>
      </div>

      {/* GRID */}
      <div className="grid grid-cols-2 gap-12 items-center">

   <div className="relative">

  {/* BADGE */}
  <div className="absolute -top-5 right-14 bg-white shadow-md rounded-xl px-4 py-2 flex items-center gap-2 z-10">
    <div className="w-6 h-6 bg-green-100 text-green-700 flex items-center justify-center rounded-full text-sm">
      ✓
    </div>
    <div>
      <p className="text-xs text-gray-400">Status</p>
      <p className="text-sm font-semibold text-green-700">
        Terverifikasi
      </p>
    </div>
  </div>

  {/* CARD */}
  <div className="w-[592px] h-[392px] rounded-2xl overflow-hidden relative shadow-lg text-white">

    {/* BASE GRADIENT (LEBIH HALUS) */}
    <div className="absolute inset-0 bg-[linear-gradient(135deg,#1f6f45_0%,#2f7f55_40%,#4a9b6e_100%)]" />

    {/* SOFT LIGHT (INI KUNCI SUPAYA GA KASAR) */}
    <div className="absolute inset-0 bg-[radial-gradient(circle_at_75%_25%,rgba(255,255,255,0.12),transparent_60%)]" />

    {/* CONTENT */}
    <div className="relative z-10 h-full px-8 py-7 flex flex-col justify-between">

      {/* TOP */}
      <div>
        <p className="text-sm opacity-80">Kartu Tanda Anggota</p>
        <h3 className="text-2xl font-semibold mt-1">FATAYAT NU</h3>
        <p className="text-sm opacity-80">Sukabumi</p>
      </div>

      {/* DATA (TENGAH, BUKAN BAWAH BANGET) */}
      <div className="space-y-6 text-left">

  {/* NAMA (FULL WIDTH) */}
  <div>
    <p className="text-sm opacity-70">Nama Lengkap</p>
    <p className="text-lg font-semibold">Siti Nurhaliza, S.Pd</p>
  </div>

  {/* GRID 2 KOLOM */}
  <div className="grid grid-cols-2 gap-y-6 text-sm">

    <div>
      <p className="opacity-70">No. Anggota</p>
      <p className="font-medium text-base">FN-SKB-2024-1234</p>
    </div>

    <div>
      <p className="opacity-70">PAC</p>
      <p className="font-medium text-base">Cibadak</p>
    </div>


    <div>
      <p className="opacity-70">Berlaku Hingga</p>
      <p className="font-medium text-base">31 Desember 2026</p>
    </div>

  </div>

</div>

      {/* QR */}
      <div className="absolute bottom-7 right-7 w-20 h-20 bg-white rounded-xl flex items-center justify-center">
        <img src={QrIcon} className="w-12 h-12" />
      </div>

      {/* RING EFFECT (LEBIH HALUS) */}
      <div className="absolute bottom-0 right-0 w-36 h-36 border border-white/10 rounded-full" />
      <div className="absolute bottom-4 right-4 w-28 h-28 border border-white/10 rounded-full" />

    </div>
  </div>
</div>
        {/* RIGHT - FITUR */}
        <div className="flex flex-col gap-4">

          {/* ITEM */}
          <div className="bg-white rounded-xl p-5 border border-gray-200 flex gap-4 items-center h-[122px]">
            <div className="w-12 h-12 bg-[#eef3f0] rounded-xl flex items-center justify-center">
              <img src={PacIcon} className="w-14 h-14" />
            </div>
            <div>
              <p className="font-semibold text-gray-900">KTA Digital</p>
              <p className="text-sm text-gray-400">
                Kartu Tanda Anggota digital dengan QR Code untuk verifikasi dan validasi keanggotaan
              </p>
            </div>
          </div>

          <div className="bg-white rounded-xl p-5 border border-gray-200 flex gap-4 items-center h-[122px]">
            <div className="w-12 h-12 bg-[#eef3f0] rounded-xl flex items-center justify-center">
              <img src={PertumbuhanIcon} className="w-14 h-14" />
            </div>
            <div>
              <p className="font-semibold text-gray-900">Tracking Profesi</p>
              <p className="text-sm text-gray-400">
                Pencatatan dan monitoring profesi anggota untuk pemetaan potensi
              </p>
            </div>
          </div>

          <div className="bg-white rounded-xl p-5 border border-gray-200 flex gap-4 items-center h-[122px]">
            <div className="w-12 h-12 bg-[#eef3f0] rounded-xl flex items-center justify-center">
              <img src={AnggotaIcon} className="w-14 h-14" />
            </div>
            <div>
              <p className="font-semibold text-gray-900">Data Pendidikan</p>
              <p className="text-sm text-gray-400">
                Dokumentasi riwayat pendidikan anggota untuk pengembangan kapasitas organisasi
              </p>
            </div>
          </div>

          <div className="bg-white rounded-xl p-5 border border-gray-200 flex gap-4 items-center h-[122px]">
            <div className="w-14 h-14 bg-[#eef3f0] rounded-xl flex items-center justify-center">
              📊
            </div>
            <div>
              <p className="font-semibold text-gray-900">Analitik Organisasi</p>
              <p className="text-sm text-gray-400">
                Visualisasi data keanggotaan untuk pengambilan keputusan strategis organisasi
              </p>
            </div>
          </div>

        </div>
      </div>
    </section>
  );
}

export default MembershipSection;