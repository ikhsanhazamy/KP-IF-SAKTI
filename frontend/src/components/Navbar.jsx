import { useState, useRef, useEffect } from "react";
import { NavLink, Link, useLocation } from "react-router-dom";
import { ChevronDown, Menu, X, Users } from "lucide-react";
import FatayatLogo from "../assets/icons/Fatayat Logo.svg";

function Navbar() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [tentangDropdown, setTentangDropdown] = useState(false);
  const [mobileTentangOpen, setMobileTentangOpen] = useState(true);
  const dropdownRef = useRef(null);
  const timeoutRef = useRef(null);
  const location = useLocation();

  const isTentangActive =
    location.pathname.startsWith("/tentang") ||
    location.pathname.startsWith("/struktur-organisasi");
  const isStrukturActive = location.pathname.startsWith("/struktur-organisasi");

  // Close dropdown when clicking outside
  useEffect(() => {
    function handleClickOutside(event) {
      if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
        setTentangDropdown(false);
      }
    }
    document.addEventListener("mousedown", handleClickOutside);
    return () => document.removeEventListener("mousedown", handleClickOutside);
  }, []);

  const handleMouseEnter = () => {
    if (timeoutRef.current) clearTimeout(timeoutRef.current);
    setTentangDropdown(true);
  };

  const handleMouseLeave = () => {
    timeoutRef.current = setTimeout(() => {
      setTentangDropdown(false);
    }, 180);
  };

  const handleTentangClick = () => {
    setTentangDropdown(false);
    setMenuOpen(false);

    if (location.pathname === "/tentang") {
      window.scrollTo({ top: 0, behavior: "smooth" });
    }
  };

  const handleStrukturClick = () => {
    setTentangDropdown(false);
    setMenuOpen(false);
    window.scrollTo({ top: 0, behavior: "smooth" });
  };

  return (
    <nav className="w-full bg-[#f6f8f7]/95 backdrop-blur-md border-b border-gray-200/80 sticky top-0 z-50 transition-all duration-200">
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
        <div className="hidden md:flex items-center gap-1.5 text-[15px] font-semibold">
          {/* BERANDA */}
          <NavLink
            to="/"
            className={({ isActive }) =>
              `px-4 py-2 rounded-xl transition-all duration-150 ${
                isActive
                  ? "text-[#0F5E3A] bg-[#0F5E3A]/8 font-bold shadow-2xs"
                  : "text-gray-600 hover:text-[#0F5E3A] hover:bg-gray-100/70"
              }`
            }
          >
            Beranda
          </NavLink>

          {/* TENTANG WITH SUBMENU STRUKTUR ORGANISASI */}
          <div
            ref={dropdownRef}
            className="relative"
            onMouseEnter={handleMouseEnter}
            onMouseLeave={handleMouseLeave}
          >
            <div className="flex items-center">
              <NavLink
                to="/tentang"
                onClick={handleTentangClick}
                className={() =>
                  `px-4 py-2 rounded-xl transition-all duration-150 inline-flex items-center gap-1.5 ${
                    isTentangActive || tentangDropdown
                      ? "text-[#0F5E3A] bg-[#0F5E3A]/8 font-bold shadow-2xs"
                      : "text-gray-600 hover:text-[#0F5E3A] hover:bg-gray-100/70"
                  }`
                }
              >
                <span>Tentang</span>
                <ChevronDown
                  size={15}
                  className={`transition-transform duration-200 text-[#0F5E3A] ${
                    tentangDropdown ? "rotate-180" : ""
                  }`}
                />
              </NavLink>
            </div>

            {/* DROPDOWN MENU */}
            {tentangDropdown && (
              <div className="absolute left-0 top-full pt-1.5 w-[250px] z-50 animate-in fade-in-0 zoom-in-95 duration-150">
                <div className="rounded-2xl bg-white border border-gray-100 p-2 shadow-[0_16px_40px_rgba(0,0,0,0.1)]">
                  <div className="px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-gray-400 border-b border-gray-100 mb-1">
                    Sub Menu
                  </div>
                  <Link
                    to="/struktur-organisasi"
                    onClick={handleStrukturClick}
                    className={`group flex items-center gap-3 rounded-xl p-2.5 transition-all duration-150 ${
                      isStrukturActive
                        ? "bg-[#0F5E3A]/10 text-[#0F5E3A]"
                        : "hover:bg-[#0F5E3A]/8"
                    }`}
                  >
                    <div className="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-[#eef3f0] text-[#0F5E3A] group-hover:bg-[#0F5E3A] group-hover:text-white transition-colors">
                      <Users size={18} />
                    </div>
                    <div>
                      <span className="text-sm font-bold text-gray-900 group-hover:text-[#0F5E3A] transition block leading-tight">
                        Struktur Organisasi
                      </span>
                      <span className="text-[11px] text-gray-400 font-normal mt-0.5 block">
                        Halaman Khusus Pengurus
                      </span>
                    </div>
                  </Link>
                </div>
              </div>
            )}
          </div>

          {/* PENGAJUAN PAC */}
          <NavLink
            to="/pengajuan-data-pac"
            className={({ isActive }) =>
              `px-4 py-2 rounded-xl transition-all duration-150 ${
                isActive
                  ? "text-[#0F5E3A] bg-[#0F5E3A]/8 font-bold shadow-2xs"
                  : "text-gray-600 hover:text-[#0F5E3A] hover:bg-gray-100/70"
              }`
            }
          >
            Pengajuan PAC
          </NavLink>

          {/* KEGIATAN */}
          <NavLink
            to="/kegiatan"
            className={({ isActive }) =>
              `px-4 py-2 rounded-xl transition-all duration-150 ${
                isActive
                  ? "text-[#0F5E3A] bg-[#0F5E3A]/8 font-bold shadow-2xs"
                  : "text-gray-600 hover:text-[#0F5E3A] hover:bg-gray-100/70"
              }`
            }
          >
            Kegiatan
          </NavLink>
        </div>

        {/* HAMBURGER — MOBILE */}
        <button
          onClick={() => setMenuOpen(!menuOpen)}
          className="md:hidden p-2.5 text-gray-700 hover:text-[#0F5E3A] rounded-lg hover:bg-gray-100 transition"
          aria-label="Toggle menu"
        >
          {menuOpen ? <X size={24} /> : <Menu size={24} />}
        </button>
      </div>

      {/* MOBILE MENU */}
      {menuOpen && (
        <div className="md:hidden bg-white border-b border-gray-200 px-4 py-5 flex flex-col gap-2 shadow-lg animate-in slide-in-from-top-2 duration-200 max-h-[85vh] overflow-y-auto">
          {/* BERANDA */}
          <NavLink
            to="/"
            onClick={() => setMenuOpen(false)}
            className={({ isActive }) =>
              `block px-4 py-3 rounded-xl text-sm font-semibold transition ${
                isActive ? "bg-[#0F5E3A]/10 text-[#0F5E3A]" : "text-gray-700 hover:bg-gray-50"
              }`
            }
          >
            Beranda
          </NavLink>

          {/* TENTANG WITH SUBMENU */}
          <div className="rounded-xl border border-gray-100 bg-[#F9FBFA] overflow-hidden">
            <div className="flex items-center justify-between">
              <NavLink
                to="/tentang"
                onClick={handleTentangClick}
                className={() =>
                  `flex-1 px-4 py-3 text-sm font-semibold transition ${
                    location.pathname === "/tentang"
                      ? "text-[#0F5E3A] font-bold"
                      : "text-gray-800 hover:text-[#0F5E3A]"
                  }`
                }
              >
                Tentang
              </NavLink>
              <button
                type="button"
                onClick={() => setMobileTentangOpen(!mobileTentangOpen)}
                className="px-4 py-3 text-gray-500 hover:text-[#0F5E3A] transition"
                aria-label="Toggle Sub Menu"
              >
                <ChevronDown
                  size={18}
                  className={`transition-transform duration-200 ${
                    mobileTentangOpen ? "rotate-180 text-[#0F5E3A]" : ""
                  }`}
                />
              </button>
            </div>

            {/* MOBILE SUBMENU: STRUKTUR ORGANISASI */}
            {mobileTentangOpen && (
              <div className="border-t border-gray-200/70 bg-white px-2 py-2">
                <Link
                  to="/struktur-organisasi"
                  onClick={handleStrukturClick}
                  className={`flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs font-semibold transition ${
                    isStrukturActive
                      ? "bg-[#0F5E3A]/10 text-[#0F5E3A]"
                      : "text-gray-700 hover:bg-[#0F5E3A]/8 hover:text-[#0F5E3A]"
                  }`}
                >
                  <div className="flex h-7 w-7 items-center justify-center rounded-lg bg-[#eef3f0] text-[#0F5E3A]">
                    <Users size={15} />
                  </div>
                  <div>
                    <div className="font-bold text-gray-900">Struktur Organisasi</div>
                    <div className="text-[10px] text-gray-400">Halaman Khusus Pengurus</div>
                  </div>
                </Link>
              </div>
            )}
          </div>

          {/* PENGAJUAN PAC */}
          <NavLink
            to="/pengajuan-data-pac"
            onClick={() => setMenuOpen(false)}
            className={({ isActive }) =>
              `block px-4 py-3 rounded-xl text-sm font-semibold transition ${
                isActive ? "bg-[#0F5E3A]/10 text-[#0F5E3A]" : "text-gray-700 hover:bg-gray-50"
              }`
            }
          >
            Pengajuan PAC
          </NavLink>

          {/* KEGIATAN */}
          <NavLink
            to="/kegiatan"
            onClick={() => setMenuOpen(false)}
            className={({ isActive }) =>
              `block px-4 py-3 rounded-xl text-sm font-semibold transition ${
                isActive ? "bg-[#0F5E3A]/10 text-[#0F5E3A]" : "text-gray-700 hover:bg-gray-50"
              }`
            }
          >
            Kegiatan
          </NavLink>
        </div>
      )}
    </nav>
  );
}

export default Navbar;
