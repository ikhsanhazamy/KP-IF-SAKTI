import image1 from "../assets/images/image1.jpeg";
import { ArrowRight, TrendingUp } from "lucide-react";
import { useNavigate } from "react-router-dom";

function Hero() {
  const navigate = useNavigate();

  return (
    <section className="bg-[#f6f8f7] px-4 sm:px-8 lg:px-20 py-12 sm:py-16 lg:py-24 flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-8">

      {/* LEFT */}
      <div className="max-w-2xl w-full text-center lg:text-left flex flex-col justify-center">

        <div className="inline-flex items-center gap-2 bg-white border border-[#0F5E3A]/10 text-[#0F5E3A] px-4 py-1.5 rounded-full text-sm font-medium self-center lg:self-start shadow-xs">
          <div className="w-2 h-2 bg-[#0F5E3A] rounded-full"></div>
          Platform Manajemen Organisasi Modern
        </div>

        <h1 className="text-[40px] sm:text-[52px] lg:text-[56px] font-bold leading-[1.15] mt-6 text-gray-900 tracking-tight">
          Memberdayakan{" "}
          <span className="text-[#0F5E3A]">Perempuan</span> <br />
          Melalui Organisasi Digital
        </h1>

        <p className="text-gray-500 mt-6 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 leading-relaxed">
          Sistem manajemen terpadu untuk pengelolaan data anggota,
          pemetaan PAC, statistik organisasi, dan digitalisasi administrasi
          Fatayat NU Sukabumi.
        </p>

        {/* BUTTON */}
        <div className="flex flex-wrap gap-4 mt-8 justify-center lg:justify-start">
          <button
            onClick={() => navigate("/pengajuan-data-pac")}
            className="bg-[#0F5E3A] text-white px-6 py-3.5 rounded-xl font-semibold hover:bg-[#126A42] transition flex items-center gap-2 shadow-sm cursor-pointer"
          >
            Mulai Sekarang
            <ArrowRight className="w-5 h-5" />
          </button>
          <button
            onClick={() => navigate("/tentang")}
            className="bg-white border border-gray-200 text-gray-700 px-6 py-3.5 rounded-xl font-semibold hover:bg-gray-50 transition shadow-xs cursor-pointer"
          >
            Pelajari Lebih Lanjut
          </button>
        </div>

        {/* STATS */}
        <div className="grid grid-cols-2 sm:flex sm:flex-wrap gap-8 sm:gap-12 lg:gap-14 mt-14 justify-items-center sm:justify-center lg:justify-start">
          <div className="text-center lg:text-left">
            <h2 className="text-3xl lg:text-4xl font-extrabold text-[#0F5E3A] tracking-tight">2,847</h2>
            <p className="text-xs sm:text-sm text-gray-400 font-medium mt-1">Anggota Aktif</p>
          </div>
          <div className="text-center lg:text-left">
            <h2 className="text-3xl lg:text-4xl font-extrabold text-[#0F5E3A] tracking-tight">47</h2>
            <p className="text-xs sm:text-sm text-gray-400 font-medium mt-1">PAC Aktif</p>
          </div>
          <div className="text-center lg:text-left">
            <h2 className="text-3xl lg:text-4xl font-extrabold text-[#0F5E3A] tracking-tight">15</h2>
            <p className="text-xs sm:text-sm text-gray-400 font-medium mt-1">Kecamatan</p>
          </div>
          <div className="text-center lg:text-left">
            <h2 className="text-3xl lg:text-4xl font-extrabold text-[#0F5E3A] tracking-tight">98%</h2>
            <p className="text-xs sm:text-sm text-gray-400 font-medium mt-1">Kepuasan</p>
          </div>
        </div>

      </div>

      {/* RIGHT */}
      <div className="relative w-full max-w-[520px] mx-auto lg:mx-0 flex-shrink-0 mt-8 lg:mt-0">

        <img
          src={image1}
          alt="hero"
          className="w-full h-[320px] sm:h-[400px] lg:h-[460px] object-cover rounded-[32px] shadow-xl border border-white/50"
        />

        {/* FLOAT CARD */}
        <div className="absolute -bottom-6 -left-6 bg-white p-5 rounded-2xl shadow-xl border border-gray-100 flex items-center gap-4 z-10 hover:scale-105 transition duration-300">
          {/* ICON */}
          <div className="w-12 h-12 bg-[#E6F3EC] text-[#0F5E3A] rounded-xl flex items-center justify-center shadow-xs">
            <TrendingUp className="w-6 h-6" />
          </div>

          {/* TEXT */}
          <div>
            <p className="text-2xl font-bold text-gray-900">+24%</p>
            <p className="text-xs text-gray-400 font-semibold mt-0.5">
              Pertumbuhan Kader 2026
            </p>
          </div>
        </div>

      </div>

    </section>
  );
}

export default Hero;