import image1 from "../assets/images/image1.jpeg";

function Hero() {
  return (
    <section className="bg-gradient-to-r from-primary-500 to-primary-600 px-20 py-20 flex items-center justify-between text-white">

      {/* LEFT */}
      <div className="max-w-2xl">

        <div className="inline-flex items-center gap-2 bg-[#FFFFFF] text-[#1f7a4d] px-5 py-1 rounded-full text-sm font-medium">
          <div className="w-2 h-2 bg-[#1f7a4d] rounded-full"></div>
          Platform Manajemen Organisasi Modern
        </div>

        <h1 className="text-[64px] font-semibold leading-[1.1] mt-6 text-gray-900">
          Memberdayakan{" "}
          <span className="text-[#1f7a4d]">Perempuan</span> <br />
          Melalui Organisasi Digital
        </h1>

        <p className="text-gray-500 mt-6 text-lg max-w-xl">
          Sistem manajemen terpadu untuk pengelolaan data anggota,
          pemetaan PAC, statistik organisasi, dan digitalisasi administrasi
          Fatayat NU Sukabumi.
        </p>

        {/* BUTTON */}
        <div className="flex gap-4 mt-8">
          <button className="bg-[#1f7a4d] text-white px-6 py-3 rounded-xl font-medium hover:bg-[#17633f] transition">
            Mulai Sekarang
          </button>
          <button className="bg-white border border-gray-200 px-6 py-3 rounded-xl font-medium hover:bg-[#0F5E3A1A] transition">
            Pelajari Lebih Lanjut
          </button>
        </div>


        {/* STATS */}
        <div className="flex gap-16 mt-12">
          <div>
            <h2 className="text-2xl font-semibold text-[#1f7a4d]">2,847</h2>
            <p className="text-sm text-gray-400">Anggota Aktif</p>
          </div>
          <div>
            <h2 className="text-2xl font-semibold text-[#1f7a4d]">47</h2>
            <p className="text-sm text-gray-400">PAC Aktif</p>
          </div>
          <div>
            <h2 className="text-2xl font-semibold text-[#1f7a4d]">15</h2>
            <p className="text-sm text-gray-400">Kecamatan</p>
          </div>
          <div>
            <h2 className="text-2xl font-semibold text-[#1f7a4d]">98%</h2>
            <p className="text-sm text-gray-400">Kepuasan</p>
          </div>
        </div>

      </div>

      {/* RIGHT */}
<div className="relative">

  <img
    src={image1}
    alt="hero"
    className="w-[580px] h-[500px] object-cover rounded-2xl shadow-xl"
  />

  {/* FLOAT CARD */}
  <div className="absolute -bottom-10 -left-10 bg-white px-6 py-4 rounded-xl shadow-xl flex items-center gap-4">

    {/* ICON */}
    <div className="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
        <span className="text-white text-lg"></span>
    </div>

    {/* TEXT */}
    <div>
      <p className="text-lg font-semibold text-gray-900">+24%</p>
      <p className="text-sm text-gray-400">
        Pertumbuhan Kader 2026
      </p>
    </div>

  </div>

</div>

    </section>
  );
}

export default Hero;