import Navbar from "../components/Navbar";
import Footer from "../components/Footer";

import foto1 from "../assets/images/foto1.jpg";
import foto2 from "../assets/images/foto2.jpg";
import foto3 from "../assets/images/foto3.jpg";

import { useState, useEffect } from "react";

function Kegiatan() {
  const categories = [
    "Semua",
    "Seminar",
    "Sosial",
    "Pelatihan",
    "Rapat",
    "Workshop",
    "Kajian"
  ];

  const mockKegiatan = [
    {
      title: "Seminar Pemberdayaan Perempuan dan Kewirausahaan",
      desc: "Seminar nasional tentang pemberdayaan perempuan melalui kewirausahaan dan UMKM.",
      date: "15 Mei 2026",
      peserta: "150 peserta",
      category: "Seminar",
      image: foto1
    },
    {
      title: "Bakti Sosial dan Santunan Anak Yatim",
      desc: "Kegiatan sosial rutin memberikan santunan dan bantuan kepada anak yatim di wilayah Sukabumi.",
      date: "8 Mei 2026",
      peserta: "85 peserta",
      category: "Sosial",
      image: foto2
    },
    {
      title: "Pelatihan Kaderisasi dan Leadership",
      desc: "Program pelatihan intensif untuk kader muda Fatayat NU dalam kepemimpinan dan manajemen.",
      date: "1 Mei 2026",
      peserta: "120 peserta",
      category: "Pelatihan",
      image: foto3
    },
    {
      title: "Rapat Koordinasi PAC Se-Sukabumi",
      desc: "Rapat koordinasi rutin seluruh pengurus PAC untuk evaluasi program dan perencanaan kegiatan.",
      date: "22 April 2026",
      peserta: "95 peserta",
      category: "Rapat",
      image: foto3
    },
    {
      title: "Workshop Manajemen Organisasi Modern",
      desc: "Workshop tentang manajemen organisasi modern dengan teknologi digital untuk efisiensi kerja.",
      date: "10 April 2026",
      peserta: "75 peserta",
      category: "Workshop",
      image: foto1
    },
    {
      title: "Kajian Rutin Keislaman dan Keputrian",
      desc: "Kajian rutin bulanan tentang keislaman dan keputrian dengan ustadzah berpengalaman.",
      date: "3 April 2026",
      peserta: "200 peserta",
      category: "Kajian",
      image: foto2
    }
  ];

  const [kegiatanList, setKegiatanList] = useState([]);
  const [loading, setLoading] = useState(true);
  const [search, setSearch] = useState("");
  const [selectedCategory, setSelectedCategory] = useState("Semua");

  useEffect(() => {
    setLoading(true);
    const queryParams = new URLSearchParams();
    if (search) queryParams.append("search", search);
    if (selectedCategory) queryParams.append("category", selectedCategory);

    fetch(`/api/kegiatan?${queryParams.toString()}`)
      .then((res) => {
        if (!res.ok) throw new Error("Gagal mengambil data kegiatan");
        return res.json();
      })
      .then((data) => {
        const formattedData = data.map((item) => ({
          title: item.judul,
          desc: item.deskripsi,
          date: item.tanggal,
          peserta: `${item.peserta} peserta`,
          category: item.kategori,
          image: item.kategori === "Seminar" ? foto1 : item.kategori === "Sosial" ? foto2 : foto3
        }));
        setKegiatanList(formattedData);
        setLoading(false);
      })
      .catch((err) => {
        console.error(err);
        const filteredMock = mockKegiatan.filter((item) => {
          const matchesSearch =
            item.title.toLowerCase().includes(search.toLowerCase()) ||
            item.desc.toLowerCase().includes(search.toLowerCase());
          const matchesCategory =
            selectedCategory === "Semua" || item.category === selectedCategory;
          return matchesSearch && matchesCategory;
        });
        setKegiatanList(filteredMock);
        setLoading(false);
      });
  }, [search, selectedCategory]);

  return (
    <div className="bg-[#f6f8f7] min-h-screen">

      <Navbar />

      {/* HERO */}
      <section className="px-4 sm:px-8 lg:px-20 pt-14 sm:pt-20 lg:pt-24 pb-10 sm:pb-14 border-b border-[#E5E7EB]">

        {/* TITLE */}
        <div className="text-center">

          <h1 className="text-[36px] sm:text-[48px] lg:text-[64px] font-semibold text-[#1F2937] leading-tight">
            Kegiatan & Program
          </h1>

          <p className="text-base sm:text-lg lg:text-[20px] text-[#9CA3AF] leading-[1.8] mt-4 sm:mt-5 max-w-[760px] mx-auto">
            Ikuti berbagai kegiatan, program, dan aktivitas Fatayat NU Sukabumi untuk pengembangan diri dan kontribusi sosial
          </p>

        </div>

        {/* SEARCH */}
        <div className="max-w-[1280px] mx-auto mt-10 sm:mt-16 lg:mt-20">

          <div className="w-full h-[52px] sm:h-[58px] bg-white border border-[#E5E7EB] rounded-[18px] px-4 sm:px-6 flex items-center">

            <svg
              xmlns="http://www.w3.org/2000/svg"
              className="w-5 h-5 text-[#9CA3AF] flex-shrink-0"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              strokeWidth={2}
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"
              />
            </svg>

            <input
              type="text"
              placeholder="Cari kegiatan..."
              value={search}
              onChange={(e) => setSearch(e.target.value)}
              className="ml-4 w-full bg-transparent outline-none text-[15px] sm:text-[16px] text-[#374151] placeholder:text-[#B0B7C3]"
            />

          </div>

          {/* CATEGORY */}
          <div className="flex items-center gap-2 sm:gap-3 mt-6 sm:mt-8 flex-wrap">

            {categories.map((item, i) => (
              <button
                key={i}
                onClick={() => setSelectedCategory(item)}
                className={`h-[38px] sm:h-[42px] px-4 sm:px-6 rounded-[14px] text-[13px] sm:text-[15px] transition duration-200 ${
                  selectedCategory === item
                    ? "bg-[#1f7a4d] text-white"
                    : "bg-white border border-[#E5E7EB] text-[#6B7280] hover:border-[#1f7a4d] hover:text-[#1f7a4d]"
                }`}
              >
                {item}
              </button>
            ))}

          </div>

        </div>

      </section>

      {/* GRID */}
      <section className="px-4 sm:px-8 lg:px-20 py-12 sm:py-16 lg:py-24">

        <div className="max-w-[1280px] mx-auto">
          {loading ? (
            <div className="text-center py-20 text-gray-500">Memuat kegiatan...</div>
          ) : kegiatanList.length === 0 ? (
            <div className="text-center py-20 text-gray-400 bg-white rounded-3xl border border-gray-200">
              Tidak ada kegiatan yang ditemukan.
            </div>
          ) : (
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
              {kegiatanList.map((item, i) => (
                <div
                  key={i}
                  className="bg-white border border-[#E5E7EB] rounded-[24px] overflow-hidden will-change-transform shadow-sm hover:shadow-md transition duration-300"
                >

                  {/* IMAGE */}
                  <div className="relative">

                    <img
                      loading="lazy"
                      src={item.image}
                      alt={item.title}
                      className="w-full h-[190px] object-cover"
                    />

                    <div className="absolute top-4 left-4 bg-white text-[#1f7a4d] text-xs px-3 py-1 rounded-full shadow-sm font-medium">
                      {item.category}
                    </div>

                  </div>

                  {/* CONTENT */}
                  <div className="p-5 sm:p-6">

                    <h3 className="text-[18px] sm:text-[22px] leading-[1.5] font-semibold text-[#111827] line-clamp-2">
                      {item.title}
                    </h3>

                    <p className="text-[#9CA3AF] text-[14px] sm:text-[15px] leading-[1.8] mt-4 sm:mt-5 min-h-[60px] sm:min-h-[72px] line-clamp-3">
                      {item.desc}
                    </p>

                    {/* INFO */}
                    <div className="mt-4 sm:mt-6 flex flex-col gap-2 sm:gap-3 text-[#9CA3AF] text-sm">

                      <div className="flex items-center gap-2">
                        📅 {item.date}
                      </div>

                      <div className="flex items-center gap-2">
                        👥 {item.peserta}
                      </div>

                    </div>

                    {/* BUTTON */}
                    <button className="w-full h-[46px] sm:h-[50px] border border-[#E5E7EB] rounded-[16px] mt-6 sm:mt-8 text-[#111827] hover:bg-[#1f7a4d] hover:text-white transition duration-300">
                      Lihat Detail
                    </button>

                  </div>

                </div>
              ))}
            </div>
          )}
        </div>

      </section>

      <Footer />

    </div>
  );
}

export default Kegiatan;