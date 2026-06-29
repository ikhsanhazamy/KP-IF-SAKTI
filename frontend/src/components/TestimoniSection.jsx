import { MessageSquare } from "lucide-react";

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
    <section className="bg-[#f6f8f7] px-4 sm:px-8 lg:px-20 py-12 sm:py-16">

      {/* HEADER */}
      <div className="text-center mb-12">
        <div className="inline-flex items-center gap-2 bg-white border border-[#0F5E3A]/10 text-[#0F5E3A] px-4 py-1.5 rounded-full text-sm font-semibold shadow-xs">
          <MessageSquare className="w-4 h-4" />
          Testimoni
        </div>

        <h2 className="text-3xl font-bold mt-4 text-gray-900 tracking-tight">
          Apa Kata Mereka
        </h2>

        <p className="text-gray-500 mt-2 max-w-xl mx-auto text-sm sm:text-base leading-relaxed">
          Pengalaman pengurus dan anggota dalam menggunakan platform manajemen organisasi kami
        </p>
      </div>

      {/* GRID */}
      <div className="max-w-[1215px] mx-auto">
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

          {data.map((item, i) => (
            <div
              key={i}
              className="bg-white rounded-[24px] p-6 sm:p-8 border border-gray-150 shadow-xs hover:shadow-md transition duration-300 flex flex-col justify-between"
            >

              <div>
                {/* STAR & QUOTE */}
                <div className="flex items-center justify-between mb-6">
                  <div className="text-[#0F5E3A] text-sm flex gap-0.5">
                    {"★".repeat(5)}
                  </div>

                  <div className="w-9 h-9 bg-[#E6F3EC] rounded-full flex items-center justify-center">
                    <span className="text-[#0F5E3A] font-serif text-2xl font-black leading-none -mt-1">“</span>
                  </div>
                </div>

                {/* TEXT */}
                <p className="text-sm text-gray-600 leading-relaxed font-semibold italic">
                  "{item.text}"
                </p>
              </div>

              {/* USER PROFILE WITH DIVIDER */}
              <div>
                <div className="border-t border-gray-100 mt-6 pt-6 flex items-center gap-3">

                  {/* AVATAR FROM INITIALS */}
                  <div className="w-10 h-10 rounded-full flex-shrink-0 bg-[#E6F3EC] text-[#0F5E3A] text-xs font-bold flex items-center justify-center border border-[#0F5E3A]/10 shadow-2xs">
                    {item.name.replace(/^(Hj\.|Dra\.)\s*/i, "").split(" ").map(n => n[0]).join("").slice(0, 2).toUpperCase()}
                  </div>

                  <div>
                    <p className="text-sm font-bold text-gray-900">
                      {item.name}
                    </p>
                    <p className="text-xs text-gray-400 font-semibold mt-0.5">
                      {item.role}
                    </p>
                  </div>

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