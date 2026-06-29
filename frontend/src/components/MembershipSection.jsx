import QrIcon from "../assets/icons/QR.svg";
import { Check, CreditCard, Briefcase, GraduationCap, BarChart2 } from "lucide-react";

function MembershipSection() {
  return (
    <section className="bg-[#f6f8f7] px-4 sm:px-8 lg:px-20 py-12 sm:py-16 lg:py-20">

      {/* HEADER */}
      <div className="text-center mb-12 lg:mb-16">
        <div className="inline-flex items-center gap-2 bg-white border border-[#0F5E3A]/10 text-[#0F5E3A] px-4 py-1.5 rounded-full text-sm font-semibold shadow-xs">
          Manajemen Anggota
        </div>

        <h2 className="text-3xl font-bold mt-4 text-gray-900 tracking-tight">
          Sistem Data Keanggotaan Digital
        </h2>

        <p className="text-gray-500 mt-2 max-w-xl mx-auto text-sm sm:text-base leading-relaxed">
          Platform terpadu untuk mengelola data anggota, profesi, pendidikan, dan administrasi organisasi
        </p>
      </div>

      {/* GRID */}
      <div className="max-w-[1215px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 sm:gap-12 items-center">

        {/* LEFT - KTA CARD */}
        <div className="relative flex justify-center">

          {/* BADGE */}
          <div className="absolute -top-5 right-4 sm:right-14 bg-white shadow-xl rounded-2xl px-4 py-2.5 flex items-center gap-2.5 z-10 border border-gray-50 hover:scale-105 transition duration-300">
            <div className="w-6 h-6 bg-[#E6F3EC] text-[#0F5E3A] flex items-center justify-center rounded-full text-sm font-bold shadow-xs">
              <Check className="w-3.5 h-3.5" />
            </div>
            <div>
              <p className="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">Status</p>
              <p className="text-xs sm:text-sm font-bold text-[#0F5E3A]">
                Terverifikasi
              </p>
            </div>
          </div>

          {/* CARD */}
          <div className="w-full max-w-[592px] h-[320px] sm:h-[360px] rounded-[28px] overflow-hidden relative shadow-2xl text-white hover:rotate-1 transition duration-500">

            {/* BASE GRADIENT */}
            <div className="absolute inset-0 bg-[linear-gradient(135deg,#0F5E3A_0%,#1B6A42_45%,#2A7F54_100%)]" />

            {/* SOFT LIGHT */}
            <div className="absolute inset-0 bg-[radial-gradient(circle_at_75%_25%,rgba(255,255,255,0.12),transparent_60%)]" />

            {/* CONTENT */}
            <div className="relative z-10 h-full px-6 sm:px-8 py-6 sm:py-7 flex flex-col justify-between">

              {/* TOP */}
              <div>
                <p className="text-xs sm:text-sm opacity-80 font-medium tracking-wide">Kartu Tanda Anggota</p>
                <h3 className="text-xl sm:text-2xl font-black mt-1 tracking-tight">FATAYAT NU</h3>
                <p className="text-xs sm:text-sm opacity-80 font-medium">Sukabumi</p>
              </div>

              {/* DATA */}
              <div className="space-y-4 text-left">

                {/* NAMA */}
                <div>
                  <p className="text-[10px] sm:text-xs opacity-75 font-semibold uppercase tracking-wider">Nama Lengkap</p>
                  <p className="text-base sm:text-lg font-bold tracking-wide mt-0.5">Siti Nurhaliza, S.Pd</p>
                </div>

                {/* GRID 2 KOLOM */}
                <div className="grid grid-cols-2 gap-y-3.5 text-xs sm:text-sm font-medium">
                  <div>
                    <p className="text-[10px] opacity-75 uppercase tracking-wider">No. Anggota</p>
                    <p className="font-bold text-sm mt-0.5">FN-SKB-2024-1234</p>
                  </div>
                  <div>
                    <p className="text-[10px] opacity-75 uppercase tracking-wider">PAC</p>
                    <p className="font-bold text-sm mt-0.5">Cibadak</p>
                  </div>
                  <div>
                    <p className="text-[10px] opacity-75 uppercase tracking-wider">Berlaku Hingga</p>
                    <p className="font-bold text-sm mt-0.5">31 Desember 2026</p>
                  </div>
                </div>

              </div>

              {/* QR */}
              <div className="absolute bottom-6 right-6 w-16 h-16 sm:w-20 sm:h-20 bg-white rounded-2xl flex items-center justify-center shadow-md">
                <img src={QrIcon} className="w-10 h-10 sm:w-12 sm:h-12" />
              </div>

              {/* RING EFFECT */}
              <div className="absolute bottom-0 right-0 w-36 h-36 border border-white/10 rounded-full" />
              <div className="absolute bottom-4 right-4 w-28 h-28 border border-white/10 rounded-full" />

            </div>
          </div>
        </div>

        {/* RIGHT - FITUR */}
        <div className="flex flex-col gap-4">

          {/* ITEM 1 */}
          <div className="bg-white rounded-[20px] p-5 border border-gray-150 flex gap-4 items-center min-h-[100px] shadow-xs hover:shadow-md transition duration-300">
            <div className="w-12 h-12 bg-[#E6F3EC] text-[#0F5E3A] rounded-xl flex items-center justify-center flex-shrink-0 shadow-xs">
              <CreditCard className="w-5 h-5" />
            </div>
            <div>
              <p className="font-bold text-gray-900">KTA Digital</p>
              <p className="text-sm text-gray-400 mt-1 font-medium leading-relaxed">
                Kartu Tanda Anggota digital dengan QR Code untuk verifikasi dan validasi keanggotaan
              </p>
            </div>
          </div>

          {/* ITEM 2 */}
          <div className="bg-white rounded-[20px] p-5 border border-gray-150 flex gap-4 items-center min-h-[100px] shadow-xs hover:shadow-md transition duration-300">
            <div className="w-12 h-12 bg-[#E6F3EC] text-[#0F5E3A] rounded-xl flex items-center justify-center flex-shrink-0 shadow-xs">
              <Briefcase className="w-5 h-5" />
            </div>
            <div>
              <p className="font-bold text-gray-900">Tracking Profesi</p>
              <p className="text-sm text-gray-400 mt-1 font-medium leading-relaxed">
                Pencatatan dan monitoring profesi anggota untuk pemetaan potensi dan pemberdayaan
              </p>
            </div>
          </div>

          {/* ITEM 3 */}
          <div className="bg-white rounded-[20px] p-5 border border-gray-150 flex gap-4 items-center min-h-[100px] shadow-xs hover:shadow-md transition duration-300">
            <div className="w-12 h-12 bg-[#E6F3EC] text-[#0F5E3A] rounded-xl flex items-center justify-center flex-shrink-0 shadow-xs">
              <GraduationCap className="w-5 h-5" />
            </div>
            <div>
              <p className="font-bold text-gray-900">Data Pendidikan</p>
              <p className="text-sm text-gray-400 mt-1 font-medium leading-relaxed">
                Dokumentasi riwayat pendidikan anggota untuk pengembangan kapasitas organisasi
              </p>
            </div>
          </div>

          {/* ITEM 4 */}
          <div className="bg-white rounded-[20px] p-5 border border-gray-150 flex gap-4 items-center min-h-[100px] shadow-xs hover:shadow-md transition duration-300">
            <div className="w-12 h-12 bg-[#E6F3EC] text-[#0F5E3A] rounded-xl flex items-center justify-center flex-shrink-0 shadow-xs">
              <BarChart2 className="w-5 h-5" />
            </div>
            <div>
              <p className="font-bold text-gray-900">Analitik Organisasi</p>
              <p className="text-sm text-gray-400 mt-1 font-medium leading-relaxed">
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