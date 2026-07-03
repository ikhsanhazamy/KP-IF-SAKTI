import { NavLink } from "react-router-dom";
import { FiMenu, FiX } from "react-icons/fi";
import FatayatLogo from "../assets/icons/Fatayat Logo.svg";
import { useState } from "react";

function Navbar() {
  const [menuOpen, setMenuOpen] = useState(false);

  return (
    <nav className="w-full bg-[#f6f8f7] border-b border-gray-200 sticky top-0 z-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-8 lg:px-20 h-[72px] flex items-center justify-between">

        {/* LEFT */}
        <div className="flex items-center">
          <img
            src={FatayatLogo}
            alt="Logo Fatayat NU"
            className="h-[48px] w-auto"
          />
          <div className="ml-3">
            <p className="text-sm font-semibold text-gray-900 leading-none">
              Fatayat NU
            </p>
            <p className="text-[11px] text-gray-400 leading-none mt-1">
              Pimpinan Cabang
              <br />
              Fatayat Nahdlatul Ulama
              <br />
              Kabupaten Sukabumi
            </p>
          </div>
        </div>

        {/* CENTER — hidden di mobile */}
        <div className="hidden md:flex items-center gap-8 lg:gap-12 text-[15px] font-medium">
          <NavLink
            to="/"
            className={({ isActive }) =>
              isActive
                ? "text-[#1f7a4d]"
                : "text-gray-600 hover:text-[#1f7a4d] transition"
            }
          >
            Beranda
          </NavLink>

          <NavLink
            to="/tentang"
            className={({ isActive }) =>
              isActive
                ? "text-[#1f7a4d]"
                : "text-gray-600 hover:text-[#1f7a4d] transition"
            }
          >
            Tentang
          </NavLink>

          <NavLink
            to="/pengajuan-data-pac"
            className={({ isActive }) =>
              isActive
                ? "text-[#1f7a4d]"
                : "text-gray-600 hover:text-[#1f7a4d] transition"
            }
          >
            Pengajuan PAC
          </NavLink>

          <NavLink
            to="/kegiatan"
            className={({ isActive }) =>
              isActive
                ? "text-[#1f7a4d]"
                : "text-gray-600 hover:text-[#1f7a4d] transition"
            }
          >
            Kegiatan
          </NavLink>
        </div>

        {/* RIGHT */}
        <div className="hidden md:flex">
          <a href="http://localhost:8000/login" target="_blank" rel="noopener noreferrer">
            <button className="w-[160px] lg:w-[200px] h-[40px] bg-[#1f7a4d] text-white rounded-[12px] text-sm font-medium hover:bg-[#17633f] hover:shadow-lg transition-all duration-200">
              Admin Login
            </button>
          </a>
        </div>

        {/* HAMBURGER — hanya mobile */}
        <button
          onClick={() => setMenuOpen(!menuOpen)}
          className="md:hidden p-2 text-gray-600 hover:text-[#1f7a4d] transition"
          aria-label="Toggle menu"
        >
          {menuOpen ? <FiX size={24} /> : <FiMenu size={24} />}
        </button>
      </div>

      {/* MOBILE MENU */}
      {menuOpen && (
        <div className="md:hidden bg-[#f6f8f7] border-t border-gray-200 px-4 py-4 flex flex-col gap-1">
          <NavLink
            to="/"
            onClick={() => setMenuOpen(false)}
            className={({ isActive }) =>
              `block px-4 py-3 rounded-xl text-sm font-medium transition ${
                isActive ? "bg-[#eef3f0] text-[#1f7a4d]" : "text-gray-700 hover:bg-gray-100"
              }`
            }
          >
            Beranda
          </NavLink>

          <NavLink
            to="/tentang"
            onClick={() => setMenuOpen(false)}
            className={({ isActive }) =>
              `block px-4 py-3 rounded-xl text-sm font-medium transition ${
                isActive ? "bg-[#eef3f0] text-[#1f7a4d]" : "text-gray-700 hover:bg-gray-100"
              }`
            }
          >
            Tentang
          </NavLink>

          <NavLink
            to="/pengajuan-data-pac"
            onClick={() => setMenuOpen(false)}
            className={({ isActive }) =>
              `block px-4 py-3 rounded-xl text-sm font-medium transition ${
                isActive ? "bg-[#eef3f0] text-[#1f7a4d]" : "text-gray-700 hover:bg-gray-100"
              }`
            }
          >
            Pengajuan PAC
          </NavLink>

          <NavLink
            to="/kegiatan"
            onClick={() => setMenuOpen(false)}
            className={({ isActive }) =>
              `block px-4 py-3 rounded-xl text-sm font-medium transition ${
                isActive ? "bg-[#eef3f0] text-[#1f7a4d]" : "text-gray-700 hover:bg-gray-100"
              }`
            }
          >
            Kegiatan
          </NavLink>

          <div className="mt-2 px-4">
            <a href="http://localhost:8000/login" target="_blank" rel="noopener noreferrer">
              <button className="w-full h-[44px] bg-[#1f7a4d] text-white rounded-xl text-sm font-medium hover:bg-[#17633f] transition">
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
