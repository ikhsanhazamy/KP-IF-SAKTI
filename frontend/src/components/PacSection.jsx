import { useState, useEffect } from "react";
import { Users, Calendar, TrendingUp, TrendingDown, MapPin } from "lucide-react";
import { Link, useNavigate } from "react-router-dom";

function PacSection() {
  const navigate = useNavigate();
  const mockData = [
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

  const [data, setData] = useState(mockData);

  useEffect(() => {
    fetch("/api/pac")
      .then((res) => {
        if (!res.ok) throw new Error("Gagal mengambil data PAC");
        return res.json();
      })
      .then((apiData) => {
        const formatted = apiData.slice(0, 6).map((item) => ({
          name: item.nama_pac,
          kec: `Kecamatan ${item.kecamatan}`,
          anggota: item.jumlah_anggota ?? 0,
          kegiatan: item.total_kegiatan ?? 0,
          growth: "+0%",
          aktif: item.status?.toLowerCase() === "aktif"
        }));
        setData(formatted);
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
          Informasi PAC
        </div>

        <h2 className="text-3xl font-bold mt-4 text-gray-900 tracking-tight">
          Daftar Pimpinan Anak Cabang
        </h2>

        <p className="text-gray-500 mt-2 max-w-xl mx-auto text-sm sm:text-base leading-relaxed">
          Informasi lengkap mengenai PAC Fatayat NU di seluruh wilayah Kabupaten Sukabumi
        </p>
      </div>

      {/* GRID WRAPPER */}
      <div className="max-w-[1215px] mx-auto">

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

          {data.map((item, i) => (
            <div
              key={i}
              className="bg-white rounded-[24px] p-6 border border-gray-150 flex flex-col justify-between shadow-xs hover:shadow-md transition duration-300"
            >

              {/* HEADER CARD */}
              <div className="flex justify-between items-start gap-4">
                <div>
                  <h3 className="font-bold text-gray-900 text-lg tracking-tight">
                    {item.name}
                  </h3>
                  <p className="text-xs text-gray-400 font-semibold mt-1 flex items-center gap-1">
                    <MapPin className="w-3.5 h-3.5 text-gray-300 flex-shrink-0" />
                    {item.kec}
                  </p>
                </div>

                <span
                  className={`text-xs px-3 py-1.5 rounded-full font-bold shadow-2xs ${
                    item.aktif
                      ? "bg-[#E6F3EC] text-[#0F5E3A]"
                      : "bg-gray-100 text-gray-500"
                  }`}
                >
                  {item.aktif ? "Aktif" : "Tidak Aktif"}
                </span>
              </div>

              {/* STATS */}
              <div className="flex justify-between mt-6 gap-3">

                {/* ANGGOTA BOX */}
                <div className="bg-[#f6f8f7] rounded-2xl flex-1 h-[90px] flex flex-col items-center justify-center border border-gray-100 hover:bg-white hover:border-gray-200 transition duration-200">
                  <Users className="w-4 h-4 text-[#0F5E3A] mb-1" />
                  <p className="text-base font-black text-gray-900 leading-none">{item.anggota}</p>
                  <p className="text-[10px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Anggota</p>
                </div>

                {/* KEGIATAN BOX */}
                <div className="bg-[#f6f8f7] rounded-2xl flex-1 h-[90px] flex flex-col items-center justify-center border border-gray-100 hover:bg-white hover:border-gray-200 transition duration-200">
                  <Calendar className="w-4 h-4 text-[#0F5E3A] mb-1" />
                  <p className="text-base font-black text-gray-900 leading-none">{item.kegiatan}</p>
                  <p className="text-[10px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Kegiatan</p>
                </div>

                {/* GROWTH BOX */}
                <div className="bg-[#f6f8f7] rounded-2xl flex-1 h-[90px] flex flex-col items-center justify-center border border-gray-100 hover:bg-white hover:border-gray-200 transition duration-200">
                  {item.growth.includes("-") ? (
                    <TrendingDown className="w-4 h-4 text-red-500 mb-1" />
                  ) : (
                    <TrendingUp className="w-4 h-4 text-green-600 mb-1" />
                  )}
                  <p
                    className={`text-base font-black leading-none ${
                      item.growth.includes("-")
                        ? "text-red-500"
                        : "text-green-600"
                    }`}
                  >
                    {item.growth}
                  </p>
                  <p className="text-[10px] text-gray-400 font-bold mt-1.5 uppercase tracking-wider">Growth</p>
                </div>

              </div>

              {/* BUTTON */}
              <button
                onClick={() => navigate(`/data-pac?search=${item.name.replace("PAC ", "")}`)}
                className="w-full h-[42px] border border-gray-200 rounded-xl text-sm font-semibold hover:bg-[#0F5E3A] hover:text-white hover:border-[#0F5E3A] transition mt-6 cursor-pointer text-gray-700 flex items-center justify-center shadow-2xs"
              >
                Lihat Detail
              </button>

            </div>
          ))}

        </div>

      </div>

      {/* BUTTON BAWAH */}
      <div className="flex justify-center mt-12">
        <Link
          to="/data-pac"
          className="bg-[#0F5E3A] text-white px-7 py-3.5 rounded-xl font-bold shadow-md hover:bg-[#126A42] transition cursor-pointer flex items-center justify-center"
        >
          Lihat Semua PAC
        </Link>
      </div>

    </section>
  );
}

export default PacSection;