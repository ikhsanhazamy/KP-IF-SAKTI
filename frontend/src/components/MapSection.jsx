import { useState, useEffect } from "react";
import { Building2, TrendingUp, Users, MapPin } from "lucide-react";
import { PopupExample } from "./PopupExample";

function MapSection() {
  const [stats, setStats] = useState({
    total_pac: 47,
    pac_aktif: 45,
    total_anggota: 2847,
    total_kecamatan: 15
  });

  useEffect(() => {
    fetch("/api/stats")
      .then((res) => {
        if (!res.ok) throw new Error("Gagal mengambil statistik");
        return res.json();
      })
      .then((data) => {
        setStats({
          total_pac: data.total_pac ?? 47,
          pac_aktif: data.pac_aktif ?? 45,
          total_anggota: data.total_anggota ?? 2847,
          total_kecamatan: data.total_kecamatan ?? 15
        });
      })
      .catch((err) => {
        console.error(err);
      });
  }, []);

  return (
    <section className="bg-[#f6f8f7] px-4 sm:px-8 lg:px-20 py-12 sm:py-16">

      {/* HEADER */}
      <div className="text-center mb-12">
        <div className="inline-flex items-center gap-2 bg-white border border-[#0F5E3A]/10 text-[#0F5E3A] px-4 py-1.5 rounded-full text-sm font-semibold shadow-xs">
          <MapPin className="w-4 h-4" />
          Pemetaan Interaktif
        </div>

        <h2 className="text-3xl font-bold mt-4 text-gray-900 tracking-tight">
          Pemetaan PAC Sukabumi
        </h2>

        <p className="text-gray-500 mt-2 max-w-xl mx-auto text-sm sm:text-base leading-relaxed">
          Visualisasi sebaran Pimpinan Anak Cabang (PAC) Fatayat NU di seluruh wilayah Sukabumi
        </p>
      </div>

      {/* GRID */}
      <div className="max-w-[1215px] mx-auto flex flex-col lg:grid lg:grid-cols-3 gap-6 items-stretch">

        {/* LEFT (MAP) */}
        <div className="lg:col-span-2 bg-white rounded-[24px] p-6 border border-gray-150 shadow-xs flex flex-col justify-between">

          {/* TITLE */}
          <div className="flex justify-between items-center mb-4">
            <h3 className="font-bold text-gray-900 text-lg">
              Peta Sebaran PAC
            </h3>

            <div className="flex items-center gap-4 text-xs font-semibold text-gray-500">
              <span className="flex items-center gap-1.5">
                <div className="w-2.5 h-2.5 bg-green-600 rounded-full"></div>
                Aktif
              </span>
              <span className="flex items-center gap-1.5">
                <div className="w-2.5 h-2.5 bg-gray-300 rounded-full"></div>
                Tidak Aktif
              </span>
            </div>
          </div>

          {/* MAP AREA */}
          <div className="h-[350px] sm:h-[450px] lg:h-[500px] bg-[#f6f8f7] rounded-2xl flex items-center justify-center text-gray-400 overflow-hidden border border-gray-100">
            <PopupExample />
          </div>

          {/* FOOTER */}
          <div className="mt-4 bg-[#f6f8f7] text-xs sm:text-sm text-gray-400 font-semibold p-3.5 rounded-xl text-center border border-gray-100/50">
            Klik pada titik untuk melihat detail informasi PAC di setiap kecamatan
          </div>

        </div>

        {/* RIGHT — stats cards */}
        <div className="flex flex-col gap-4 justify-between">

          {/* CARD 1 */}
          <div className="bg-white rounded-2xl p-5 border border-gray-150 shadow-xs flex flex-col justify-between h-[125px] hover:shadow-md transition duration-300">
            <div className="w-10 h-10 bg-[#E6F3EC] text-[#0F5E3A] rounded-xl flex items-center justify-center">
              <Building2 className="w-5 h-5" />
            </div>
            <div>
              <p className="text-2xl font-black text-gray-900 leading-none">{stats.total_pac}</p>
              <p className="text-xs text-gray-400 font-semibold mt-1">Total PAC</p>
            </div>
          </div>

          {/* CARD 2 */}
          <div className="bg-white rounded-2xl p-5 border border-gray-150 shadow-xs flex flex-col justify-between h-[125px] hover:shadow-md transition duration-300">
            <div className="w-10 h-10 bg-[#E6F3EC] text-[#0F5E3A] rounded-xl flex items-center justify-center">
              <TrendingUp className="w-5 h-5" />
            </div>
            <div>
              <p className="text-2xl font-black text-gray-900 leading-none">{stats.pac_aktif}</p>
              <p className="text-xs text-gray-400 font-semibold mt-1">PAC Aktif</p>
            </div>
          </div>

          {/* CARD 3 */}
          <div className="bg-white rounded-2xl p-5 border border-gray-150 shadow-xs flex flex-col justify-between h-[125px] hover:shadow-md transition duration-300">
            <div className="w-10 h-10 bg-[#E6F3EC] text-[#0F5E3A] rounded-xl flex items-center justify-center">
              <Users className="w-5 h-5" />
            </div>
            <div>
              <p className="text-2xl font-black text-gray-900 leading-none">{stats.total_anggota.toLocaleString()}</p>
              <p className="text-xs text-gray-400 font-semibold mt-1">Total Anggota</p>
            </div>
          </div>

          {/* GREEN CARD */}
          <div className="bg-[#0F5E3A] text-white rounded-2xl p-5 flex flex-col justify-center min-h-[110px] shadow-sm hover:brightness-105 transition duration-300">
            <p className="font-bold text-lg">Jangkauan Wilayah</p>
            <p className="text-xs mt-2 text-green-100 font-medium leading-relaxed">
              Fatayat NU Sukabumi hadir di {stats.total_kecamatan} kecamatan dengan {stats.pac_aktif} PAC aktif melayani ribuan anggota.
            </p>
          </div>

        </div>

      </div>
    </section>
  );
}

export default MapSection;