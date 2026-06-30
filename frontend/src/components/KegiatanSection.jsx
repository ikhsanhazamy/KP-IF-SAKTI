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
          img: item.kategori === "Seminar" ? foto1 : item.kategori === "Sosial" ? foto2 : foto3,
          tag: item.kategori
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
          Berita & Kegiatan
        </div>

        <h2 className="text-3xl font-bold mt-4 text-gray-900 tracking-tight">
          Kegiatan & Dokumentasi
        </h2>

        <p className="text-gray-500 mt-2 max-w-xl mx-auto text-sm sm:text-base leading-relaxed">
          Update terbaru mengenai kegiatan, program, dan aktivitas organisasi Fatayat NU Sukabumi
        </p>
      </div>

      {/* GRID */}
      <div className="max-w-[1215px] mx-auto">
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

          {data.map((item, i) => (
            <div
              key={item.id || i}
              onClick={() => item.id && navigate(`/kegiatan/${item.id}`)}
              className={`bg-white rounded-[24px] overflow-hidden border border-gray-150 shadow-xs hover:shadow-md transition duration-300 ${item.id ? 'cursor-pointer hover:-translate-y-1' : ''} flex flex-col justify-between`}
            >

              {/* IMAGE */}
              <div className="relative h-[200px] overflow-hidden">
                <img
                  src={item.img}
                  className="w-full h-full object-cover hover:scale-105 transition duration-500"
                  alt={item.title}
                />

                {/* OVERLAY HIJAU */}
                <div className="absolute inset-0 bg-gradient-to-t from-green-950/30 to-transparent pointer-events-none" />

                {/* TAG */}
                {item.tag && (
                  <span className="absolute top-4 left-4 bg-white/95 backdrop-blur-xs text-[#0F5E3A] text-xs font-bold px-3.5 py-1.5 rounded-full shadow-xs">
                    {item.tag}
                  </span>
                )}
              </div>

              {/* CONTENT */}
              <div className="p-6 flex flex-col justify-between flex-1">
                <div>
                  <h3 className="font-bold text-gray-900 text-base leading-snug tracking-tight hover:text-[#0F5E3A] transition duration-200">
                    {item.title}
                  </h3>

                  {/* META */}
                  <div className="mt-4 text-xs font-semibold text-gray-400 space-y-2">
                    <p className="flex items-center gap-2">
                      <Calendar className="w-4 h-4 text-gray-300 flex-shrink-0" />
                      {item.date}
                    </p>
                    <p className="flex items-center gap-2">
                      <Users className="w-4 h-4 text-gray-300 flex-shrink-0" />
                      {item.peserta}
                    </p>
                  </div>
                </div>

                {/* BUTTON */}
                <div className="mt-6">
                  {item.id ? (
                    <Link
                      to={`/kegiatan/${item.id}`}
                      onClick={(e) => e.stopPropagation()}
                      className="w-full h-[40px] border border-gray-200 rounded-xl text-sm font-semibold hover:bg-[#0F5E3A] hover:text-white hover:border-[#0F5E3A] transition duration-200 flex items-center justify-center gap-1.5 text-gray-700 shadow-2xs cursor-pointer"
                    >
                      Selengkapnya
                      <ArrowRight className="w-4 h-4" />
                    </Link>
                  ) : (
                    <button className="w-full h-[40px] border border-gray-200 rounded-xl text-sm font-semibold hover:bg-[#0F5E3A] hover:text-white hover:border-[#0F5E3A] transition duration-200 flex items-center justify-center gap-1.5 text-gray-700 shadow-2xs cursor-pointer">
                      Selengkapnya
                      <ArrowRight className="w-4 h-4" />
                    </button>
                  )}
                </div>

              </div>

            </div>
          ))}

        </div>
      </div>

      {/* BUTTON BAWAH */}
      <div className="flex justify-center mt-12">
        <Link
          to="/kegiatan"
          className="bg-[#0F5E3A] text-white px-7 py-3.5 rounded-xl font-bold shadow-md hover:bg-[#126A42] transition cursor-pointer flex items-center gap-2"
        >
          Lihat Semua Kegiatan
        </Link>
      </div>

    </section>
  );
}

export default KegiatanSection;