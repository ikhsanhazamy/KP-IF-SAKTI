import { TrendingUp, UserCheck, MapPin } from "lucide-react";
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

  return (
    <section className="bg-[#f6f8f7] px-4 sm:px-8 lg:px-20 py-8 sm:py-12">
      <div className="max-w-[1215px] mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

        {/* CARD 1: PAC Aktif / Pertumbuhan */}
        <div className="bg-white rounded-[24px] p-8 border border-gray-150 shadow-xs hover:shadow-md transition duration-300 flex flex-col justify-between min-h-[190px]">
          <div className="flex justify-between items-center mb-6">
            <div className="w-12 h-12 bg-[#E6F3EC] text-[#0F5E3A] rounded-xl flex items-center justify-center">
              {stats ? <MapPin className="w-6 h-6" /> : <TrendingUp className="w-6 h-6" />}
            </div>
            <span className="text-xs bg-[#E6F3EC] text-[#0F5E3A] px-3 py-1 rounded-full font-semibold">
              {stats ? `${stats.total_kecamatan} Kecamatan` : "Tahun 2026"}
            </span>
          </div>
          <div>
            <h3 className="text-4xl sm:text-5xl font-black text-gray-900 tracking-tight">
              {loading ? (
                <span className="inline-block w-24 h-8 bg-gray-200 animate-pulse rounded"></span>
              ) : stats ? (
                `${stats.pac_aktif} PAC`
              ) : (
                "+24%"
              )}
            </h3>
            <p className="text-sm text-gray-500 font-semibold mt-1">
              {stats ? "Pimpinan Anak Cabang Aktif" : "Pertumbuhan Kader"}
            </p>
          </div>
        </div>

        {/* CARD 2: Anggota Terverifikasi */}
        <div className="bg-white rounded-[24px] p-8 border border-gray-150 shadow-xs hover:shadow-md transition duration-300 flex flex-col justify-between min-h-[190px]">
          <div className="flex justify-between items-center mb-6">
            <div className="w-12 h-12 bg-[#E6F3EC] text-[#0F5E3A] rounded-xl flex items-center justify-center">
              <UserCheck className="w-6 h-6" />
            </div>
            <span className="text-xs bg-[#E6F3EC] text-[#0F5E3A] px-3 py-1 rounded-full font-semibold">
              {stats ? "100% Terdata" : "93%"}
            </span>
          </div>
          <div>
            <h3 className="text-4xl sm:text-5xl font-black text-gray-900 tracking-tight">
              {loading ? (
                <span className="inline-block w-24 h-8 bg-gray-200 animate-pulse rounded"></span>
              ) : stats ? (
                stats.total_anggota.toLocaleString("id-ID")
              ) : (
                "2,654"
              )}
            </h3>
            <p className="text-sm text-gray-500 font-semibold mt-1">
              Anggota Terverifikasi
            </p>
          </div>
        </div>

      </div>
    </section>
  );
}

export default Stats;