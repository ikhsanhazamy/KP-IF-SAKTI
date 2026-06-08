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
    <section className="bg-[#f6f8f7] px-20 py-24">

      {/* HEADER */}
      <div className="text-center mb-20">

        <div className="inline-flex items-center gap-2 bg-[#eef3f0] text-[#1f7a4d] px-4 py-1 rounded-full text-sm">
          🕘 Sejarah
        </div>

        <h2 className="text-[48px] font-semibold text-gray-900 mt-5">
          Perjalanan Organisasi
        </h2>

      </div>

      {/* TIMELINE */}
      <div className="relative max-w-[1000px] mx-auto">

        {/* GARIS TENGAH */}
        <div className="absolute left-1/2 top-0 -translate-x-1/2 w-[2px] h-full bg-[#d9e5dd]" />

        <div className="flex flex-col gap-24">

          {timeline.map((item, i) => (
            <div
              key={i}
              className={`relative flex ${
                item.side === "left"
                  ? "justify-start"
                  : "justify-end"
              }`}
            >

              {/* CONTENT */}
              <div className="w-[420px]">

                {/* YEAR */}
                <div
                  className={`mb-4 flex ${
                    item.side === "left"
                      ? "justify-end"
                      : "justify-start"
                  }`}
                >
                  <div className="bg-[#1f7a4d] text-white text-sm font-medium px-6 py-2 rounded-full">
                    {item.year}
                  </div>
                </div>

                {/* TEXT */}
                <div
                  className={`${
                    item.side === "left"
                      ? "text-right"
                      : "text-left"
                  }`}
                >

                  <h3 className="text-[32px] font-semibold text-gray-900">
                    {item.title}
                  </h3>

                  <p className="text-gray-400 mt-3 leading-relaxed">
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