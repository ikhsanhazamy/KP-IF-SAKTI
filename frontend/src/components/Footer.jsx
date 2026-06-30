import { Link } from "react-router-dom";
import { MapPin, Phone, Mail } from "lucide-react";
import { FaFacebookF, FaInstagram, FaYoutube, FaTwitter } from "react-icons/fa";

function Footer() {
  return (
    <footer
      id="kontak"
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
            <a
              href="https://maps.google.com/?q=Jl.+Raya+Sukabumi+No.+123,+Kecamatan+Cibadak,+Kabupaten+Sukabumi,+Jawa+Barat+43351"
              target="_blank"
              rel="noopener noreferrer"
              className="flex items-start gap-2.5 hover:text-green-200 transition"
            >
              <MapPin className="w-4 h-4 text-green-300 flex-shrink-0 mt-0.5" />
              <span>Jl. Raya Sukabumi No. 123, Kecamatan Cibadak, Kabupaten Sukabumi, Jawa Barat 43351</span>
            </a>
            <a
              href="tel:+62266123456"
              className="flex items-center gap-2.5 hover:text-green-200 transition"
            >
              <Phone className="w-4 h-4 text-green-300 flex-shrink-0" />
              <span>+62 266 123456</span>
            </a>
            <a
              href="mailto:info@fatayatnusukabumi.or.id"
              className="flex items-center gap-2.5 hover:text-green-200 transition"
            >
              <Mail className="w-4 h-4 text-green-300 flex-shrink-0" />
              <span>info@fatayatnusukabumi.or.id</span>
            </a>
          </div>
        </div>

        {/* TENTANG */}
        <div className="lg:pl-8">
          <h4 className="font-bold text-base mb-4 tracking-tight">Tentang Kami</h4>
          <ul className="space-y-3 text-sm opacity-80 font-semibold flex flex-col">
            <li>
              <Link to="/tentang#profil" className="hover:text-green-200 transition cursor-pointer">
                Profil Organisasi
              </Link>
            </li>
            <li>
              <Link to="/tentang#visi-misi" className="hover:text-green-200 transition cursor-pointer">
                Visi & Misi
              </Link>
            </li>
            <li>
              <Link to="/tentang#sejarah" className="hover:text-green-200 transition cursor-pointer">
                Sejarah
              </Link>
            </li>
          </ul>
        </div>

        {/* LAYANAN */}
        <div>
          <h4 className="font-bold text-base mb-4 tracking-tight">Layanan</h4>
          <ul className="space-y-3 text-sm opacity-80 font-semibold flex flex-col">
            <li>
              <Link to="/pengajuan-data-pac" className="hover:text-green-200 transition cursor-pointer">
                Pendaftaran Anggota
              </Link>
            </li>
            <li>
              <Link to="/data-pac" className="hover:text-green-200 transition cursor-pointer">
                Data PAC
              </Link>
            </li>
            <li>
              <Link to="/#kta-digital" className="hover:text-green-200 transition cursor-pointer">
                KTA Digital
              </Link>
            </li>
            <li>
              <Link to="/kegiatan" className="hover:text-green-200 transition cursor-pointer">
                Kegiatan
              </Link>
            </li>
          </ul>
        </div>

        {/* INFORMASI */}
        <div>
          <h4 className="font-bold text-base mb-4 tracking-tight">Informasi</h4>
          <ul className="space-y-3 text-sm opacity-80 font-semibold flex flex-col">
            <li>
              <Link to="/kegiatan" className="hover:text-green-200 transition cursor-pointer">
                Berita
              </Link>
            </li>
            <li>
              <Link to="/kegiatan" className="hover:text-green-200 transition cursor-pointer">
                Pengumuman
              </Link>
            </li>
            <li>
              <Link to="/kegiatan" className="hover:text-green-200 transition cursor-pointer">
                Dokumentasi
              </Link>
            </li>
            <li>
              <a href="#kontak" className="hover:text-green-200 transition cursor-pointer">
                Kontak
              </a>
            </li>
          </ul>
        </div>

      </div>

      {/* DIVIDER */}
      <div className="max-w-[1215px] mx-auto border-t border-white/10 mt-10 sm:mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">

        {/* SOCIAL */}
        <div className="flex gap-3">
          <a
            href="https://facebook.com"
            target="_blank"
            rel="noopener noreferrer"
            className="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white/10 hover:border-white/40 transition cursor-pointer shadow-xs text-white"
          >
            <FaFacebookF className="w-4 h-4" />
          </a>
          <a
            href="https://instagram.com"
            target="_blank"
            rel="noopener noreferrer"
            className="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white/10 hover:border-white/40 transition cursor-pointer shadow-xs text-white"
          >
            <FaInstagram className="w-4 h-4" />
          </a>
          <a
            href="https://youtube.com"
            target="_blank"
            rel="noopener noreferrer"
            className="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white/10 hover:border-white/40 transition cursor-pointer shadow-xs text-white"
          >
            <FaYoutube className="w-4 h-4" />
          </a>
          <a
            href="https://twitter.com"
            target="_blank"
            rel="noopener noreferrer"
            className="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white/10 hover:border-white/40 transition cursor-pointer shadow-xs text-white"
          >
            <FaTwitter className="w-4 h-4" />
          </a>
        </div>

        <p className="text-sm opacity-85 text-center sm:text-right font-medium">
          © 2026 Fatayat NU Sukabumi. All rights reserved.
        </p>

      </div>

    </footer>
  );
}

export default Footer;