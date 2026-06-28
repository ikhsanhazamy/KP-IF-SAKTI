function PacSection() {
  const data = [
    {
      name: "PAC Cibadak",
      kec: "Kecamatan Cibadak",
      anggota: 247,
      kegiatan: 18,
      growth: "+12%",
      aktif: true
    },
    {
      name: "PAC Cicurug",
      kec: "Kecamatan Cicurug",
      anggota: 198,
      kegiatan: 15,
      growth: "+8%",
      aktif: true
    },
    {
      name: "PAC Parungkuda",
      kec: "Kecamatan Parungkuda",
      anggota: 156,
      kegiatan: 12,
      growth: "+15%",
      aktif: true
    },
    {
      name: "PAC Palabuhanratu",
      kec: "Kecamatan Palabuhanratu",
      anggota: 234,
      kegiatan: 20,
      growth: "+10%",
      aktif: true
    },
    {
      name: "PAC Simpenan",
      kec: "Kecamatan Simpenan",
      anggota: 89,
      kegiatan: 3,
      growth: "-2%",
      aktif: false
    },
    {
      name: "PAC Jampang Kulon",
      kec: "Kecamatan Jampang Kulon",
      anggota: 178,
      kegiatan: 14,
      growth: "+18%",
      aktif: true
    }
  ];

  return (
    <section className="bg-[#f6f8f7] px-20 py-20">

      {/* HEADER */}
      <div className="text-center mb-14">
        <div className="inline-flex items-center gap-2 bg-[#eef3f0] text-[#1f7a4d] px-4 py-1 rounded-full text-sm">
          Informasi PAC
        </div>

        <h2 className="text-3xl font-semibold mt-4 text-gray-900">
          Daftar Pimpinan Anak Cabang
        </h2>

        <p className="text-gray-500 mt-2 max-w-xl mx-auto">
          Informasi lengkap mengenai PAC Fatayat NU di seluruh wilayah Kabupaten Sukabumi
        </p>
      </div>

      {/* GRID WRAPPER (KUNCI PRESISI) */}
      <div className="max-w-[1215px] mx-auto">

        <div className="grid grid-cols-3 gap-6">

          {data.map((item, i) => (
            <div
              key={i}
              className="bg-white rounded-2xl p-6 border border-gray-200 w-[389px] h-[266px] flex flex-col justify-between shadow-sm hover:shadow-md transition"
            >

              {/* HEADER CARD */}
              <div className="flex justify-between items-start">
                <div>
                  <h3 className="font-semibold text-gray-900">
                    {item.name}
                  </h3>
                  <p className="text-sm text-gray-400">
                    {item.kec}
                  </p>
                </div>

                <span
                  className={`text-xs px-3 py-1 rounded-full ${
                    item.aktif
                      ? "bg-green-100 text-green-700"
                      : "bg-gray-200 text-gray-500"
                  }`}
                >
                  {item.aktif ? "Aktif" : "Tidak Aktif"}
                </span>
              </div>

              {/* STATS */}
              <div className="flex justify-between mt-4">

                <div className="bg-[#f3f5f4] rounded-xl w-[105px] h-[90px] flex flex-col items-center justify-center">
                  <p className="text-base font-semibold">{item.anggota}</p>
                  <p className="text-xs text-gray-400">Anggota</p>
                </div>

                <div className="bg-[#f3f5f4] rounded-xl w-[105px] h-[90px] flex flex-col items-center justify-center">
                  <p className="text-base font-semibold">{item.kegiatan}</p>
                  <p className="text-xs text-gray-400">Kegiatan</p>
                </div>

                <div className="bg-[#f3f5f4] rounded-xl w-[105px] h-[90px] flex flex-col items-center justify-center">
                  <p
                    className={`text-base font-semibold ${
                      item.growth.includes("-")
                        ? "text-red-500"
                        : "text-green-600"
                    }`}
                  >
                    {item.growth}
                  </p>
                  <p className="text-xs text-gray-400">Growth</p>
                </div>

              </div>

              {/* BUTTON */}
              <button className="w-full h-[42px] border border-gray-200 rounded-xl text-sm hover:bg-gray-50 transition">
                Lihat Detail
              </button>

            </div>
          ))}

        </div>

      </div>

      {/* BUTTON BAWAH */}
      <div className="flex justify-center mt-12">
        <button className="bg-[#1f7a4d] text-white px-6 py-3 rounded-xl shadow hover:bg-[#17633d] transition">
          Lihat Semua PAC
        </button>
      </div>

    </section>
  );
}

export default PacSection;