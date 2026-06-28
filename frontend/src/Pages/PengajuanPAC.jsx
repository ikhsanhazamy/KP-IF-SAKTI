import { useState } from "react";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";

function PengajuanPAC() {
  const [formData, setFormData] = useState({
    nama_pac: "",
    kecamatan: "",
    tanggal_berdiri: "",
    alamat: "",
    desa: "",
    kode_pos: "",
    ketua_pac: "",
    telepon: "",
    email: "",
    deskripsi: ""
  });

  const [loading, setLoading] = useState(false);
  const [alert, setAlert] = useState(null);

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    setLoading(true);
    setAlert(null);

    fetch("/api/pac/pengajuan", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(formData)
    })
      .then(async (res) => {
        const data = await res.json();
        if (!res.ok) throw new Error(data.message || "Gagal mengirim pengajuan");
        return data;
      })
      .then((data) => {
        setAlert({
          type: "success",
          message: data.message || "Pengajuan PAC berhasil dikirim dan menunggu persetujuan admin."
        });
        setFormData({
          nama_pac: "",
          kecamatan: "",
          tanggal_berdiri: "",
          alamat: "",
          desa: "",
          kode_pos: "",
          ketua_pac: "",
          telepon: "",
          email: "",
          deskripsi: ""
        });
      })
      .catch((err) => {
        setAlert({
          type: "error",
          message: err.message || "Terjadi kesalahan koneksi ke server."
        });
      })
      .finally(() => {
        setLoading(false);
      });
  };

  return (
    <div className="bg-[#f6f8f7] min-h-screen">
      <Navbar />

      <section className="px-4 sm:px-8 lg:px-20 py-12 sm:py-16 lg:py-24">
        <div className="max-w-3xl mx-auto">
          {/* Header */}
          <div className="text-center mb-10 sm:mb-12">
            <div className="inline-flex items-center gap-2 bg-[#eef3f0] text-[#1f7a4d] px-4 py-1 rounded-full text-sm font-medium">
              ✍️ Formulir Pendaftaran
            </div>
            <h1 className="text-2xl sm:text-3xl lg:text-4xl font-semibold text-gray-900 mt-4">
              Pengajuan Data PAC Baru
            </h1>
            <p className="text-gray-500 mt-3 leading-relaxed text-sm sm:text-base">
              Ajukan pembentukan atau pendaftaran Pimpinan Anak Cabang (PAC) baru untuk divalidasi oleh admin Fatayat NU Sukabumi.
            </p>
          </div>

          {/* Alert Notification */}
          {alert && (
            <div
              className={`p-5 rounded-2xl mb-8 flex items-start gap-3 border ${
                alert.type === "success"
                  ? "bg-green-50 text-green-800 border-green-200"
                  : "bg-red-50 text-red-800 border-red-200"
              }`}
            >
              <span className="text-xl">{alert.type === "success" ? "✅" : "⚠️"}</span>
              <p className="text-sm font-medium">{alert.message}</p>
            </div>
          )}

          {/* Form Card */}
          <div className="bg-white rounded-3xl p-6 sm:p-8 lg:p-10 border border-gray-200 shadow-sm">
            <form onSubmit={handleSubmit} className="space-y-6">
              
              <h2 className="text-lg sm:text-xl font-semibold text-gray-800 border-b border-gray-100 pb-4">
                Informasi PAC & Organisasi
              </h2>

              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-2">
                    Nama PAC <span className="text-red-500">*</span>
                  </label>
                  <input
                    type="text"
                    name="nama_pac"
                    required
                    placeholder="Contoh: PAC Cikidang"
                    value={formData.nama_pac}
                    onChange={handleChange}
                    className="w-full h-[52px] bg-gray-50 border border-gray-200 rounded-xl px-4 outline-none focus:border-[#1f7a4d] focus:bg-white transition text-sm text-gray-800"
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-2">
                    Kecamatan <span className="text-red-500">*</span>
                  </label>
                  <input
                    type="text"
                    name="kecamatan"
                    required
                    placeholder="Contoh: Cikidang"
                    value={formData.kecamatan}
                    onChange={handleChange}
                    className="w-full h-[52px] bg-gray-50 border border-gray-200 rounded-xl px-4 outline-none focus:border-[#1f7a4d] focus:bg-white transition text-sm text-gray-800"
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-2">
                    Tanggal Berdiri <span className="text-red-500">*</span>
                  </label>
                  <input
                    type="date"
                    name="tanggal_berdiri"
                    required
                    value={formData.tanggal_berdiri}
                    onChange={handleChange}
                    className="w-full h-[52px] bg-gray-50 border border-gray-200 rounded-xl px-4 outline-none focus:border-[#1f7a4d] focus:bg-white transition text-sm text-gray-800"
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-2">
                    Ketua PAC <span className="text-red-500">*</span>
                  </label>
                  <input
                    type="text"
                    name="ketua_pac"
                    required
                    placeholder="Nama Lengkap Ketua PAC"
                    value={formData.ketua_pac}
                    onChange={handleChange}
                    className="w-full h-[52px] bg-gray-50 border border-gray-200 rounded-xl px-4 outline-none focus:border-[#1f7a4d] focus:bg-white transition text-sm text-gray-800"
                  />
                </div>
              </div>

              <h2 className="text-lg sm:text-xl font-semibold text-gray-800 border-b border-gray-100 pt-4 sm:pt-6 pb-4">
                Kontak & Alamat Sekretariat
              </h2>

              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-2">
                    No. Telepon / WhatsApp <span className="text-red-500">*</span>
                  </label>
                  <input
                    type="tel"
                    name="telepon"
                    required
                    placeholder="Contoh: 0812xxxxxxxx"
                    value={formData.telepon}
                    onChange={handleChange}
                    className="w-full h-[52px] bg-gray-50 border border-gray-200 rounded-xl px-4 outline-none focus:border-[#1f7a4d] focus:bg-white transition text-sm text-gray-800"
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-2">
                    Email PAC
                  </label>
                  <input
                    type="email"
                    name="email"
                    placeholder="Contoh: pac.cikidang@example.com"
                    value={formData.email}
                    onChange={handleChange}
                    className="w-full h-[52px] bg-gray-50 border border-gray-200 rounded-xl px-4 outline-none focus:border-[#1f7a4d] focus:bg-white transition text-sm text-gray-800"
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-2">
                    Desa / Kelurahan
                  </label>
                  <input
                    type="text"
                    name="desa"
                    placeholder="Nama Desa"
                    value={formData.desa}
                    onChange={handleChange}
                    className="w-full h-[52px] bg-gray-50 border border-gray-200 rounded-xl px-4 outline-none focus:border-[#1f7a4d] focus:bg-white transition text-sm text-gray-800"
                  />
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-2">
                    Kode Pos
                  </label>
                  <input
                    type="text"
                    name="kode_pos"
                    placeholder="Kode Pos"
                    value={formData.kode_pos}
                    onChange={handleChange}
                    className="w-full h-[52px] bg-gray-50 border border-gray-200 rounded-xl px-4 outline-none focus:border-[#1f7a4d] focus:bg-white transition text-sm text-gray-800"
                  />
                </div>
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Alamat Lengkap Sekretariat
                </label>
                <textarea
                  name="alamat"
                  rows="3"
                  placeholder="Jl. Raya Cikidang KM. 10..."
                  value={formData.alamat}
                  onChange={handleChange}
                  className="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 outline-none focus:border-[#1f7a4d] focus:bg-white transition text-sm text-gray-800 resize-none"
                />
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Deskripsi / Profil Singkat PAC
                </label>
                <textarea
                  name="deskripsi"
                  rows="4"
                  placeholder="Informasi mengenai kepengurusan, visi misi PAC, atau fokus kegiatan..."
                  value={formData.deskripsi}
                  onChange={handleChange}
                  className="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 outline-none focus:border-[#1f7a4d] focus:bg-white transition text-sm text-gray-800 resize-none"
                />
              </div>

              <div className="pt-4 sm:pt-6">
                <button
                  type="submit"
                  disabled={loading}
                  className="w-full h-[52px] sm:h-[54px] bg-[#1f7a4d] hover:bg-[#17633f] text-white font-semibold rounded-2xl shadow-md hover:shadow-lg transition duration-200 flex items-center justify-center disabled:opacity-50"
                >
                  {loading ? "Mengirim Pengajuan..." : "Kirim Pengajuan PAC"}
                </button>
              </div>

            </form>
          </div>
        </div>
      </section>

      <Footer />
    </div>
  );
}

export default PengajuanPAC;
