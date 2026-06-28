import { useState, useEffect } from "react";
import PacIcon from "../assets/icons/pac.svg";
import AnggotaIcon from "../assets/icons/anggota.svg";
import PertumbuhanIcon from "../assets/icons/pertumbuhan.svg";
import Location from "../assets/icons/Location.svg";
import { PopupExample } from "./PopupExample";

function MapSection() {
  const [stats, setStats] = useState({
    total_pac: 7,
    pac_aktif: 6,
    total_anggota: 9,
    total_kecamatan: 7
  });

  useEffect(() => {
    fetch("/api/stats")
      .then((res) => {
        if (!res.ok) throw new Error("Gagal mengambil statistik");
        return res.json();
      })
      .then((data) => {
        setStats(data);
      })
      .catch((err) => {
        console.error(err);
        // Fallback tetap menggunakan default state
      });
  }, []);

  return (
    <section className="bg-[#DDEEE34D] px-4 sm:px-8 lg:px-20 py-12 sm:py-16 lg:py-20">

      {/* HEADER */}
      <div className="text-center mb-10 sm:mb-12">
        <div className="inline-flex items-center gap-2 bg-[#eef3f0] text-[#1f7a4d] px-4 py-1 rounded-full text-sm">
          Pemetaan Interaktif
        </div>

        <h2 className="text-2xl sm:text-3xl font-semibold mt-4 text-gray-900">
          Pemetaan PAC Sukabumi
        </h2>

        <p className="text-gray-500 mt-2 text-sm sm:text-base">
          Visualisasi sebaran Pimpinan Anak Cabang (PAC) Fatayat NU di seluruh wilayah Sukabumi
        </p>
      </div>

      {/* GRID */}
      <div className="flex flex-col lg:grid lg:grid-cols-3 gap-6 items-start">

        {/* LEFT (MAP) */}
        <div className="lg:col-span-2 bg-white rounded-2xl p-4 sm:p-6 border border-gray-200 shadow-sm">

          {/* TITLE */}
          <div className="flex justify-between items-center mb-4">
            <h3 className="font-semibold text-gray-800">
              Peta Sebaran PAC
            </h3>

            <div className="flex items-center gap-4 text-xs text-gray-400">
              <span className="flex items-center gap-1">
                <div className="w-2 h-2 bg-green-500 rounded-full"></div>
                Aktif
              </span>
              <span className="flex items-center gap-1">
                <div className="w-2 h-2 bg-gray-300 rounded-full"></div>
                Tidak Aktif
              </span>
            </div>
          </div>

          {/* MAP AREA */}
          <div className="h-[350px] sm:h-[500px] lg:h-[700px] bg-[#eef3f0] rounded-xl flex items-center justify-center text-gray-400 overflow-hidden">
            <PopupExample />
          </div>

          {/* FOOTER */}
          <div className="mt-4 bg-[#f3f5f4] text-sm text-gray-400 p-3 rounded-lg text-center">
            Klik pada titik untuk melihat detail informasi PAC di setiap kecamatan
          </div>

        </div>

        {/* RIGHT — stats cards, horizontal scroll di mobile */}
        <div className="flex flex-row lg:flex-col gap-4 overflow-x-auto lg:overflow-x-visible pb-2 lg:pb-0">

          {/* CARD BESAR */}
          <div className="bg-white rounded-xl p-5 border border-gray-200 min-w-[150px] lg:min-w-0 lg:h-[170px] flex flex-col justify-between flex-shrink-0">
            <div className="w-10 h-10 bg-[#eef3f0] rounded-lg flex items-center justify-center">
              <img src={PacIcon} className="w-14 h-14" />
            </div>
            <div>
              <p className="text-2xl font-semibold text-gray-900">{stats.total_pac}</p>
              <p className="text-sm text-gray-400">Total PAC</p>
            </div>
          </div>

          {/* CARD */}
          <div className="bg-white rounded-xl p-5 border border-gray-200 min-w-[150px] lg:min-w-0 lg:h-[170px] flex flex-col justify-between flex-shrink-0">
            <div className="w-10 h-10 bg-[#eef3f0] rounded-lg flex items-center justify-center">
              <img src={PertumbuhanIcon} className="w-14 h-14" />
            </div>
            <div>
              <p className="text-xl font-semibold text-gray-900">{stats.pac_aktif}</p>
              <p className="text-sm text-gray-400">PAC Aktif</p>
            </div>
          </div>

          <div className="bg-white rounded-xl p-5 border border-gray-200 min-w-[150px] lg:min-w-0 lg:h-[170px] flex flex-col justify-between flex-shrink-0">
            <div className="w-10 h-10 bg-[#eef3f0] rounded-lg flex items-center justify-center">
              <img src={AnggotaIcon} className="w-14 h-14" />
            </div>
            <div>
              <p className="text-xl font-semibold text-gray-900">{stats.total_anggota.toLocaleString()}</p>
              <p className="text-sm text-gray-400">Total Anggota</p>
            </div>
          </div>

          <div className="bg-white rounded-xl p-5 border border-gray-200 min-w-[150px] lg:min-w-0 lg:h-[170px] flex flex-col justify-between flex-shrink-0">
            <div className="w-10 h-10 bg-[#eef3f0] rounded-lg flex items-center justify-center">
              <img src={Location} className="w-14 h-14" />
            </div>
            <div>
              <p className="text-xl font-semibold text-gray-900">{stats.total_kecamatan}</p>
              <p className="text-sm text-gray-400">Kecamatan</p>
            </div>
          </div>

          {/* GREEN CARD */}
          <div className="bg-[#1f7a4d] text-white rounded-xl p-5 min-w-[200px] lg:min-w-0 lg:h-[106px] flex flex-col justify-center flex-shrink-0">
            <p className="font-semibold">Jangkauan Wilayah</p>
            <p className="text-xs mt-1 text-green-100">
              Fatayat NU Sukabumi hadir di {stats.total_kecamatan} kecamatan dengan {stats.pac_aktif} PAC aktif melayani ribuan anggota.
            </p>
          </div>

        </div>

      </div>
    </section>
  );
}

export default MapSection;