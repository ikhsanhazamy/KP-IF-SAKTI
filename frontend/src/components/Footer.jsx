function Footer() {
  return (
    <footer
      className="text-white px-20 py-16"
      style={{
        background:
          "linear-gradient(135deg, #0F5E3A 0%, #1A6741 7.14%, #237148 14.29%, #2C7B4F 21.43%, #358556 28.57%, #3E8F5D 35.71%, #469965 42.86%, #4FA36C 50%, #469965 57.14%, #3E8F5D 64.29%, #358556 71.43%, #2C7B4F 78.57%, #237148 85.71%, #1A6741 92.86%, #0F5E3A 100%)"
      }}
    >

      {/* TOP */}
      <div className="max-w-[1215px] mx-auto grid grid-cols-4 gap-10">

        {/* LEFT */}
        <div>
          <div className="flex items-center gap-3 mb-4">
            <div className="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center font-bold">
              FN
            </div>
            <div>
              <h3 className="font-semibold">Fatayat NU</h3>
              <p className="text-xs opacity-80">Sukabumi</p>
            </div>
          </div>

          <p className="text-sm opacity-80 leading-relaxed mb-4">
            Organisasi perempuan Nahdlatul Ulama yang berfokus pada pemberdayaan perempuan, pendidikan, dan pengembangan masyarakat di Kabupaten Sukabumi.
          </p>

          <div className="text-sm opacity-80 space-y-2">
            <p>Jl. Raya Sukabumi No.123, Kecamatan Cibadak, Kabupaten Sukabumi</p>
            <p>+62 266 123456</p>
            <p>info@fatayatsukabumi.or.id</p>
          </div>
        </div>

        {/* TENTANG */}
        <div>
          <h4 className="font-semibold mb-4">Tentang Kami</h4>
          <ul className="space-y-2 text-sm opacity-80">
            <li className="hover:text-white cursor-pointer">Profil Organisasi</li>
            <li className="hover:text-white cursor-pointer">Visi & Misi</li>
            <li className="hover:text-white cursor-pointer">Struktur Kepengurusan</li>
            <li className="hover:text-white cursor-pointer">Sejarah</li>
          </ul>
        </div>

        {/* LAYANAN */}
        <div>
          <h4 className="font-semibold mb-4">Layanan</h4>
          <ul className="space-y-2 text-sm opacity-80">
            <li className="hover:text-white cursor-pointer">Pendaftaran Anggota</li>
            <li className="hover:text-white cursor-pointer">Data PAC</li>
            <li className="hover:text-white cursor-pointer">KTA Digital</li>
            <li className="hover:text-white cursor-pointer">Kegiatan</li>
          </ul>
        </div>

        {/* INFORMASI */}
        <div>
          <h4 className="font-semibold mb-4">Informasi</h4>
          <ul className="space-y-2 text-sm opacity-80">
            <li className="hover:text-white cursor-pointer">Berita</li>
            <li className="hover:text-white cursor-pointer">Pengumuman</li>
            <li className="hover:text-white cursor-pointer">Dokumentasi</li>
            <li className="hover:text-white cursor-pointer">Kontak</li>
          </ul>
        </div>

      </div>

      {/* DIVIDER */}
      <div className="max-w-[1215px] mx-auto border-t border-white/20 mt-12 pt-6 flex items-center justify-between">

        {/* SOCIAL */}
        <div className="flex gap-3">
          <div className="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center hover:bg-white/30 transition cursor-pointer">
            f
          </div>
          <div className="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center hover:bg-white/30 transition cursor-pointer">
            ig
          </div>
          <div className="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center hover:bg-white/30 transition cursor-pointer">
            yt
          </div>
          <div className="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center hover:bg-white/30 transition cursor-pointer">
            tw
          </div>
        </div>


        <p className="text-sm opacity-80">
          © 2026 Fatayat NU Sukabumi. All rights reserved.
        </p>

      </div>

    </footer>
  );
}

export default Footer;