import { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { Calendar, Users, ArrowRight } from "lucide-react";

import foto1 from "../assets/images/foto1.jpg";
import foto2 from "../assets/images/foto2.jpg";
import foto3 from "../assets/images/foto3.jpg";

function KegiatanSection() {
  const navigate = useNavigate();

  const formatTanggal = (tanggal) => {
    return new Date(tanggal).toLocaleDateString('id-ID', {
      day: 'numeric', month: 'long', year: 'numeric'
    });
  };

  const mockData = [
    {
      id: 1,
      title: "Seminar Pemberdayaan Perempuan dan Kewirausahaan",
      date: "15 Mei 2026",
      peserta: "150 peserta",
      img: foto1,
      tag: "Seminar"
    },
    {
      id: 2,
      title: "Bakti Sosial dan Santunan Anak Yatim",
      date: "8 Mei 2026",
      peserta: "85 peserta",
      img: foto2,
      tag: "Sosial"
    },
    {
      id: 3,
      title: "Pelatihan Kaderisasi dan Leadership",
      date: "1 Mei 2026",
      peserta: "120 peserta",
      img: foto3,
      tag: "Pelatihan"
    },
    {
      id: 4,
      title: "Rapat Koordinasi PAC Se-Sukabumi",
      date: "22 April 2026",
      peserta: "95 peserta",
      img: foto3,
      tag: "Rapat"
    },
    {
      id: 5,
      title: "Workshop Manajemen Organisasi Modern",
      date: "10 April 2026",
      peserta: "75 peserta",
      img: foto1,
      tag: "Workshop"
    },
    {
      id: 6,
      title: "Kajian Rutin Keislaman dan Keputrian",
      date: "3 April 2026",
      peserta: "200 peserta",
      img: foto2,
      tag: "Kajian"
    }
  ];

  const [data, setData] = useState(mockData);

  useEffect(() => {
    fetch("/api/kegiatan")
      .then((res) => {
        if (!res.ok) throw new Error("Gagal mengambil data kegiatan");
        return res.json();
      })
      .then((apiData) => {
        const formatted = apiData.slice(0, 6).map((item) => ({
          id: item.id,
          title: item.judul,
          date: formatTanggal(item.tanggal),
          peserta: `${item.peserta} peserta`,
          img: item.gambar_url || (item.kategori === "Seminar" ? foto1 : item.kategori === "Sosial" ? foto2 : foto3),
          tag: item.kategori
        }));
        setData(formatted);
      })
      .catch((err) => {
        console.error(err);
      });
  }, []);

  return (
    <section className="bg-[#f6f8f7] py-16 sm:py-20 border-t border-gray-100">
      <div className="section-container">

        {/* HEADER */}
        <div className="text-center mb-12">
          <div className="inline-flex items-center gap-2 bg-[#0F5E3A]/8 border border-[#0F5E3A]/20 text-[#0F5E3A] px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold shadow-xs">
            Berita & Program Kerja
          </div>

          <h2 className="text-3xl sm:text-4xl font-extrabold mt-4 text-gray-900 tracking-tight">
            Kegiatan & Dokumentasi
          </h2>

          <p className="text-gray-600 mt-3 max-w-xl mx-auto text-sm sm:text-base leading-relaxed">
            Kumpulan kegiatan terbaru, program pemberdayaan, dan dokumentasi aktivitas keorganisasian Fatayat NU Sukabumi.
          </p>
        </div>

        {/* GRID */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
          {data.map((item, i) => (
            <div
              key={item.id || i}
              onClick={() => item.id && navigate(`/kegiatan/${item.id}`)}
              className={`bg-white rounded-3xl overflow-hidden border border-gray-200/80 shadow-xs hover:shadow-xl transition-all duration-300 ${
                item.id ? 'cursor-pointer hover:-translate-y-1.5 hover:border-[#0F5E3A]/30' : ''
              } flex flex-col justify-between group`}
            >

              {/* IMAGE */}
              <div className="relative h-[210px] overflow-hidden bg-gray-100">
                <img
                  src={item.img}
                  className="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                  alt={item.title}
                />

                <div className="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent pointer-events-none" />

                {/* TAG */}
                {item.tag && (
                  <span className="absolute top-4 left-4 bg-white/95 backdrop-blur-md text-[#0F5E3A] text-xs font-bold px-3.5 py-1.5 rounded-full shadow-md">
                    {item.tag}
                  </span>
                )}
              </div>

              {/* CONTENT */}
              <div className="p-6 flex flex-col justify-between flex-1">
                <div>
                  <h3 className="font-bold text-gray-900 text-base sm:text-lg leading-snug tracking-tight group-hover:text-[#0F5E3A] transition duration-200 line-clamp-2">
                    {item.title}
                  </h3>

                  {/* META */}
                  <div className="mt-4 text-xs sm:text-sm font-medium text-gray-600 space-y-2">
                    <p className="flex items-center gap-2">
                      <Calendar className="w-4 h-4 text-[#0F5E3A] flex-shrink-0" />
                      {item.date}
                    </p>
                    <p className="flex items-center gap-2">
                      <Users className="w-4 h-4 text-[#0F5E3A] flex-shrink-0" />
                      {item.peserta}
                    </p>
                  </div>
                </div>

                {/* BUTTON */}
                <div className="mt-6 pt-4 border-t border-gray-100">
                  <span className="w-full py-2.5 px-4 border border-gray-200 rounded-xl text-sm font-semibold group-hover:bg-[#0F5E3A] group-hover:text-white group-hover:border-[#0F5E3A] transition duration-200 flex items-center justify-center gap-2 text-gray-700">
                    Selengkapnya
                    <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition" />
                  </span>
                </div>

              </div>

            </div>
          ))}
        </div>

        {/* BUTTON BAWAH */}
        <div className="flex justify-center mt-12">
          <Link
            to="/kegiatan"
            className="bg-[#0F5E3A] text-white px-8 py-3.5 rounded-xl font-bold shadow-md hover:bg-[#0D4E30] transition duration-200 flex items-center gap-2.5 transform hover:-translate-y-0.5"
          >
            Lihat Semua Kegiatan
            <ArrowRight className="w-5 h-5" />
          </Link>
        </div>

      </div>
    </section>
  );
}

export default KegiatanSection;