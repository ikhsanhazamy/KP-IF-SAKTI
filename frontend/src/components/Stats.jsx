import AnggotaIcon from "../assets/icons/anggota.svg";
import PertumbuhanIcon from "../assets/icons/pertumbuhan.svg";
import VerifikasiIcon from "../assets/icons/terverifikasi.svg";
import PacIcon from "../assets/icons/pac.svg";

function Stats() {
  return (
    <section className="bg-[#DDEEE34D] px-4 sm:px-8 lg:px-20 py-12 sm:py-16 lg:py-20">

      {/* HEADER */}
      <div className="text-center max-w-2xl mx-auto">
        <h2 className="text-2xl sm:text-3xl font-semibold text-gray-900">
          Statistik Organisasi
        </h2>
        <p className="text-gray-500 mt-3 text-sm sm:text-base">
          Data terkini mengenai perkembangan dan aktivitas organisasi Fatayat NU Sukabumi
        </p>
      </div>

      {/* GRID */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">

        {/* CARD 1 */}
        <div className="bg-white/30 backdrop-blur-lg rounded-2xl p-6 border border-gray-200 hover:shadow-sm transition">
          <div className="flex justify-between items-start mb-6">
            <div className="w-12 h-12 bg-[#eef3f0] rounded-xl flex items-center justify-center">
              <img src={AnggotaIcon} className="w-14 h-14" />
            </div>
            <span className="text-[11px] bg-[#eef3f0] text-[#1f7a4d] px-2 py-[2px] rounded-full">
              +12%
            </span>
          </div>
          <h3 className="text-2xl font-semibold text-gray-900 tracking-tight">
            2,847
          </h3>
          <p className="text-sm text-gray-400 mt-1">
            Total Anggota
          </p>
        </div>

        {/* CARD 2 */}
        <div className="bg-white/30 backdrop-blur-lg rounded-2xl p-6 border border-gray-200 hover:shadow-sm transition">
          <div className="flex justify-between items-start mb-6">
            <div className="w-12 h-12 bg-[#eef3f0] rounded-xl flex items-center justify-center">
              <img src={PacIcon} className="w-14 h-14" />
            </div>
            <span className="text-[11px] bg-[#eef3f0] text-[#1f7a4d] px-2 py-[2px] rounded-full">
              +3
            </span>
          </div>
          <h3 className="text-2xl font-semibold text-gray-900 tracking-tight">
            47
          </h3>
          <p className="text-sm text-gray-400 mt-1">
            PAC Aktif
          </p>
        </div>

        {/* CARD 3 */}
        <div className="bg-white/30 backdrop-blur-lg rounded-2xl p-6 border border-gray-200 hover:shadow-sm transition">
          <div className="flex justify-between items-start mb-6">
            <div className="w-12 h-12 bg-[#eef3f0] rounded-xl flex items-center justify-center">
              <img src={PertumbuhanIcon} className="w-14 h-14" />
            </div>
            <span className="text-[11px] bg-[#eef3f0] text-[#1f7a4d] px-2 py-[2px] rounded-full">
              +8
            </span>
          </div>
          <h3 className="text-2xl font-semibold text-gray-900 tracking-tight">
            156
          </h3>
          <p className="text-sm text-gray-400 mt-1">
            SK Aktif
          </p>
        </div>

        {/* CARD 4 */}
        <div className="bg-white/30 backdrop-blur-lg rounded-2xl p-6 border border-gray-200 hover:shadow-sm transition">
          <div className="flex justify-between items-start mb-6">
            <div className="w-12 h-12 bg-[#eef3f0] rounded-xl flex items-center justify-center">
              <img src={PacIcon} className="w-14 h-14" />
            </div>
            <span className="text-[11px] bg-[#eef3f0] text-[#1f7a4d] px-2 py-[2px] rounded-full">
              100%
            </span>
          </div>
          <h3 className="text-2xl font-semibold text-gray-900 tracking-tight">
            15
          </h3>
          <p className="text-sm text-gray-400 mt-1">
            Total Kecamatan
          </p>
        </div>

        {/* CARD 5 */}
        <div className="bg-white/30 backdrop-blur-lg rounded-2xl p-6 border border-gray-200 hover:shadow-sm transition">
          <div className="flex justify-between items-start mb-6">
            <div className="w-12 h-12 bg-[#eef3f0] rounded-xl flex items-center justify-center">
              <img src={PertumbuhanIcon} className="w-14 h-14" />
            </div>
            <span className="text-[11px] bg-[#eef3f0] text-[#1f7a4d] px-2 py-[2px] rounded-full">
              Tahun 2026
            </span>
          </div>
          <h3 className="text-2xl font-semibold text-gray-900 tracking-tight">
            +24%
          </h3>
          <p className="text-sm text-gray-400 mt-1">
            Pertumbuhan Kader
          </p>
        </div>

        {/* CARD 6 */}
        <div className="bg-white/30 backdrop-blur-lg rounded-2xl p-6 border border-gray-200 hover:shadow-sm transition">
          <div className="flex justify-between items-start mb-6">
            <div className="w-12 h-12 bg-[#eef3f0] rounded-xl flex items-center justify-center">
              <img src={VerifikasiIcon} className="w-14 h-14" />
            </div>
            <span className="text-[11px] bg-[#eef3f0] text-[#1f7a4d] px-2 py-[2px] rounded-full">
              93%
            </span>
          </div>
          <h3 className="text-2xl font-semibold text-gray-900 tracking-tight">
            2,654
          </h3>
          <p className="text-sm text-gray-400 mt-1">
            Anggota Terverifikasi
          </p>
        </div>

      </div>
    </section>
  );
}

export default Stats;