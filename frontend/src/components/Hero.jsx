import image1 from "../assets/images/image1.jpeg";
import { ArrowRight, TrendingUp } from "lucide-react";
import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

function Hero() {
  const navigate = useNavigate();
  const [stats, setStats] = useState(null);

  useEffect(() => {
    fetch("/api/stats")
      .then((res) => {
        if (!res.ok) throw new Error("Gagal mengambil statistik");
        return res.json();
      })
      .then((data) => setStats(data))
      .catch((err) => {
        console.error(err);
        setStats({
          anggota_aktif: 0,
          pac_aktif: 0,
          total_kecamatan: 0,
          kepuasan: 0,
        });
      });
  }, []);

  const formatNumber = (value) => Number(value ?? 0).toLocaleString("id-ID");

  const heroStats = [
    {
      value: formatNumber(stats?.anggota_aktif ?? stats?.total_anggota),
      label: "Anggota Aktif",
    },
    {
      value: formatNumber(stats?.pac_aktif),
      label: "PAC Aktif",
    },
    {
      value: formatNumber(stats?.total_kecamatan),
      label: "Kecamatan",
    },
    {
      value: `${formatNumber(stats?.kepuasan)}%`,
      label: "Kepuasan",
    },
  ];

  return (
    <section className="bg-gradient-to-b from-[#f6f8f7] to-white py-12 sm:py-16 lg:py-20 border-b border-gray-100">
      <div className="section-container flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-12">

        {/* LEFT - CONTENT */}
        <div className="max-w-2xl w-full text-center lg:text-left flex flex-col justify-center">

          {/* BADGE */}
          <div className="flex items-center justify-center lg:justify-start">
            <div className="inline-flex items-center gap-2 bg-[#0F5E3A]/10 border border-[#0F5E3A]/20 text-[#0F5E3A] px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold shadow-xs">
              <span className="w-2 h-2 bg-[#0F5E3A] rounded-full"></span>
              Platform Digital Resmi Fatayat NU Kabupaten Sukabumi
            </div>
          </div>

          {/* H1 TITLE */}
          <h1 className="text-3xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.15] mt-6 text-gray-900 tracking-tight">
            Memberdayakan{" "}
            <span className="text-[#0F5E3A]">Perempuan</span>{" "}
            <br className="hidden sm:inline" />
            Melalui Organisasi Digital
          </h1>

          {/* SUBTITLE */}
          <p className="text-gray-600 mt-6 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
            Sistem terpadu untuk pengelolaan data anggota, pemetaan PAC (Pimpinan Anak Cabang), 
            statistik keanggotaan, serta digitalisasi administrasi Fatayat NU Kabupaten Sukabumi.
          </p>

          {/* CTA BUTTONS */}
          <div className="flex flex-wrap gap-4 mt-8 justify-center lg:justify-start">
            <button
              onClick={() => navigate("/pengajuan-data-pac")}
              className="bg-[#0F5E3A] text-white px-7 py-3.5 rounded-xl font-bold hover:bg-[#0D4E30] transition-all duration-200 flex items-center gap-2.5 shadow-md hover:shadow-lg cursor-pointer transform hover:-translate-y-0.5"
            >
              Mulai Sekarang
              <ArrowRight className="w-5 h-5" />
            </button>
            <button
              onClick={() => navigate("/tentang")}
              className="bg-white border border-gray-300 text-gray-800 px-6 py-3.5 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition shadow-xs cursor-pointer"
            >
              Pelajari Lebih Lanjut
            </button>
          </div>

          {/* STATS HIGHLIGHT */}
          <div className="grid grid-cols-2 sm:grid-cols-4 gap-6 sm:gap-8 mt-12 pt-8 border-t border-gray-200/70 justify-items-center sm:justify-items-start">
            {heroStats.map((item) => (
              <div className="text-center lg:text-left" key={item.label}>
                <div className="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#0F5E3A] tracking-tight min-h-[36px]">
                  {stats ? (
                    item.value
                  ) : (
                    <span className="inline-block w-16 h-8 bg-gray-200 animate-pulse rounded-md"></span>
                  )}
                </div>
                <p className="text-xs sm:text-sm text-gray-500 font-semibold mt-1">
                  {item.label}
                </p>
              </div>
            ))}
          </div>

        </div>

        {/* RIGHT - HERO IMAGE & FLOAT CARD */}
        <div className="relative w-full max-w-[480px] lg:max-w-[520px] mx-auto lg:mx-0 flex-shrink-0 mt-4 lg:mt-0">

          <div className="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
            <img
              src={image1}
              alt="Fatayat NU Sukabumi"
              className="w-full h-[340px] sm:h-[420px] lg:h-[480px] object-cover hover:scale-105 transition duration-500"
            />
            <div className="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
          </div>

          {/* FLOATING BADGE */}
          <div className="absolute -bottom-6 -left-4 sm:-left-6 bg-white/95 backdrop-blur-md p-4 sm:p-5 rounded-2xl shadow-xl border border-gray-100 flex items-center gap-4 z-10 hover:scale-105 transition duration-300">
            <div className="w-12 h-12 bg-[#0F5E3A]/10 text-[#0F5E3A] rounded-xl flex items-center justify-center shadow-xs">
              <TrendingUp className="w-6 h-6" />
            </div>
            <div>
              <div className="flex items-center gap-2">
                <span className="text-xl sm:text-2xl font-bold text-gray-900">+24%</span>
                <span className="bg-[#0F5E3A]/10 text-[#0F5E3A] text-[10px] font-bold px-2 py-0.5 rounded-md">Aktif</span>
              </div>
              <p className="text-xs text-gray-500 font-medium mt-0.5">
                Pertumbuhan Kader 2026
              </p>
            </div>
          </div>

        </div>

      </div>

    </section>
  );
}

export default Hero;
