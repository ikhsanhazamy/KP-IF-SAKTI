function TestimoniSection() {
  const data = [
    {
      text: "Platform digital ini sangat membantu kami dalam mengelola administrasi PAC. Semua data anggota tersimpan rapi dan mudah diakses. Sangat recommended untuk pengurus PAC lainnya!",
      name: "Hj. Siti Aminah, S.Pd",
      role: "Ketua PAC Cibadak"
    },
    {
      text: "Dengan adanya KTA digital, saya tidak perlu lagi membawa kartu fisik kemana-mana. Sangat praktis dan modern. Terima kasih Fatayat NU Sukabumi!",
      name: "Hj. Nurhayati, M.Pd",
      role: "Anggota PAC Palabuhanratu"
    },
    {
      text: "Sistem manajemen ini membawa transformasi besar dalam organisasi kami. Data yang akurat dan real-time membantu kami membuat keputusan strategis yang lebih baik.",
      name: "Dra. Hj. Fatimah",
      role: "Ketua PC Fatayat NU Sukabumi"
    }
  ];

  return (
    <section className="bg-[#f6f8f7] px-4 sm:px-8 lg:px-20 py-12 sm:py-16 lg:py-20">

      {/* HEADER */}
      <div className="text-center mb-10 sm:mb-14">
        <div className="inline-flex items-center gap-2 bg-[#eef3f0] text-[#1f7a4d] px-4 py-1 rounded-full text-sm">
          💬 Testimoni
        </div>

        <h2 className="text-2xl sm:text-3xl font-semibold mt-4 text-gray-900">
          Apa Kata Mereka
        </h2>

        <p className="text-gray-500 mt-2 max-w-xl mx-auto text-sm sm:text-base">
          Pengalaman pengurus dan anggota dalam menggunakan platform manajemen organisasi kami
        </p>
      </div>

      {/* GRID */}
      <div className="max-w-[1215px] mx-auto">
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

          {data.map((item, i) => (
            <div
              key={i}
              className="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition flex flex-col justify-between"
            >

              {/* STAR */}
              <div className="flex items-center justify-between mb-4">
                <div className="text-green-600 text-sm">
                  ★★★★★
                </div>

                <div className="w-8 h-8 bg-[#eef3f0] rounded-full flex items-center justify-center text-green-700">
                  "
                </div>
              </div>

              {/* TEXT */}
              <p className="text-sm text-gray-600 leading-relaxed flex-1">
                "{item.text}"
              </p>

              {/* USER */}
              <div className="flex items-center gap-3 mt-6">

                {/* AVATAR */}
                <div className="w-10 h-10 bg-gray-200 rounded-full flex-shrink-0" />

                <div>
                  <p className="text-sm font-semibold text-gray-900">
                    {item.name}
                  </p>
                  <p className="text-xs text-gray-400">
                    {item.role}
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

export default TestimoniSection;