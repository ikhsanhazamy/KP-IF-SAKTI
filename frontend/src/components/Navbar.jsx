import { NavLink } from "react-router-dom";
import { FiMenu, FiX } from "react-icons/fi";
import FatayatLogo from "../assets/icons/Fatayat Logo.svg";
import { useState } from "react";

function Navbar() {
  const [menuOpen, setMenuOpen] = useState(false);
  const adminLoginUrl = import.meta.env.VITE_ADMIN_URL || "/login";

  return (
    <nav className="w-full bg-[#f6f8f7]/90 backdrop-blur-md border-b border-gray-200/80 sticky top-0 z-50 transition-all duration-200">
      <div className="section-container h-[76px] flex items-center justify-between">

        {/* LEFT - LOGO & BRAND */}
        <NavLink to="/" className="flex items-center gap-3 group">
          <img
            src={FatayatLogo}
            alt="Logo Fatayat NU"
            className="h-[46px] w-auto transition-transform group-hover:scale-105"
          />
          <div>
            <p className="text-base font-bold text-gray-900 leading-tight tracking-tight group-hover:text-[#0F5E3A] transition">
              Fatayat NU
            </p>
            <p className="text-[11px] text-gray-500 font-medium leading-tight">
              PC Fatayat Nahdlatul Ulama Kab. Sukabumi
            </p>
          </div>
        </NavLink>

        {/* CENTER — NAVIGATION LINKS */}
        <div className="hidden md:flex items-center gap-1 text-[15px] font-semibold">
          {[
            { path: "/", label: "Beranda" },
            { path: "/tentang", label: "Tentang" },
            { path: "/data-pac", label: "Data PAC" },
            { path: "/pengajuan-data-pac", label: "Pengajuan PAC" },
            { path: "/kegiatan", label: "Kegiatan" },
          ].map((item) => (
            <NavLink
              key={item.path}
              to={item.path}
              className={({ isActive }) =>
                `px-4 py-2 rounded-lg transition-all duration-150 relative ${
                  isActive
                    ? "text-[#0F5E3A] bg-[#0F5E3A]/8 font-bold"
                    : "text-gray-600 hover:text-[#0F5E3A] hover:bg-gray-100/60"
                }`
              }
            >
              {item.label}
            </NavLink>
          ))}
        </div>

        {/* RIGHT - ACTION BUTTON */}
        <div className="hidden md:flex items-center">
          <a href={adminLoginUrl}>
            <button className="px-5 py-2.5 bg-[#0F5E3A] text-white rounded-xl text-sm font-semibold hover:bg-[#0D4E30] hover:shadow-md transition-all duration-200 cursor-pointer flex items-center gap-2">
              Admin Login
            </button>
          </a>
        </div>

        {/* HAMBURGER — MOBILE */}
        <button
          onClick={() => setMenuOpen(!menuOpen)}
          className="md:hidden p-2.5 text-gray-700 hover:text-[#0F5E3A] rounded-lg hover:bg-gray-100 transition"
          aria-label="Toggle menu"
        >
          {menuOpen ? <FiX size={24} /> : <FiMenu size={24} />}
        </button>
      </div>

      {/* MOBILE MENU */}
      {menuOpen && (
        <div className="md:hidden bg-white border-b border-gray-200 px-4 py-5 flex flex-col gap-2 shadow-lg animate-in slide-in-from-top-2 duration-200">
          {[
            { path: "/", label: "Beranda" },
            { path: "/tentang", label: "Tentang" },
            { path: "/data-pac", label: "Data PAC" },
            { path: "/pengajuan-data-pac", label: "Pengajuan PAC" },
            { path: "/kegiatan", label: "Kegiatan" },
          ].map((item) => (
            <NavLink
              key={item.path}
              to={item.path}
              onClick={() => setMenuOpen(false)}
              className={({ isActive }) =>
                `block px-4 py-3 rounded-xl text-sm font-semibold transition ${
                  isActive ? "bg-[#0F5E3A]/10 text-[#0F5E3A]" : "text-gray-700 hover:bg-gray-50"
                }`
              }
            >
              {item.label}
            </NavLink>
          ))}

          <div className="mt-2 pt-2 border-t border-gray-100">
            <a href={adminLoginUrl}>
              <button className="w-full py-3 bg-[#0F5E3A] text-white rounded-xl text-sm font-semibold hover:bg-[#0D4E30] transition">
                Admin Login
              </button>
            </a>
          </div>
        </div>
      )}
    </nav>
  );
}

export default Navbar;
