import { Link } from "react-router-dom";
import { MapPin, Phone, Mail } from "lucide-react";
import { FaFacebookF, FaInstagram, FaYoutube, FaTwitter } from "react-icons/fa";

function Footer() {
  return (
    <footer
      id="kontak"
      className="text-white py-14 sm:py-18 border-t border-[#0F5E3A]/20"
      style={{
        background: "linear-gradient(180deg, #0F5E3A 0%, #0B462B 100%)"
      }}
    >
      <div className="section-container">
        {/* TOP */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10">

          {/* LEFT */}
          <div className="sm:col-span-2 lg:col-span-1">
            <div className="flex items-center gap-3 mb-6">
              <div className="w-10 h-10 border border-white/25 rounded-xl flex items-center justify-center font-black text-lg bg-white/10 text-white shadow-xs">
                FN
              </div>
              <div>
                <h3 className="font-bold text-lg tracking-tight">Fatayat NU</h3>
                <p className="text-xs text-green-200 font-semibold">Kabupaten Sukabumi</p>
              </div>
            </div>

            <p className="text-sm text-gray-200 leading-relaxed mb-6 font-medium">
              Organisasi perempuan Nahdlatul Ulama yang berfokus pada pemberdayaan perempuan, pendidikan, dan pengembangan masyarakat di Kabupaten Sukabumi.
            </p>

            <div className="text-sm text-gray-200 space-y-3 font-medium">
              <a
                href="https://maps.google.com/?q=Jl.+Raya+Sukabumi+No.+123,+Kecamatan+Cibadak,+Kabupaten+Sukabumi,+Jawa+Barat+43351"
                target="_blank"
                rel="noopener noreferrer"
                className="flex items-start gap-2.5 hover:text-green-300 transition"
              >
                <MapPin className="w-4 h-4 text-green-300 flex-shrink-0 mt-0.5" />
                <span>Jl. Raya Sukabumi No. 123, Cibadak, Sukabumi</span>
              </a>
              <a
                href="tel:+62266123456"
                className="flex items-center gap-2.5 hover:text-green-300 transition"
              >
                <Phone className="w-4 h-4 text-green-300 flex-shrink-0" />
                <span>+62 266 123456</span>
              </a>
              <a
                href="mailto:info@fatayatnusukabumi.or.id"
                className="flex items-center gap-2.5 hover:text-green-300 transition"
              >
                <Mail className="w-4 h-4 text-green-300 flex-shrink-0" />
                <span>info@fatayatnusukabumi.or.id</span>
              </a>
            </div>
          </div>

          {/* TENTANG */}
          <div className="lg:pl-8">
            <h4 className="font-bold text-base mb-4 tracking-tight text-white">Tentang Kami</h4>
            <ul className="space-y-3 text-sm text-gray-200 font-medium flex flex-col">
              <li>
                <Link to="/tentang#profil" className="hover:text-green-300 transition cursor-pointer">
                  Profil Organisasi
                </Link>
              </li>
              <li>
                <Link to="/tentang#visi-misi" className="hover:text-green-300 transition cursor-pointer">
                  Visi & Misi
                </Link>
              </li>
              <li>
                <Link to="/tentang#sejarah" className="hover:text-green-300 transition cursor-pointer">
                  Sejarah
                </Link>
              </li>
            </ul>
          </div>

          {/* LAYANAN */}
          <div>
            <h4 className="font-bold text-base mb-4 tracking-tight text-white">Layanan & Fitur</h4>
            <ul className="space-y-3 text-sm text-gray-200 font-medium flex flex-col">
              <li>
                <Link to="/pengajuan-data-pac" className="hover:text-green-300 transition cursor-pointer">
                  Pengajuan PAC Baru
                </Link>
              </li>
              <li>
                <Link to="/data-pac" className="hover:text-green-300 transition cursor-pointer">
                  Data & Pemetaan PAC
                </Link>
              </li>
              <li>
                <Link to="/kegiatan" className="hover:text-green-300 transition cursor-pointer">
                  Agenda & Kegiatan
                </Link>
              </li>
            </ul>
          </div>

          {/* INFORMASI */}
          <div>
            <h4 className="font-bold text-base mb-4 tracking-tight text-white">Informasi</h4>
            <ul className="space-y-3 text-sm text-gray-200 font-medium flex flex-col">
              <li>
                <Link to="/kegiatan" className="hover:text-green-300 transition cursor-pointer">
                  Berita Terbaru
                </Link>
              </li>
              <li>
                <Link to="/kegiatan" className="hover:text-green-300 transition cursor-pointer">
                  Dokumentasi
                </Link>
              </li>
              <li>
                <a href="#kontak" className="hover:text-green-300 transition cursor-pointer">
                  Kontak
                </a>
              </li>
            </ul>
          </div>

        </div>

        {/* DIVIDER */}
        <div className="border-t border-white/15 mt-12 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
          {/* SOCIAL */}
          <div className="flex gap-3">
            {[
              { icon: FaFacebookF, href: "https://facebook.com" },
              { icon: FaInstagram, href: "https://instagram.com" },
              { icon: FaYoutube, href: "https://youtube.com" },
              { icon: FaTwitter, href: "https://twitter.com" },
            ].map((soc, idx) => (
              <a
                key={idx}
                href={soc.href}
                target="_blank"
                rel="noopener noreferrer"
                className="w-10 h-10 border border-white/20 rounded-full flex items-center justify-center hover:bg-white/20 hover:border-white/50 transition duration-200 cursor-pointer shadow-xs text-white"
              >
                <soc.icon className="w-4 h-4" />
              </a>
            ))}
          </div>

          <p className="text-sm text-gray-300 text-center sm:text-right font-medium">
            © 2026 PC Fatayat NU Kabupaten Sukabumi. All rights reserved.
          </p>
        </div>
      </div>
    </footer>
  );
}

export default Footer;