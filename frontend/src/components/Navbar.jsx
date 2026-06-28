import { NavLink } from "react-router-dom";
import { FiChevronDown, FiMenu, FiX } from "react-icons/fi";
import FatayatLogo from "../assets/icons/Fatayat Logo.svg";
import { useState } from "react";

function Navbar() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [dataPacOpen, setDataPacOpen] = useState(false);

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

          {/* DATA PAC */}
          <div className="relative group">
            <button className="flex items-center gap-1 text-gray-600 hover:text-[#1f7a4d] transition">
              Data PAC
              <FiChevronDown className="text-[17px] group-hover:rotate-180 transition duration-200" />
            </button>

            {/* DROPDOWN */}
            <div className="absolute left-1/2 -translate-x-1/2 top-[42px] w-[240px] bg-white border border-gray-200 rounded-2xl shadow-xl opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-200 overflow-hidden z-50">
              <NavLink
                to="/data-pac"
                className="block px-5 py-4 text-sm text-gray-700 hover:bg-[#f6f8f7] transition"
              >
                Data PAC
              </NavLink>
              <NavLink
                to="/pengajuan-data-pac"
                className="block px-5 py-4 text-sm text-gray-700 hover:bg-[#f6f8f7] transition"
              >
                Pengajuan Data PAC
              </NavLink>
            </div>
          </div>

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

          {/* DATA PAC ACCORDION */}
          <div>
            <button
              onClick={() => setDataPacOpen(!dataPacOpen)}
              className="w-full flex items-center justify-between px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition"
            >
              Data PAC
              <FiChevronDown
                className={`text-[17px] transition duration-200 ${dataPacOpen ? "rotate-180" : ""}`}
              />
            </button>
            {dataPacOpen && (
              <div className="pl-6 flex flex-col gap-1 mt-1">
                <NavLink
                  to="/data-pac"
                  onClick={() => { setMenuOpen(false); setDataPacOpen(false); }}
                  className={({ isActive }) =>
                    `block px-4 py-2 rounded-xl text-sm transition ${
                      isActive ? "text-[#1f7a4d]" : "text-gray-600 hover:bg-gray-100"
                    }`
                  }
                >
                  Data PAC
                </NavLink>
                <NavLink
                  to="/pengajuan-data-pac"
                  onClick={() => { setMenuOpen(false); setDataPacOpen(false); }}
                  className={({ isActive }) =>
                    `block px-4 py-2 rounded-xl text-sm transition ${
                      isActive ? "text-[#1f7a4d]" : "text-gray-600 hover:bg-gray-100"
                    }`
                  }
                >
                  Pengajuan Data PAC
                </NavLink>
              </div>
            )}
          </div>

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