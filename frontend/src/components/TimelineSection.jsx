function TimelineSection() {
  const timeline = [
    {
      year: "1950",
      title: "Pendirian Awal",
      desc: "Fatayat NU Sukabumi didirikan sebagai bagian dari gerakan perempuan NU nasional",
      side: "left"
    },
    {
      year: "1980",
      title: "Ekspansi Wilayah",
      desc: "Pembentukan PAC di seluruh kecamatan di Kabupaten Sukabumi",
      side: "right"
    },
    {
      year: "2000",
      title: "Era Modernisasi",
      desc: "Implementasi sistem manajemen organisasi yang lebih terstruktur",
      side: "left"
    },
    {
      year: "2020",
      title: "Transformasi Digital",
      desc: "Peluncuran platform digital untuk manajemen keanggotaan dan administrasi",
      side: "right"
    },
    {
      year: "2026",
      title: "Inovasi Berkelanjutan",
      desc: "Pengembangan aplikasi mobile dan sistem terintegrasi",
      side: "left"
    }
  ];

  return (
    <section id="sejarah" className="bg-[#f6f8f7] px-4 sm:px-8 lg:px-20 py-16 sm:py-20 lg:py-24">

      {/* HEADER */}
      <div className="text-center mb-12 sm:mb-16 lg:mb-20">

        <div className="inline-flex items-center gap-2 bg-[#eef3f0] text-[#1f7a4d] px-4 py-1 rounded-full text-sm">
          Sejarah
        </div>

        <h2 className="text-[32px] sm:text-[40px] lg:text-[48px] font-semibold text-gray-900 mt-5">
          Perjalanan Organisasi
        </h2>

      </div>

      {/* TIMELINE — vertical single column on mobile, alternating on desktop */}
      <div className="relative max-w-[1000px] mx-auto">

        {/* GARIS TENGAH — hidden di mobile, shown di md+ */}
        <div className="hidden md:block absolute left-1/2 top-0 -translate-x-1/2 w-[2px] h-full bg-[#d9e5dd]" />

        {/* GARIS KIRI — hanya mobile */}
        <div className="md:hidden absolute left-5 top-0 w-[2px] h-full bg-[#d9e5dd]" />

        <div className="flex flex-col gap-10 sm:gap-16 md:gap-24">

          {timeline.map((item, i) => (
            <div
              key={i}
              className={`relative flex md:${
                item.side === "left" ? "justify-start" : "justify-end"
              } pl-14 md:pl-0`}
            >

              {/* TITIK di kiri mobile */}
              <div className="md:hidden absolute left-[14px] top-3 w-3 h-3 bg-[#1f7a4d] rounded-full" />

              {/* CONTENT */}
              <div className="w-full md:w-[420px]">

                {/* YEAR */}
                <div
                  className={`mb-4 flex md:${
                    item.side === "left" ? "justify-end" : "justify-start"
                  } justify-start`}
                >
                  <div className="bg-[#1f7a4d] text-white text-sm font-medium px-6 py-2 rounded-full inline-block">
                    {item.year}
                  </div>
                </div>

                {/* TEXT */}
                <div
                  className={`bg-white/30 backdrop-blur-lg rounded-2xl p-5 sm:p-6 border border-gray-200 hover:shadow-sm transition ${
                    item.side === "left"
                      ? "md:text-right text-left"
                      : "text-left"
                  }`}
                >

                  <h3 className="text-xl sm:text-2xl lg:text-[32px] font-semibold text-gray-900">
                    {item.title}
                  </h3>

                  <p className="text-gray-400 mt-3 leading-relaxed text-sm sm:text-base">
                    {item.desc}
                  </p>

                </div>

              </div>

            </div>
          ))}

        </div>

      </div>

    </section>
  );
}

export default TimelineSection;