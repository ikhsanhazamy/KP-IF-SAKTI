import Navbar from "../components/Navbar";
import Footer from "../components/Footer";

import foto1 from "../assets/images/foto1.jpg";
import foto2 from "../assets/images/foto2.jpg";
import foto3 from "../assets/images/foto3.jpg";

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

  const kegiatan = [
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

  return (
    <div className="bg-[#f6f8f7] min-h-screen">

      <Navbar />

      {/* HERO */}
      <section className="px-20 pt-24 pb-14 border-b border-[#E5E7EB]">

        {/* TITLE */}
        <div className="text-center">

          <h1 className="text-[64px] font-semibold text-[#1F2937]">
            Kegiatan & Program
          </h1>

          <p className="text-[20px] text-[#9CA3AF] leading-[1.8] mt-5 max-w-[760px] mx-auto">
            Ikuti berbagai kegiatan, program, dan aktivitas Fatayat NU Sukabumi untuk pengembangan diri dan kontribusi sosial
          </p>

        </div>

        {/* SEARCH */}
        <div className="max-w-[1280px] mx-auto mt-20">

          <div className="w-full h-[58px] bg-white border border-[#E5E7EB] rounded-[18px] px-6 flex items-center">

            <svg
              xmlns="http://www.w3.org/2000/svg"
              className="w-5 h-5 text-[#9CA3AF]"
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
              className="ml-4 w-full bg-transparent outline-none text-[16px] text-[#374151] placeholder:text-[#B0B7C3]"
            />

          </div>

          {/* CATEGORY */}
          <div className="flex items-center gap-3 mt-8 flex-wrap">

            {categories.map((item, i) => (
              <button
                key={i}
                className={`h-[42px] px-6 rounded-[14px] text-[15px] transition duration-200 ${
                  i === 0
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
      <section className="px-20 py-24">

        <div className="max-w-[1280px] mx-auto grid grid-cols-3 gap-8">

          {kegiatan.map((item, i) => (
            <div
              key={i}
              className="bg-white border border-[#E5E7EB] rounded-[24px] overflow-hidden will-change-transform"
            >

              {/* IMAGE */}
              <div className="relative">

                <img
                  loading="lazy"
                  src={item.image}
                  alt={item.title}
                  className="w-full h-[190px] object-cover"
                />

                <div className="absolute top-4 left-4 bg-white text-[#1f7a4d] text-xs px-3 py-1 rounded-full shadow-sm">
                  {item.category}
                </div>

              </div>

              {/* CONTENT */}
              <div className="p-6">

                <h3 className="text-[22px] leading-[1.5] font-semibold text-[#111827]">
                  {item.title}
                </h3>

                <p className="text-[#9CA3AF] text-[15px] leading-[1.8] mt-5 min-h-[72px]">
                  {item.desc}
                </p>

                {/* INFO */}
                <div className="mt-6 flex flex-col gap-3 text-[#9CA3AF] text-sm">

                  <div className="flex items-center gap-2">
                    📅 {item.date}
                  </div>

                  <div className="flex items-center gap-2">
                    👥 {item.peserta}
                  </div>

                </div>

                {/* BUTTON */}
                <button className="w-full h-[50px] border border-[#E5E7EB] rounded-[16px] mt-8 text-[#111827] hover:bg-[#1f7a4d] hover:text-white transition duration-300">
                  Lihat Detail
                </button>

              </div>

            </div>
          ))}

        </div>

      </section>

      <Footer />

    </div>
  );
}

export default Kegiatan;