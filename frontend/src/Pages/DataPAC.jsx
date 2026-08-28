import { useState, useEffect } from "react";
import { useLocation, Link } from "react-router-dom";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import { formatWhatsAppUrl } from "../lib/utils";

function DataPAC() {
  const [pacs, setPacs] = useState([]);
  const [loading, setLoading] = useState(true);
  const [search, setSearch] = useState("");
  const [statusFilter, setStatusFilter] = useState("Semua");
  const [selectedPac, setSelectedPac] = useState(null);
  const [kegiatanList, setKegiatanList] = useState([]);

  const location = useLocation();

  // Parse search query parameter from URL on load/change
  useEffect(() => {
    const queryParams = new URLSearchParams(location.search);
    const searchQuery = queryParams.get("search");
    if (searchQuery) {
      setSearch(searchQuery);
    }
  }, [location]);

  // Load PAC Data
  useEffect(() => {
    fetch("/api/pac")
      .then((res) => {
        if (!res.ok) throw new Error("Failed to fetch PAC");
        return res.json();
      })
      .then((data) => {
        setPacs(data);
        setLoading(false);
      })
      .catch((err) => {
        console.error(err);
        setPacs([
          {
            nama_pac: "PAC Cibadak",
            kecamatan: "Cibadak",
            status: "aktif",
            tanggal_berdiri: "2018-04-12",
            ketua_pac: "Hj. Laila Sari, S.Ag",
            telepon: "081234567890",
            email: "pac.cibadak@fatayatnu.or.id",
            jumlah_anggota: 247,
            total_kegiatan: 18,
            nomor_sk: "SK-012/PC/FN/SKB/2024",
            alamat: "Jl. Perintis Kemerdekaan No. 45, Cibadak",
            desa: "Cibadak",
            kode_pos: "43351",
            deskripsi: "Pimpinan Anak Cabang Fatayat NU Kecamatan Cibadak yang aktif membina majelis taklim dan UMKM keputrian."
          },
          {
            nama_pac: "PAC Cicurug",
            kecamatan: "Cicurug",
            status: "aktif",
            tanggal_berdiri: "2019-08-20",
            ketua_pac: "Siti Maryam, S.Pd",
            telepon: "082345678901",
            email: "pac.cicurug@fatayatnu.or.id",
            jumlah_anggota: 198,
            total_kegiatan: 15,
            nomor_sk: "SK-015/PC/FN/SKB/2024",
            alamat: "Jl. Siliwangi No. 112, Cicurug",
            desa: "Cicurug",
            kode_pos: "43359",
            deskripsi: "Pimpinan Anak Cabang Fatayat NU Kecamatan Cicurug, fokus pada pelatihan keterampilan remaja putri."
          },
          {
            nama_pac: "PAC Parungkuda",
            kecamatan: "Parungkuda",
            status: "aktif",
            tanggal_berdiri: "2020-01-15",
            ketua_pac: "Fatimah Azzahra, M.Pd",
            telepon: "083456789012",
            email: "pac.parungkuda@fatayatnu.or.id",
            jumlah_anggota: 156,
            total_kegiatan: 12,
            nomor_sk: "SK-022/PC/FN/SKB/2024",
            alamat: "Jl. Raya Parungkuda No. 78, Parungkuda",
            desa: "Parungkuda",
            kode_pos: "43357",
            deskripsi: "Pimpinan Anak Cabang Fatayat NU Kecamatan Parungkuda, aktif menyelenggarakan kajian fiqih wanita."
          }
        ]);
        setLoading(false);
      });
  }, []);

  // Load Kegiatan list for Modal reference
  useEffect(() => {
    fetch("/api/kegiatan")
      .then((res) => {
        if (!res.ok) throw new Error("Gagal mengambil kegiatan");
        return res.json();
      })
      .then((data) => {
        setKegiatanList(data);
      })
      .catch((err) => {
        console.error(err);
        setKegiatanList([
          { id: 1, judul: "Seminar Pemberdayaan Perempuan dan Kewirausahaan", tanggal: "2026-05-15", kategori: "Seminar", pac: { nama_pac: "PAC Cibadak" } },
          { id: 2, judul: "Bakti Sosial dan Santunan Anak Yatim", tanggal: "2026-05-08", kategori: "Sosial", pac: { nama_pac: "PAC Cicurug" } },
          { id: 3, judul: "Pelatihan Kaderisasi dan Leadership", tanggal: "2026-05-01", kategori: "Pelatihan", pac: { nama_pac: "PAC Parungkuda" } },
          { id: 4, judul: "Rapat Koordinasi PAC Se-Sukabumi", tanggal: "2026-04-22", kategori: "Rapat", pac: { nama_pac: "PC Fatayat NU" } },
          { id: 5, judul: "Workshop Manajemen Organisasi Modern", tanggal: "2026-04-10", kategori: "Workshop", pac: { nama_pac: "PAC Cibadak" } },
          { id: 6, judul: "Kajian Rutin Keislaman dan Keputrian", tanggal: "2026-04-03", kategori: "Kajian", pac: { nama_pac: "PAC Cicurug" } }
        ]);
      });
  }, []);

  const formatTanggalDetail = (tanggal) => {
    if (!tanggal) return "-";
    return new Date(tanggal).toLocaleDateString('id-ID', {
      day: 'numeric', month: 'long', year: 'numeric'
    });
  };

  const filteredPacs = pacs.filter((pac) => {
    const matchesSearch =
      (pac.nama_pac || '').toLowerCase().includes(search.toLowerCase()) ||
      (pac.kecamatan || '').toLowerCase().includes(search.toLowerCase());

    const matchesStatus =
      statusFilter === "Semua" || (pac.status || '').toLowerCase() === statusFilter.toLowerCase();

    return matchesSearch && matchesStatus;
  });

  return (
    <div className="bg-[#f6f8f7] min-h-screen">
      <Navbar />

      {/* HERO */}
      <section className="px-4 sm:px-8 lg:px-20 pt-14 sm:pt-20 lg:pt-24 pb-10 sm:pb-14 border-b border-[#E5E7EB]">
        <div className="text-center">
          <div className="inline-flex items-center gap-2 bg-[#eef3f0] text-[#1f7a4d] px-4 py-1 rounded-full text-sm font-medium">
            📋 Pimpinan Anak Cabang
          </div>
          <h1 className="text-[36px] sm:text-[48px] lg:text-[64px] font-semibold text-[#1F2937] mt-4 leading-tight">
            Data PAC Sukabumi
          </h1>
          <p className="text-base sm:text-lg lg:text-[20px] text-[#9CA3AF] leading-[1.8] mt-4 sm:mt-5 max-w-[760px] mx-auto">
            Daftar pengurus dan sebaran Pimpinan Anak Cabang (PAC) Fatayat NU di wilayah Kabupaten Sukabumi
          </p>
        </div>

        {/* SEARCH & FILTER */}
        <div className="max-w-[1280px] mx-auto mt-10 sm:mt-16 lg:mt-20 flex flex-col gap-4">
          {/* Search bar */}
          <div className="w-full h-[52px] sm:h-[58px] bg-white border border-[#E5E7EB] rounded-[18px] px-4 sm:px-6 flex items-center shadow-sm">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              className="w-5 h-5 text-[#9CA3AF] flex-shrink-0"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              strokeWidth={2}
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"
              />
            </svg>
            <input
              type="text"
              placeholder="Cari PAC atau Kecamatan..."
              value={search}
              onChange={(e) => setSearch(e.target.value)}
              className="ml-4 w-full bg-transparent outline-none text-[15px] sm:text-[16px] text-[#374151] placeholder:text-[#B0B7C3]"
            />
          </div>

          {/* Filter buttons — wraps on mobile */}
          <div className="flex flex-wrap gap-2">
            {["Semua", "Aktif", "Tidak_Aktif", "Akan_Expire", "Pending"].map((status) => (
              <button
                key={status}
                onClick={() => setStatusFilter(status)}
                className={`h-[44px] sm:h-[52px] px-4 sm:px-6 rounded-[14px] sm:rounded-[18px] text-[14px] sm:text-[15px] font-medium transition duration-200 shadow-sm border ${
                  statusFilter === status
                    ? "bg-[#1f7a4d] text-white border-[#1f7a4d]"
                    : "bg-white border-[#E5E7EB] text-[#6B7280] hover:border-[#1f7a4d] hover:text-[#1f7a4d]"
                }`}
              >
                {status === "Tidak_Aktif" ? "Tidak Aktif" : status === "Akan_Expire" ? "Akan Expire" : status}
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* GRID LIST */}
      <section className="px-4 sm:px-8 lg:px-20 py-12 sm:py-16 lg:py-24">
        <div className="max-w-[1280px] mx-auto">
          {loading ? (
            <div className="text-center py-20 text-gray-500">Memuat data PAC...</div>
          ) : filteredPacs.length === 0 ? (
            <div className="text-center py-20 text-gray-400 bg-white rounded-3xl border border-gray-200">
              Tidak ada data PAC yang cocok dengan filter pencarian.
            </div>
          ) : (
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
              {filteredPacs.map((pac, i) => (
                <div
                  key={i}
                  className="bg-white rounded-3xl p-6 sm:p-8 border border-gray-200 shadow-sm hover:shadow-lg transition duration-300 flex flex-col justify-between"
                >
                  <div>
                    {/* Header */}
                    <div className="flex justify-between items-start mb-6">
                      <div>
                        <h3 className="text-xl sm:text-2xl font-semibold text-gray-900">{pac.nama_pac}</h3>
                        <p className="text-sm text-gray-400 mt-1">📍 Kecamatan {pac.kecamatan}</p>
                      </div>
                      <span
                        className={`text-xs font-semibold px-3 py-1.5 rounded-full flex-shrink-0 ml-2 ${
                          pac.status === "aktif"
                            ? "bg-green-50 text-green-700"
                            : pac.status === "pending"
                            ? "bg-amber-50 text-amber-600 border border-amber-200"
                            : pac.status === "akan_expire"
                            ? "bg-orange-50 text-orange-600 border border-orange-200"
                            : "bg-gray-100 text-gray-500"
                        }`}
                      >
                        {pac.status === "aktif" ? "Aktif" : pac.status === "pending" ? "Pending" : pac.status === "akan_expire" ? "Akan Expire" : "Tidak Aktif"}
                      </span>
                    </div>

                    {/* Meta Info */}
                    <div className="border-t border-gray-100 pt-6 space-y-4">
                      <div>
                        <p className="text-xs text-gray-400">Ketua PAC</p>
                        <p className="text-base font-medium text-gray-800">{pac.ketua_pac || "-"}</p>
                      </div>
                      {pac.nomor_sk && (
                        <div>
                          <p className="text-xs text-gray-400">Nomor SK</p>
                          <p className="text-sm font-mono text-gray-700 bg-gray-50 px-2 py-1 rounded border border-gray-100 inline-block break-all">
                            {pac.nomor_sk}
                          </p>
                        </div>
                      )}
                      {pac.deskripsi && (
                        <p className="text-sm text-gray-500 mt-4 leading-relaxed line-clamp-3">
                          {pac.deskripsi}
                        </p>
                      )}
                    </div>
                  </div>

                  {/* Stats & Footer */}
                  <div className="mt-6 sm:mt-8 border-t border-gray-100 pt-6">
                    <div className="grid grid-cols-2 gap-4 text-center mb-6">
                      <div className="bg-[#f6f8f7] rounded-2xl py-3 border border-gray-100">
                        <p className="text-xl font-bold text-gray-800">{pac.jumlah_anggota || 0}</p>
                        <p className="text-xs text-gray-400 mt-0.5">Anggota</p>
                      </div>
                      <div className="bg-[#f6f8f7] rounded-2xl py-3 border border-gray-100">
                        <p className="text-xl font-bold text-gray-800">{pac.total_kegiatan || 0}</p>
                        <p className="text-xs text-gray-400 mt-0.5">Kegiatan</p>
                      </div>
                    </div>
                    
                    <div className="flex gap-3">
                      <button
                        onClick={() => setSelectedPac(pac)}
                        className="flex-1 py-3 border border-[#1f7a4d] text-[#1f7a4d] rounded-2xl text-xs sm:text-sm font-semibold hover:bg-[#1f7a4d] hover:text-white transition duration-300 cursor-pointer"
                      >
                        Detail Profil
                      </button>
                      {pac.telepon && formatWhatsAppUrl(pac.telepon) ? (
                        <a
                          href={formatWhatsAppUrl(pac.telepon)}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="flex-1 block text-center py-3 border border-gray-200 rounded-2xl text-xs sm:text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-300"
                        >
                          Hubungi PAC
                        </a>
                      ) : (
                        <button
                          disabled
                          className="flex-1 block text-center py-3 border border-gray-100 rounded-2xl text-xs sm:text-sm font-medium text-gray-400 bg-gray-50 cursor-not-allowed"
                        >
                          Kontak Kosong
                        </button>
                      )}
                    </div>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      </section>

      {/* DETAIL MODAL */}
      {selectedPac && (
        <div className="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4 backdrop-blur-xs transition-opacity duration-300">
          <div className="bg-white rounded-3xl w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-2xl relative border border-gray-100 flex flex-col transform transition-transform duration-300">
            {/* Close Button */}
            <button
              onClick={() => setSelectedPac(null)}
              className="absolute top-5 right-5 text-gray-400 hover:text-gray-600 transition duration-200 p-2 rounded-full hover:bg-gray-100 cursor-pointer"
            >
              <svg xmlns="http://www.w3.org/2000/svg" className="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>

            {/* Modal Content */}
            <div className="p-6 sm:p-8">
              {/* Header */}
              <div className="mb-6">
                <span className={`inline-block text-xs font-semibold px-3 py-1.5 rounded-full mb-3 ${
                  selectedPac.status === "aktif"
                    ? "bg-green-50 text-green-700"
                    : selectedPac.status === "pending"
                    ? "bg-amber-50 text-amber-600 border border-amber-200"
                    : selectedPac.status === "akan_expire"
                    ? "bg-orange-50 text-orange-600 border border-orange-200"
                    : "bg-gray-100 text-gray-500"
                }`}>
                  {selectedPac.status === "aktif" ? "Aktif" : selectedPac.status === "pending" ? "Pending" : selectedPac.status === "akan_expire" ? "Akan Expire" : "Tidak Aktif"}
                </span>
                <h2 className="text-2xl sm:text-3xl font-bold text-gray-900">{selectedPac.nama_pac}</h2>
                <p className="text-gray-500 text-sm mt-1">📍 Kecamatan {selectedPac.kecamatan}</p>
              </div>

              {/* Grid Metrics */}
              <div className="grid grid-cols-2 gap-4 text-center mb-6">
                <div className="bg-[#f6f8f7] rounded-2xl py-4 border border-gray-100">
                  <p className="text-2xl font-black text-[#1f7a4d]">{selectedPac.jumlah_anggota || 0}</p>
                  <p className="text-xs text-gray-400 mt-1 uppercase font-bold tracking-wider">Total Anggota</p>
                </div>
                <div className="bg-[#f6f8f7] rounded-2xl py-4 border border-gray-100">
                  <p className="text-2xl font-black text-[#1f7a4d]">{selectedPac.total_kegiatan || 0}</p>
                  <p className="text-xs text-gray-400 mt-1 uppercase font-bold tracking-wider">Total Kegiatan</p>
                </div>
              </div>

              {/* Profile / Deskripsi */}
              {selectedPac.deskripsi && (
                <div className="mb-6">
                  <h3 className="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Profil Singkat</h3>
                  <p className="text-gray-600 text-sm sm:text-base leading-relaxed bg-[#f6f8f7]/50 p-4 rounded-2xl border border-gray-100">
                    {selectedPac.deskripsi}
                  </p>
                </div>
              )}

              {/* Detail Admin */}
              <div className="border-t border-gray-100 pt-6 space-y-4">
                <h3 className="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Informasi Administratif</h3>

                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <div>
                    <p className="text-xs text-gray-400 font-medium">Ketua PAC</p>
                    <p className="text-base font-semibold text-gray-800 mt-0.5">{selectedPac.ketua_pac || "-"}</p>
                  </div>
                  <div>
                    <p className="text-xs text-gray-400 font-medium">Nomor SK Kepengurusan</p>
                    <p className="text-sm font-mono text-gray-700 bg-gray-50 px-2 py-1 rounded border border-gray-100 inline-block mt-0.5 select-all">
                      {selectedPac.nomor_sk || "Belum Diterbitkan"}
                    </p>
                  </div>
                  <div>
                    <p className="text-xs text-gray-400 font-medium">Tanggal Berdiri</p>
                    <p className="text-sm font-semibold text-gray-800 mt-0.5">{formatTanggalDetail(selectedPac.tanggal_berdiri)}</p>
                  </div>
                  <div>
                    <p className="text-xs text-gray-400 font-medium">Email PAC</p>
                    <p className="text-sm font-semibold text-gray-800 mt-0.5">{selectedPac.email || "-"}</p>
                  </div>
                </div>

                <div className="pt-2">
                  <p className="text-xs text-gray-400 font-medium">Alamat Sekretariat</p>
                  <p className="text-sm text-[#374151] bg-[#f6f8f7]/30 p-3 rounded-xl border border-gray-100 mt-1">
                    {selectedPac.alamat || "-"}
                    {selectedPac.desa && `, Desa ${selectedPac.desa}`}
                    {selectedPac.kode_pos && `, ${selectedPac.kode_pos}`}
                  </p>
                </div>
              </div>

              {/* Kegiatan Terkait */}
              <div className="border-t border-gray-100 pt-6 mt-6">
                <h3 className="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Kegiatan Terkait</h3>
                {kegiatanList.filter(k => k.pac?.nama_pac === selectedPac.nama_pac).length === 0 ? (
                  <p className="text-sm text-gray-450 italic">Belum ada kegiatan tercatat untuk PAC ini.</p>
                ) : (
                  <div className="space-y-3">
                    {kegiatanList.filter(k => k.pac?.nama_pac === selectedPac.nama_pac).map((keg, idx) => (
                      <div key={idx} className="flex justify-between items-center bg-gray-50 border border-gray-100 rounded-xl p-3 hover:bg-white hover:border-[#1f7a4d]/20 transition duration-200">
                        <div>
                          <p className="text-sm font-semibold text-gray-800">{keg.judul || keg.title}</p>
                          <p className="text-xs text-gray-400 mt-0.5">📅 {keg.tanggal || keg.date}</p>
                        </div>
                        {keg.id && (
                          <Link
                            to={`/kegiatan/${keg.id}`}
                            className="text-xs font-semibold text-[#1f7a4d] hover:underline"
                          >
                            Lihat Detail →
                          </Link>
                        )}
                      </div>
                    ))}
                  </div>
                )}
              </div>

              {/* Action Buttons */}
              <div className="mt-8 pt-6 border-t border-gray-100 flex gap-4">
                {selectedPac.telepon && formatWhatsAppUrl(selectedPac.telepon) ? (
                  <a
                    href={formatWhatsAppUrl(selectedPac.telepon)}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="flex-1 text-center py-3 bg-[#1f7a4d] text-white rounded-2xl text-sm font-semibold hover:bg-[#17633d] transition duration-300"
                  >
                    Hubungi WhatsApp PAC
                  </a>
                ) : (
                  <button
                    disabled
                    className="flex-1 text-center py-3 bg-gray-100 text-gray-400 rounded-2xl text-sm font-semibold cursor-not-allowed"
                  >
                    Kontak WhatsApp Belum Tersedia
                  </button>
                )}
                <button
                  onClick={() => setSelectedPac(null)}
                  className="px-6 py-3 border border-gray-200 text-gray-600 rounded-2xl text-sm font-semibold hover:bg-gray-100 transition duration-300 cursor-pointer"
                >
                  Tutup
                </button>
              </div>

            </div>
          </div>
        </div>
      )}

      <Footer />
    </div>
  );
}

export default DataPAC;
