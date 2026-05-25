import { NavLink } from "react-router-dom";
import { FiChevronDown } from "react-icons/fi";
import FatayatLogo from "../assets/icons/Fatayat Logo.svg";

function Navbar() {
  return (
    <nav className="w-full bg-[#f6f8f7] border-b border-gray-200 sticky top-0 z-50">
      <div className="max-w-7xl mx-auto px-20 h-[72px] flex items-center justify-between">

        {/* LEFT */}
        <div className="flex items-center">

          <img
            src={FatayatLogo}
            alt="Logo Fatayat NU"
            className="h-[52px] w-auto"
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

        {/* CENTER */}
        <div className="flex items-center gap-12 text-[15px] font-medium">

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
        <button className="w-[200px] h-[40px] bg-[#1f7a4d] text-white rounded-[12px] text-sm font-medium hover:bg-[#17633f] hover:shadow-lg transition-all duration-200">
          Admin Login
        </button>

      </div>
    </nav>
  );
}

export default Navbar;