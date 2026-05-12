import foto1 from "../assets/images/foto1.jpg";
import foto2 from "../assets/images/foto2.jpg";
import foto3 from "../assets/images/foto3.jpg";

function KegiatanSection() {
  const data = [
    {
      title: "Seminar Pemberdayaan Perempuan dan Kewirausahaan",
      date: "15 Mei 2026",
      peserta: "150 peserta",
      img: foto1,
      tag: "Seminar"
    },
    {
      title: "Bakti Sosial dan Santunan Anak Yatim",
      date: "8 Mei 2026",
      peserta: "85 peserta",
      img: foto2,
      tag: "Sosial"
    },
    {
      title: "Pelatihan Kaderisasi dan Leadership",
      date: "1 Mei 2026",
      peserta: "120 peserta",
      img: foto3,
      tag: "Pelatihan"
    },
    {
      title: "Rapat Koordinasi PAC Se-Sukabumi",
      date: "22 April 2026",
      peserta: "95 peserta",
      img: foto3
    },
    {
      title: "Workshop Manajemen Organisasi Modern",
      date: "10 April 2026",
      peserta: "75 peserta",
      img: foto1
    },
    {
      title: "Kajian Rutin Keislaman dan Keputrian",
      date: "3 April 2026",
      peserta: "200 peserta",
      img: foto2
    }
  ];

  return (
    <section className="bg-[#f6f8f7] px-20 py-20">

      {/* HEADER */}
      <div className="text-center mb-14">
        <div className="inline-flex items-center gap-2 bg-[#eef3f0] text-[#1f7a4d] px-4 py-1 rounded-full text-sm">
          📅 Berita & Kegiatan
        </div>

        <h2 className="text-3xl font-semibold mt-4 text-gray-900">
          Kegiatan & Dokumentasi
        </h2>

        <p className="text-gray-500 mt-2 max-w-xl mx-auto">
          Update terbaru mengenai kegiatan, program, dan aktivitas organisasi Fatayat NU Sukabumi
        </p>
      </div>

      {/* GRID */}
      <div className="max-w-[1215px] mx-auto">
        <div className="grid grid-cols-3 gap-6">

          {data.map((item, i) => (
            <div
              key={i}
              className="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition"
            >

              {/* IMAGE */}
              <div className="relative h-[180px] overflow-hidden">
                <img
                  src={item.img}
                  className="w-full h-full object-cover"
                />

                {/* OVERLAY HIJAU */}
                <div className="absolute inset-0 bg-gradient-to-t from-green-900/40 to-transparent" />

                {/* TAG */}
                {item.tag && (
                  <span className="absolute top-3 left-3 bg-white/90 text-green-700 text-xs px-3 py-1 rounded-full">
                    {item.tag}
                  </span>
                )}
              </div>

              {/* CONTENT */}
              <div className="p-5">

                <h3 className="font-semibold text-gray-900 text-sm leading-snug">
                  {item.title}
                </h3>

                {/* META */}
                <div className="mt-3 text-xs text-gray-400 space-y-1">
                  <p>📅 {item.date}</p>
                  <p>👥 {item.peserta}</p>
                </div>

                {/* BUTTON */}
                <button className="mt-4 w-full h-[38px] border border-gray-200 rounded-xl text-sm hover:bg-gray-50 transition">
                  Selengkapnya →
                </button>

              </div>

            </div>
          ))}

        </div>
      </div>

      {/* BUTTON BAWAH */}
      <div className="flex justify-center mt-12">
        <button className="bg-[#1f7a4d] text-white px-6 py-3 rounded-xl shadow hover:bg-[#17633d] transition">
          Lihat Semua Kegiatan
        </button>
      </div>

    </section>
  );
}

export default KegiatanSection;