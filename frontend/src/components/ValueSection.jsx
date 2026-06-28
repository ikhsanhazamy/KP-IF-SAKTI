import anggotaIcon from "../assets/icons/anggota.svg";
import pacIcon from "../assets/icons/pac.svg";
import pertumbuhanIcon from "../assets/icons/pertumbuhan.svg";
import LocationIcon from "../assets/icons/Location.svg";

function ValueSection() {
  const values = [
    {
      title: "Kekeluargaan",
      desc: "Membangun ikatan persaudaraan yang kuat",
      icon: anggotaIcon
    },
    {
      title: "Profesional",
      desc: "Mengedepankan kualitas dan kompetensi",
      icon: pacIcon
    },
    {
      title: "Amanah",
      desc: "Bertanggung jawab dalam setiap tugas",
      icon: pertumbuhanIcon
    },
    {
      title: "Inovatif",
      desc: "Selalu berinovasi untuk kemajuan",
      icon: LocationIcon
    }
  ];

  return (
    <section className="bg-[#f6f8f7] px-4 sm:px-8 lg:px-20 py-16 sm:py-20 lg:py-24">

      {/* TITLE */}
      <div className="text-center mb-10 sm:mb-14">

        <h2 className="text-[32px] sm:text-[40px] lg:text-[48px] font-semibold text-gray-900">
          Nilai-Nilai Organisasi
        </h2>

      </div>

      {/* GRID */}
      <div className="max-w-[1280px] mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">

        {values.map((item, i) => (
          <div
            key={i}
            className="bg-white border border-[#E7E7E7] rounded-[28px] px-6 pt-6 pb-8 min-h-[160px]"
          >

            {/* ICON */}
            <div className="w-[52px] h-[52px] rounded-[16px] bg-[#eef3f0] flex items-center justify-center mb-5">
              <img
                src={item.icon}
                alt={item.title}
                className="w-[50px] h-[50px]"
              />
            </div>

            {/* TITLE */}
            <h3 className="text-[18px] font-semibold text-[#111827] mb-3 leading-none">
              {item.title}
            </h3>

            {/* DESC */}
            <p className="text-[15px] text-[#9CA3AF] leading-[1.5]">
              {item.desc}
            </p>

          </div>
        ))}

      </div>

    </section>
  );
}

export default ValueSection;