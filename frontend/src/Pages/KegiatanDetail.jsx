import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import { useParams, useNavigate } from "react-router-dom";
import { useState, useEffect } from "react";

import foto1 from "../assets/images/foto1.jpg";
import foto2 from "../assets/images/foto2.jpg";
import foto3 from "../assets/images/foto3.jpg";
import anggotaIcon from "../assets/icons/anggota.svg";
import calendarIcon from "../assets/icons/calendar.svg";
import clockIcon from "../assets/icons/clock.svg";
import descriptionIcon from "../assets/icons/description.svg";
import locationIcon from "../assets/icons/Location.svg";
import pacIcon from "../assets/icons/pac.svg";
import pertumbuhanIcon from "../assets/icons/pertumbuhan.svg";

function AssetIcon({ src, alt, size = "w-10 h-10" }) {
  return (
    <img
      src={src}
      alt={alt}
      className={`${size} object-contain flex-shrink-0`}
      aria-hidden="true"
    />
  );
}

function KegiatanDetail() {
  const { id } = useParams();
  const navigate = useNavigate();

  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(false);

  const formatTanggal = (tanggal) => {
    return new Date(tanggal).toLocaleDateString('id-ID', {
      weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
    });
  };

  const formatWaktu = (waktu) => {
    if (!waktu || typeof waktu !== 'string') return '-';
    const parts = waktu.split(':');
    if (parts.length >= 2) {
      return `${parts[0]}:${parts[1]} WIB`;
    }
    return `${waktu} WIB`;
  };

  const getStatusStyle = (status) => {
    switch (status) {
      case 'completed':
        return { bg: 'bg-green-50 border-green-200', text: 'text-green-700', dot: 'bg-green-500', label: 'Selesai' };
      case 'ongoing':
        return { bg: 'bg-blue-50 border-blue-200', text: 'text-blue-700', dot: 'bg-blue-500', label: 'Sedang Berlangsung' };
      case 'upcoming':
        return { bg: 'bg-amber-50 border-amber-200', text: 'text-amber-700', dot: 'bg-amber-500', label: 'Akan Datang' };
      default:
        return { bg: 'bg-gray-50 border-gray-200', text: 'text-gray-700', dot: 'bg-gray-500', label: status };
    }
  };

  const getImage = (kategori) => {
    if (kategori === 'Seminar') return foto1;
    if (kategori === 'Sosial') return foto2;
    return foto3;
  };

  const mockKegiatanDetails = {
    "1": {
      id: 1,
      judul: "Seminar Pemberdayaan Perempuan dan Kewirausahaan",
      deskripsi: "Seminar nasional tentang pemberdayaan perempuan melalui kewirausahaan dan UMKM. Kegiatan ini bertujuan untuk membekali para kader Fatayat NU dengan keterampilan wirausaha dan pemahaman pasar digital guna meningkatkan perekonomian keluarga.",
      tanggal: "2026-05-15",
      waktu: "09:00:00",
      lokasi: "Gedung PCNU Kabupaten Sukabumi",
      peserta: 150,
      kategori: "Seminar",
      status: "completed",
      pac: {
        nama_pac: "PAC Cibadak",
        kecamatan: "Cibadak"
      }
    },
    "2": {
      id: 2,
      judul: "Bakti Sosial dan Santunan Anak Yatim",
      deskripsi: "Kegiatan sosial rutin memberikan santunan dan bantuan sembako kepada anak yatim dan dhuafa di wilayah Sukabumi sebagai wujud kepedulian sosial Fatayat NU.",
      tanggal: "2026-05-08",
      waktu: "13:00:00",
      lokasi: "Yayasan Al-Yusufiyah, Cicurug",
      peserta: 85,
      kategori: "Sosial",
      status: "completed",
      pac: {
        nama_pac: "PAC Cicurug",
        kecamatan: "Cicurug"
      }
    },
    "3": {
      id: 3,
      judul: "Pelatihan Kaderisasi dan Leadership",
      deskripsi: "Program pelatihan kepemimpinan intensif untuk kader muda Fatayat NU guna melatih kepemimpinan, manajemen organisasi modern, serta kecakapan komunikasi publik.",
      tanggal: "2026-05-01",
      waktu: "08:00:00",
      lokasi: "Aula Balai Diklat Keagamaan Sukabumi",
      peserta: 120,
      kategori: "Pelatihan",
      status: "completed",
      pac: {
        nama_pac: "PAC Parungkuda",
        kecamatan: "Parungkuda"
      }
    },
    "4": {
      id: 4,
      judul: "Rapat Koordinasi PAC Se-Sukabumi",
      deskripsi: "Rapat koordinasi rutin seluruh pengurus Pimpinan Anak Cabang (PAC) se-Kabupaten Sukabumi untuk melakukan evaluasi tengah tahun program kerja serta penyelarasan rencana program masa depan.",
      tanggal: "2026-04-22",
      waktu: "10:00:00",
      lokasi: "Kantor Sekretariat Fatayat NU Sukabumi",
      peserta: 95,
      kategori: "Rapat",
      status: "completed",
      pac: {
        nama_pac: "PC Fatayat NU",
        kecamatan: "Cisaat"
      }
    },
    "5": {
      id: 5,
      judul: "Workshop Manajemen Organisasi Modern",
      deskripsi: "Workshop tentang manajemen organisasi berbasis digital dan pemanfaatan sistem cloud database untuk efisiensi administrasi internal organisasi Fatayat NU.",
      tanggal: "2026-04-10",
      waktu: "09:00:00",
      lokasi: "Aula PCNU Sukabumi",
      peserta: 75,
      kategori: "Workshop",
      status: "completed",
      pac: {
        nama_pac: "PAC Cibadak",
        kecamatan: "Cibadak"
      }
    },
    "6": {
      id: 6,
      judul: "Kajian Rutin Keislaman dan Keputrian",
      deskripsi: "Kajian rutin bulanan membahas problematika fiqih kewanitaan kontemporer, hak-hak perempuan dalam Islam, serta penguatan pemahaman ahlussunnah wal jamaah an-nahdliyah.",
      tanggal: "2026-04-03",
      waktu: "15:30:00",
      lokasi: "Masjid Agung Sukabumi",
      peserta: 200,
      kategori: "Kajian",
      status: "completed",
      pac: {
        nama_pac: "PAC Cicurug",
        kecamatan: "Cicurug"
      }
    }
  };

  useEffect(() => {
    setLoading(true);
    setError(false);
    fetch(`/api/kegiatan/${id}`)
      .then((res) => {
        if (!res.ok) throw new Error("Kegiatan tidak ditemukan");
        return res.json();
      })
      .then((apiData) => {
        setData(apiData);
        setLoading(false);
      })
      .catch((err) => {
        console.error(err);
        if (mockKegiatanDetails[id]) {
          setData(mockKegiatanDetails[id]);
          setError(false);
        } else {
          setError(true);
        }
        setLoading(false);
      });
  }, [id]);

  if (loading) {
    return (
      <div className="bg-[#f6f8f7] min-h-screen">
        <Navbar />
        <div className="flex items-center justify-center py-40">
          <div className="text-center">
            <div className="w-12 h-12 border-4 border-[#1f7a4d] border-t-transparent rounded-full animate-spin mx-auto"></div>
            <p className="text-gray-500 mt-4 text-sm">Memuat detail kegiatan...</p>
          </div>
        </div>
        <Footer />
      </div>
    );
  }

  if (error || !data) {
    return (
      <div className="bg-[#f6f8f7] min-h-screen">
        <Navbar />
        <div className="flex items-center justify-center py-40">
          <div className="text-center max-w-md mx-auto px-4">
            <AssetIcon src={descriptionIcon} alt="" size="w-16 h-16 mx-auto mb-6" />
            <h2 className="text-2xl font-semibold text-gray-900 mb-3">Kegiatan Tidak Ditemukan</h2>
            <p className="text-gray-500 mb-8">
              Kegiatan yang Anda cari tidak tersedia atau telah dihapus.
            </p>
            <button
              onClick={() => navigate('/kegiatan')}
              className="bg-[#1f7a4d] text-white px-6 py-3 rounded-xl hover:bg-[#17633d] transition duration-200 text-sm font-medium"
            >
              ← Kembali ke Kegiatan
            </button>
          </div>
        </div>
        <Footer />
      </div>
    );
  }

  const statusStyle = getStatusStyle(data.status);

  return (
    <div className="bg-[#f6f8f7] min-h-screen">

      <Navbar />

      {/* HERO IMAGE */}
      <section className="px-4 sm:px-8 lg:px-20 pt-8 sm:pt-12">
        <div className="max-w-[1280px] mx-auto">

          {/* Back button */}
          <button
            onClick={() => navigate('/kegiatan')}
            className="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#1f7a4d] transition duration-200 mb-6 group"
          >
            <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
              <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Kegiatan
          </button>

          {/* Image banner */}
          <div className="relative rounded-[24px] sm:rounded-[32px] overflow-hidden h-[240px] sm:h-[340px] lg:h-[420px]">
            <img
              src={data.gambar_url || getImage(data.kategori)}
              alt={data.judul}
              className="w-full h-full object-cover"
            />
            <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent" />

            {/* Badges on image */}
            <div className="absolute top-5 left-5 flex items-center gap-3">
              <span className="bg-white/95 backdrop-blur-sm text-[#1f7a4d] text-xs sm:text-sm px-4 py-1.5 rounded-full font-medium shadow-sm">
                {data.kategori}
              </span>
              <span className={`${statusStyle.bg} border backdrop-blur-sm text-xs sm:text-sm px-4 py-1.5 rounded-full font-medium flex items-center gap-2`}>
                <span className={`w-2 h-2 rounded-full ${statusStyle.dot}`}></span>
                <span className={statusStyle.text}>{statusStyle.label}</span>
              </span>
            </div>

            {/* Title on image */}
            <div className="absolute bottom-6 left-6 right-6">
              <h1 className="text-white text-[24px] sm:text-[32px] lg:text-[40px] font-semibold leading-tight drop-shadow-lg">
                {data.judul}
              </h1>
            </div>
          </div>

        </div>
      </section>

      {/* CONTENT */}
      <section className="px-4 sm:px-8 lg:px-20 py-10 sm:py-14 lg:py-16">
        <div className="max-w-[1280px] mx-auto">

          <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {/* LEFT — Main content */}
            <div className="lg:col-span-2 space-y-8">

              {/* Deskripsi */}
              <div className="bg-white border border-[#E5E7EB] rounded-[24px] p-6 sm:p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
                <h2 className="text-[20px] sm:text-[24px] font-semibold text-gray-900 mb-5 flex items-center gap-3">
                  <AssetIcon src={descriptionIcon} alt="" size="w-8 h-8" />
                  Deskripsi Kegiatan
                </h2>
                <p className="text-[15px] sm:text-[16px] text-gray-600 leading-[1.9] whitespace-pre-line">
                  {data.deskripsi || 'Belum ada deskripsi untuk kegiatan ini.'}
                </p>
              </div>

              {/* PAC Info */}
              {data.pac && (
                <div className="bg-white border border-[#E5E7EB] rounded-[24px] p-6 sm:p-8 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
                  <h2 className="text-[20px] sm:text-[24px] font-semibold text-gray-900 mb-5 flex items-center gap-3">
                    <AssetIcon src={pacIcon} alt="" size="w-8 h-8" />
                    PAC Penyelenggara
                  </h2>
                  <div className="bg-[#f6f8f7] border border-[#E5E7EB] rounded-[16px] p-5 flex items-center gap-4">
                    <div className="w-12 h-12 bg-[#1f7a4d] rounded-xl flex items-center justify-center text-white font-semibold text-lg flex-shrink-0">
                      {data.pac.nama_pac?.charAt(0)?.toUpperCase()}
                    </div>
                    <div>
                      <p className="font-semibold text-gray-900 text-[16px]">{data.pac.nama_pac}</p>
                      <p className="text-gray-500 text-sm mt-0.5">Kec. {data.pac.kecamatan}</p>
                    </div>
                  </div>
                </div>
              )}

            </div>

            {/* RIGHT — Info sidebar */}
            <div className="space-y-6">

              {/* Info Cards */}
              <div className="bg-white border border-[#E5E7EB] rounded-[24px] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.03)]">
                <h3 className="text-[17px] font-semibold text-gray-900 mb-5">Informasi Kegiatan</h3>

                <div className="space-y-4">

                  {/* Tanggal */}
                  <div className="flex items-start gap-3">
                    <AssetIcon src={calendarIcon} alt="" />
                    <div>
                      <p className="text-xs text-gray-400 uppercase tracking-wider font-medium">Tanggal</p>
                      <p className="text-[15px] text-gray-900 font-medium mt-0.5">{formatTanggal(data.tanggal)}</p>
                    </div>
                  </div>

                  {/* Waktu */}
                  <div className="flex items-start gap-3">
                    <AssetIcon src={clockIcon} alt="" />
                    <div>
                      <p className="text-xs text-gray-400 uppercase tracking-wider font-medium">Waktu</p>
                      <p className="text-[15px] text-gray-900 font-medium mt-0.5">{formatWaktu(data.waktu)}</p>
                    </div>
                  </div>

                  {/* Lokasi */}
                  <div className="flex items-start gap-3">
                    <AssetIcon src={locationIcon} alt="" />
                    <div>
                      <p className="text-xs text-gray-400 uppercase tracking-wider font-medium">Lokasi</p>
                      <p className="text-[15px] text-gray-900 font-medium mt-0.5">{data.lokasi}</p>
                    </div>
                  </div>

                  {/* Peserta */}
                  <div className="flex items-start gap-3">
                    <AssetIcon src={anggotaIcon} alt="" />
                    <div>
                      <p className="text-xs text-gray-400 uppercase tracking-wider font-medium">Peserta</p>
                      <p className="text-[15px] text-gray-900 font-medium mt-0.5">{data.peserta} Peserta</p>
                    </div>
                  </div>

                  {/* Status */}
                  <div className="flex items-start gap-3">
                    <AssetIcon src={pertumbuhanIcon} alt="" />
                    <div>
                      <p className="text-xs text-gray-400 uppercase tracking-wider font-medium">Status</p>
                      <div className="mt-1">
                        <span className={`inline-flex items-center gap-1.5 text-xs px-3 py-1 rounded-full border ${statusStyle.bg} ${statusStyle.text} font-medium`}>
                          <span className={`w-1.5 h-1.5 rounded-full ${statusStyle.dot}`}></span>
                          {statusStyle.label}
                        </span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              {/* CTA */}
              <button
                onClick={() => navigate('/kegiatan')}
                className="w-full h-[50px] bg-[#1f7a4d] text-white rounded-[16px] text-sm font-medium hover:bg-[#17633d] hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2"
              >
                <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth={2}>
                  <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Lihat Semua Kegiatan
              </button>

            </div>

          </div>

        </div>
      </section>

      <Footer />

    </div>
  );
}

export default KegiatanDetail;
