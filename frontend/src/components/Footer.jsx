import { MapPin, Phone, Mail } from "lucide-react";
import { FaFacebookF, FaInstagram, FaYoutube, FaTwitter } from "react-icons/fa";

function Footer() {
  return (
    <footer
      className="text-white px-4 sm:px-8 lg:px-20 py-12 sm:py-16 border-t border-[#0F5E3A]/20"
      style={{
        background:
          "linear-gradient(180deg, #0F5E3A 0%, #0B462B 100%)"
      }}
    >

      {/* TOP */}
      <div className="max-w-[1215px] mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10">

        {/* LEFT */}
        <div className="sm:col-span-2 lg:col-span-1">
          <div className="flex items-center gap-3 mb-6">
            <div className="w-10 h-10 border border-white/25 rounded-full flex items-center justify-center font-black text-lg bg-white/10">
              FN
            </div>
            <div>
              <h3 className="font-bold text-lg tracking-tight">Fatayat NU</h3>
              <p className="text-xs opacity-75 font-semibold">Sukabumi</p>
            </div>
          </div>

          <p className="text-sm opacity-85 leading-relaxed mb-6 font-medium">
            Organisasi perempuan Nahdlatul Ulama yang berfokus pada pemberdayaan perempuan, pendidikan, dan pengembangan masyarakat di Kabupaten Sukabumi.
          </p>

          <div className="text-sm opacity-85 space-y-3.5 font-medium">
            <p className="flex items-start gap-2.5">
              <MapPin className="w-4 h-4 text-green-300 flex-shrink-0 mt-0.5" />
              <span>Jl. Raya Sukabumi No. 123, Kecamatan Cibadak, Kabupaten Sukabumi, Jawa Barat 43351</span>
            </p>
            <p className="flex items-center gap-2.5">
              <Phone className="w-4 h-4 text-green-300 flex-shrink-0" />
              <span>+62 266 123456</span>
            </p>
            <p className="flex items-center gap-2.5">
              <Mail className="w-4 h-4 text-green-300 flex-shrink-0" />
              <span>info@fatayatnusukabumi.or.id</span>
            </p>
          </div>
        </div>

        {/* TENTANG */}
        <div className="lg:pl-8">
          <h4 className="font-bold text-base mb-4 tracking-tight">Tentang Kami</h4>
          <ul className="space-y-3 text-sm opacity-80 font-semibold">
            <li className="hover:text-green-200 transition cursor-pointer">Profil Organisasi</li>
            <li className="hover:text-green-200 transition cursor-pointer">Visi & Misi</li>
            <li className="hover:text-green-200 transition cursor-pointer">Struktur Kepengurusan</li>
            <li className="hover:text-green-200 transition cursor-pointer">Sejarah</li>
          </ul>
        </div>

        {/* LAYANAN */}
        <div>
          <h4 className="font-bold text-base mb-4 tracking-tight">Layanan</h4>
          <ul className="space-y-3 text-sm opacity-80 font-semibold">
            <li className="hover:text-green-200 transition cursor-pointer">Pendaftaran Anggota</li>
            <li className="hover:text-green-200 transition cursor-pointer">Data PAC</li>
            <li className="hover:text-green-200 transition cursor-pointer">KTA Digital</li>
            <li className="hover:text-green-200 transition cursor-pointer">Kegiatan</li>
          </ul>
        </div>

        {/* INFORMASI */}
        <div>
          <h4 className="font-bold text-base mb-4 tracking-tight">Informasi</h4>
          <ul className="space-y-3 text-sm opacity-80 font-semibold">
            <li className="hover:text-green-200 transition cursor-pointer">Berita</li>
            <li className="hover:text-green-200 transition cursor-pointer">Pengumuman</li>
            <li className="hover:text-green-200 transition cursor-pointer">Dokumentasi</li>
            <li className="hover:text-green-200 transition cursor-pointer">Kontak</li>
          </ul>
        </div>

      </div>

      {/* DIVIDER */}
      <div className="max-w-[1215px] mx-auto border-t border-white/10 mt-10 sm:mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">

        {/* SOCIAL */}
        <div className="flex gap-3">
          <div className="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white/10 hover:border-white/40 transition cursor-pointer shadow-xs">
            <FaFacebookF className="w-4 h-4" />
          </div>
          <div className="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white/10 hover:border-white/40 transition cursor-pointer shadow-xs">
            <FaInstagram className="w-4 h-4" />
          </div>
          <div className="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white/10 hover:border-white/40 transition cursor-pointer shadow-xs">
            <FaYoutube className="w-4 h-4" />
          </div>
          <div className="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white/10 hover:border-white/40 transition cursor-pointer shadow-xs">
            <FaTwitter className="w-4 h-4" />
          </div>
        </div>

        <p className="text-sm opacity-85 text-center sm:text-right font-medium">
          © 2026 Fatayat NU Sukabumi. All rights reserved.
        </p>

      </div>

    </footer>
  );
}

export default Footer;