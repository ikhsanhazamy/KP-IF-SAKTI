import { NavLink } from "react-router-dom";

function Navbar() {
  return (
    <nav className="w-full bg-[#f6f8f7] border-b border-gray-200">
      <div className="max-w-7xl mx-auto px-20 h-[72px] flex items-center justify-between">

        {/* LEFT */}
        <div className="flex items-center">
          <div className="w-10 h-10 bg-[#1f7a4d] rounded-full flex items-center justify-center text-white text-sm font-semibold">
            FN
          </div>

          <div className="ml-3">
            <p className="text-sm font-semibold text-gray-900 leading-none">
              Fatayat NU
            </p>
            <p className="text-xs text-gray-400 leading-none">
              Sukabumi
            </p>
          </div>
        </div>

        {/* CENTER MENU */}
        <div className="flex items-center gap-12 text-[16px]">

  <NavLink
    to="/"
    className={({ isActive }) =>
      isActive
        ? "text-[#1f7a4d] font-medium"
        : "text-gray-600 hover:text-black"
    }
  >
    Beranda
  </NavLink>

  <NavLink
    to="/tentang"
    className={({ isActive }) =>
      isActive
        ? "text-[#1f7a4d] font-medium"
        : "text-gray-600 hover:text-black"
    }
  >
    Tentang
  </NavLink>

  <NavLink
    to="/data-pac"
    className={({ isActive }) =>
      isActive
        ? "text-[#1f7a4d] font-medium"
        : "text-gray-600 hover:text-black"
    }
  >
    Data PAC
  </NavLink>

  <NavLink
    to="/kegiatan"
    className={({ isActive }) =>
      isActive
        ? "text-[#1f7a4d] font-medium"
        : "text-gray-600 hover:text-black"
    }
  >
    Kegiatan
  </NavLink>

</div>

        {/* RIGHT */}
        <button className="w-[200px] h-[40px] bg-[#1f7a4d] text-white rounded-[12px] text-sm font-medium hover:bg-[#17633f] transition flex items-center justify-center">
          Dashboard Login
        </button>

      </div>
    </nav>
  );
}

export default Navbar;