import { UserCheck, MapPin } from "lucide-react";
import { useState, useEffect } from "react";

function Stats() {
  const [stats, setStats] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch("/api/stats")
      .then((res) => {
        if (!res.ok) throw new Error("Gagal mengambil stats");
        return res.json();
      })
      .then((data) => {
        setStats(data);
        setLoading(false);
      })
      .catch((err) => {
        console.error(err);
        setLoading(false);
      });
  }, []);

  const formatNumber = (value) => Number(value ?? 0).toLocaleString("id-ID");

  return (
    <section className="bg-[#f6f8f7] py-8 sm:py-12">
      <div className="section-container grid grid-cols-1 md:grid-cols-2 gap-6">

        {/* CARD 1: PAC Aktif / Kecamatan */}
        <div className="bg-white rounded-3xl p-7 sm:p-8 border border-gray-200/80 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between min-h-[190px] group hover:border-[#0F5E3A]/30">
          <div className="flex justify-between items-center mb-6">
            <div className="w-12 h-12 bg-[#0F5E3A]/10 text-[#0F5E3A] rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300">
              <MapPin className="w-6 h-6" />
            </div>
            <span className="text-xs bg-[#0F5E3A]/10 text-[#0F5E3A] px-3.5 py-1 rounded-full font-bold">
              {stats ? `${formatNumber(stats.total_kecamatan)} Kecamatan` : "Memuat..."}
            </span>
          </div>
          <div>
            <h3 className="text-4xl sm:text-5xl font-black text-gray-900 tracking-tight">
              {loading ? (
                <span className="inline-block w-24 h-8 bg-gray-200 animate-pulse rounded-md"></span>
              ) : stats ? (
                `${formatNumber(stats.pac_aktif)} PAC`
              ) : (
                "0 PAC"
              )}
            </h3>
            <p className="text-sm text-gray-600 font-semibold mt-1">
              Pimpinan Anak Cabang Aktif
            </p>
          </div>
        </div>

        {/* CARD 2: Anggota Aktif / Kepuasan */}
        <div className="bg-white rounded-3xl p-7 sm:p-8 border border-gray-200/80 shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between min-h-[190px] group hover:border-[#0F5E3A]/30">
          <div className="flex justify-between items-center mb-6">
            <div className="w-12 h-12 bg-[#0F5E3A]/10 text-[#0F5E3A] rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300">
              <UserCheck className="w-6 h-6 text-[#0F5E3A]" />
            </div>
            <span className="text-xs bg-[#0F5E3A]/10 text-[#0F5E3A] px-3.5 py-1 rounded-full font-bold">
              {stats ? `${formatNumber(stats.kepuasan)}% Kepuasan` : "Memuat..."}
            </span>
          </div>
          <div>
            <h3 className="text-4xl sm:text-5xl font-black text-gray-900 tracking-tight">
              {loading ? (
                <span className="inline-block w-24 h-8 bg-gray-200 animate-pulse rounded-md"></span>
              ) : stats ? (
                formatNumber(stats.anggota_aktif ?? stats.total_anggota)
              ) : (
                "0"
              )}
            </h3>
            <p className="text-sm text-gray-600 font-semibold mt-1">
              Total Anggota Terdaftar & Aktif
            </p>
          </div>
        </div>

      </div>
    </section>
  );
}

export default Stats;
