import { useState, useEffect } from "react";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";

function DataPAC() {
  const [pacs, setPacs] = useState([]);
  const [loading, setLoading] = useState(true);
  const [search, setSearch] = useState("");
  const [statusFilter, setStatusFilter] = useState("Semua");

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
        // Fallback mock data jika API offline
        setPacs([
          {
            nama_pac: "PAC Cibadak",
            kecamatan: "Cibadak",
            status: "aktif",
            tanggal_berdiri: "2018-04-12",
            ketua_pac: "Hj. Laila Sari, S.Ag",
            telepon: "081234567890",
            jumlah_anggota: 247,
            total_kegiatan: 18,
            nomor_sk: "SK-012/PC/FN/SKB/2024",
            deskripsi: "Pimpinan Anak Cabang Fatayat NU Kecamatan Cibadak yang aktif membina majelis taklim dan UMKM keputrian."
          },
          {
            nama_pac: "PAC Cicurug",
            kecamatan: "Cicurug",
            status: "aktif",
            tanggal_berdiri: "2019-08-20",
            ketua_pac: "Siti Maryam, S.Pd",
            telepon: "082345678901",
            jumlah_anggota: 198,
            total_kegiatan: 15,
            nomor_sk: "SK-015/PC/FN/SKB/2024",
            deskripsi: "Pimpinan Anak Cabang Fatayat NU Kecamatan Cicurug, fokus pada pelatihan keterampilan remaja putri."
          },
          {
            nama_pac: "PAC Parungkuda",
            kecamatan: "Parungkuda",
            status: "aktif",
            tanggal_berdiri: "2020-01-15",
            ketua_pac: "Fatimah Azzahra, M.Pd",
            telepon: "083456789012",
            jumlah_anggota: 156,
            total_kegiatan: 12,
            nomor_sk: "SK-022/PC/FN/SKB/2024",
            deskripsi: "Pimpinan Anak Cabang Fatayat NU Kecamatan Parungkuda, aktif menyelenggarakan kajian fiqih wanita."
          }
        ]);
        setLoading(false);
      });
  }, []);

  const filteredPacs = pacs.filter((pac) => {
    const matchesSearch =
      pac.nama_pac.toLowerCase().includes(search.toLowerCase()) ||
      pac.kecamatan.toLowerCase().includes(search.toLowerCase());

    const matchesStatus =
      statusFilter === "Semua" || pac.status.toLowerCase() === statusFilter.toLowerCase();

    return matchesSearch && matchesStatus;
  });

  return (
    <div className="bg-[#f6f8f7] min-h-screen">
      <Navbar />

      {/* HERO */}
      <section className="px-20 pt-24 pb-14 border-b border-[#E5E7EB]">
        <div className="text-center">
          <div className="inline-flex items-center gap-2 bg-[#eef3f0] text-[#1f7a4d] px-4 py-1 rounded-full text-sm font-medium">
            📋 Pimpinan Anak Cabang
          </div>
          <h1 className="text-[64px] font-semibold text-[#1F2937] mt-4 leading-tight">
            Data PAC Sukabumi
          </h1>
          <p className="text-[20px] text-[#9CA3AF] leading-[1.8] mt-5 max-w-[760px] mx-auto">
            Daftar pengurus dan sebaran Pimpinan Anak Cabang (PAC) Fatayat NU di wilayah Kabupaten Sukabumi
          </p>
        </div>

        {/* SEARCH & FILTER */}
        <div className="max-w-[1280px] mx-auto mt-20 flex flex-col md:flex-row gap-4 items-center">
          <div className="w-full md:flex-1 h-[58px] bg-white border border-[#E5E7EB] rounded-[18px] px-6 flex items-center shadow-sm">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              className="w-5 h-5 text-[#9CA3AF]"
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
              className="ml-4 w-full bg-transparent outline-none text-[16px] text-[#374151] placeholder:text-[#B0B7C3]"
            />
          </div>

          <div className="flex gap-2 w-full md:w-auto">
            {["Semua", "Aktif", "Tidak_Aktif", "Pending"].map((status) => (
              <button
                key={status}
                onClick={() => setStatusFilter(status)}
                className={`h-[58px] px-6 rounded-[18px] text-[15px] font-medium transition duration-200 shadow-sm border ${
                  statusFilter === status
                    ? "bg-[#1f7a4d] text-white border-[#1f7a4d]"
                    : "bg-white border-[#E5E7EB] text-[#6B7280] hover:border-[#1f7a4d] hover:text-[#1f7a4d]"
                }`}
              >
                {status === "Tidak_Aktif" ? "Tidak Aktif" : status}
              </button>
            ))}
          </div>
        </div>
      </section>

      {/* GRID LIST */}
      <section className="px-20 py-24">
        <div className="max-w-[1280px] mx-auto">
          {loading ? (
            <div className="text-center py-20 text-gray-500">Memuat data PAC...</div>
          ) : filteredPacs.length === 0 ? (
            <div className="text-center py-20 text-gray-400 bg-white rounded-3xl border border-gray-200">
              Tidak ada data PAC yang cocok dengan filter pencarian.
            </div>
          ) : (
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {filteredPacs.map((pac, i) => (
                <div
                  key={i}
                  className="bg-white rounded-3xl p-8 border border-gray-200 shadow-sm hover:shadow-lg transition duration-300 flex flex-col justify-between"
                >
                  <div>
                    {/* Header */}
                    <div className="flex justify-between items-start mb-6">
                      <div>
                        <h3 className="text-2xl font-semibold text-gray-900">{pac.nama_pac}</h3>
                        <p className="text-sm text-gray-400 mt-1">📍 Kecamatan {pac.kecamatan}</p>
                      </div>
                      <span
                        className={`text-xs font-semibold px-3 py-1.5 rounded-full ${
                          pac.status === "aktif"
                            ? "bg-green-50 text-green-700"
                            : pac.status === "pending"
                            ? "bg-amber-50 text-amber-600 border border-amber-200"
                            : "bg-gray-100 text-gray-500"
                        }`}
                      >
                        {pac.status === "aktif" ? "Aktif" : pac.status === "pending" ? "Pending" : "Tidak Aktif"}
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
                          <p className="text-sm font-mono text-gray-700 bg-gray-50 px-2 py-1 rounded border border-gray-100 inline-block">{pac.nomor_sk}</p>
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
                  <div className="mt-8 border-t border-gray-100 pt-6">
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
                    
                    <a
                      href={`https://wa.me/${pac.telepon?.replace(/[^0-9]/g, "")}`}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="block text-center w-full py-3.5 border border-gray-200 rounded-2xl text-sm font-medium text-gray-700 hover:bg-[#1f7a4d] hover:text-white hover:border-[#1f7a4d] transition duration-300"
                    >
                      Hubungi PAC
                    </a>
                  </div>
                </div>
              ))}
            </div>
          )}
        </div>
      </section>

      <Footer />
    </div>
  );
}

export default DataPAC;
