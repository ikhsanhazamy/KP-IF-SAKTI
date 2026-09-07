import { useState, useMemo } from "react";
import { Link } from "react-router-dom";
import {
  Search,
  X,
  ChevronRight,
  ShieldCheck,
  Users,
  Layers,
  Building2,
  GitGraph,
  LayoutGrid,
  FileCheck,
  CheckCircle2,
  UserCheck
} from "lucide-react";

// =========================================================================
// DATA RESMI PENGURUS PC FATAYAT NU KABUPATEN SUKABUMI (2024–2029)
// =========================================================================
const OFFICIALS_DATA = [
  // -----------------------------------------------------------------------
  // 1. PENASIHAT & PEMBINA
  // -----------------------------------------------------------------------
  {
    id: 1,
    category: "pembina",
    roleCategory: "Dewan Pembina",
    name: "K.H. E.S. Mubarok, M.Ag",
    role: "Pembina Kelembagaan",
    subRole: "Ketua Tanfidziyah PCNU Kab. Sukabumi",
    division: "Pengurus Cabang Nahdlatul Ulama",
    duties: [
      "Memberikan arahan kebijakan keorganisasian dan keselarasan dengan PCNU.",
      "Membimbing penguatan akidah Ahlussunnah wal Jama'ah An-Nahdliyyah.",
      "Memberikan restu dan pertimbangan strategis kepemimpinan cabang."
    ],
    initials: "EM",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 2,
    category: "pembina",
    roleCategory: "Dewan Penasihat",
    name: "Nyai Hj. Eni Rodiyah, M.Pd.I",
    role: "Ketua Dewan Penasihat",
    subRole: "Tokoh Alumni Senior Fatayat NU",
    division: "Dewan Penasihat Cabang",
    duties: [
      "Memberikan nasihat dan pertimbangan moral bagi kesinambungan organisasi.",
      "Mengawal kaderisasi perempuan muda NU agar selaras dengan nilai keislaman dan kebangsaan.",
      "Mendampingi pimpinan harian dalam resolusi persoalan kelembagaan."
    ],
    initials: "ER",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 3,
    category: "pembina",
    roleCategory: "Dewan Penasihat",
    name: "Hj. Siti Mariam, S.Ag",
    role: "Anggota Dewan Penasihat",
    subRole: "Tokoh Muslimat NU Kabupaten Sukabumi",
    division: "Dewan Penasihat Cabang",
    duties: [
      "Menjembatani sinergi program antara Fatayat NU dan Muslimat NU.",
      "Mendorong program penguatan ketahanan keluarga dan generasi nahdliyin.",
      "Memberikan tausiyah dan motivasi berkala dalam forum cabang."
    ],
    initials: "SM",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },

  // -----------------------------------------------------------------------
  // 2. PENGURUS HARIAN (BPH) - KETUA & WAKIL KETUA
  // -----------------------------------------------------------------------
  {
    id: 4,
    category: "bph",
    subCategory: "ketua",
    roleCategory: "Pimpinan Harian",
    name: "Sahabat Yuli Yulianti, S.Pd.I",
    role: "Ketua Pimpinan Cabang",
    subRole: "Ketua Umum PC Fatayat NU",
    division: "Pimpinan Harian",
    isLeader: true,
    duties: [
      "Penanggung jawab tertinggi seluruh aktivitas dan kebijakan organisasi di tingkat cabang.",
      "Mengoordinasikan konsolidasi 47 Pimpinan Anak Cabang (PAC) se-Kabupaten Sukabumi.",
      "Mewakili Fatayat NU Kabupaten Sukabumi dalam forum eksternal dan kelembagaan NU."
    ],
    initials: "YY",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 5,
    category: "bph",
    subCategory: "ketua",
    roleCategory: "Pimpinan Harian",
    name: "Sahabat Siti Nurlaela, M.Ag",
    role: "Wakil Ketua I",
    subRole: "Bidang Organisasi, Kaderisasi & Keanggotaan (POKK)",
    division: "Koordinator Bidang POKK",
    duties: [
      "Mengawal penataan kelembagaan, akreditasi PAC, dan database kader.",
      "Memimpin penyelenggaraan Latihan Kader Dasar (LKD) di seluruh zona wilayah.",
      "Membantu Ketua Cabang dalam fungsi pembinaan struktural keorganisasian."
    ],
    initials: "SN",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 6,
    category: "bph",
    subCategory: "ketua",
    roleCategory: "Pimpinan Harian",
    name: "Sahabat Rina Marlina, S.Pd",
    role: "Wakil Ketua II",
    subRole: "Bidang Pendidikan, Pelatihan & Dakwah Aswaja",
    division: "Koordinator Bidang Pendidikan & Dakwah",
    duties: [
      "Mengoordinasikan majelis taklim, pengajian rutin, dan dakwah Islam Ahlussunnah wal Jama'ah.",
      "Menyusun modul pelatihan kepemimpinan dan wawasan keagamaan santri putri.",
      "Menjalin sinergi dakwah dengan pesantren dan lembaga pendidikan Nahdliyin."
    ],
    initials: "RM",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 7,
    category: "bph",
    subCategory: "ketua",
    roleCategory: "Pimpinan Harian",
    name: "Sahabat Ai Rohayati, S.E",
    role: "Wakil Ketua III",
    subRole: "Bidang Ekonomi, Koperasi & Kesejahteraan Sosial",
    division: "Koordinator Bidang Ekonomi",
    duties: [
      "Mengembangkan inkubasi kewirausahaan kader dan program UMKM Fatayat mandiri.",
      "Membina unit usaha koperasi syariah dan jaringan pemasaran produk lokal kader.",
      "Mengoordinasikan aksi tanggap darurat dan bakti sosial kemasyarakatan."
    ],
    initials: "AR",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 8,
    category: "bph",
    subCategory: "ketua",
    roleCategory: "Pimpinan Harian",
    name: "Sahabat Nining Ratnaningsih, S.H., M.H",
    role: "Wakil Ketua IV",
    subRole: "Bidang Hukum, Politik & Advokasi Kebijakan",
    division: "Koordinator Bidang Advokasi",
    duties: [
      "Memberikan pendampingan advokasi hak-hak perempuan dan perlindungan anak.",
      "Menyelenggarakan penyuluhan hukum dan pencegahan kekerasan dalam rumah tangga.",
      "Membangun kemitraan dengan lembaga bantuan hukum dan pemangku kebijakan publik."
    ],
    initials: "NR",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },

  // -----------------------------------------------------------------------
  // PENGURUS HARIAN (BPH) - SEKRETARIAT
  // -----------------------------------------------------------------------
  {
    id: 9,
    category: "bph",
    subCategory: "sekretaris",
    roleCategory: "Sekretariat",
    name: "Sahabat Dwi Lestari, S.Kom",
    role: "Sekretaris Cabang",
    subRole: "Kepala Sekretariat PC Fatayat NU",
    division: "Sekretariat Utama",
    duties: [
      "Mengelola tata kelola persuratan resmi, pengarsipan berkas, dan inventarisasi cabang.",
      "Menyusun jadwal kegiatan, notulensi rapat pleno, dan buku agenda kerja cabang.",
      "Memastikan tertib administrasi pada seluruh tingkatan kepengurusan."
    ],
    initials: "DL",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 10,
    category: "bph",
    subCategory: "sekretaris",
    roleCategory: "Sekretariat",
    name: "Sahabat Fitri Handayani, S.Pd",
    role: "Wakil Sekretaris I",
    subRole: "Administrasi Keorganisasian & Database PAC",
    division: "Sekretariat",
    duties: [
      "Mengelola validasi data keanggotaan dan penerbitan rekomendasi SK PAC.",
      "Membantu penyiapan berkas pengajuan pembentukan kepengurusan PAC baru.",
      "Mendokumentasikan data riwayat kaderisasi di tingkat cabang."
    ],
    initials: "FH",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 11,
    category: "bph",
    subCategory: "sekretaris",
    roleCategory: "Sekretariat",
    name: "Sahabat Nia Kurniasih, S.Ag",
    role: "Wakil Sekretaris II",
    subRole: "Dokumentasi, Risalah & Informasi Publik",
    division: "Sekretariat",
    duties: [
      "Mendokumentasikan jalannya musyawarah cabang dan forum rapat kerja.",
      "Menyusun laporan berkala kinerja kepengurusan untuk pimpinan wilayah.",
      "Mengelola koordinasi teknis pengumuman dan edaran resmi cabang."
    ],
    initials: "NK",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },

  // -----------------------------------------------------------------------
  // PENGURUS HARIAN (BPH) - KEBENDAHARAAN
  // -----------------------------------------------------------------------
  {
    id: 12,
    category: "bph",
    subCategory: "bendahara",
    roleCategory: "Kebendaharaan",
    name: "Sahabat Hj. Elis Ratnasari, M.M",
    role: "Bendahara Cabang",
    subRole: "Kepala Pengelola Keuangan Cabang",
    division: "Kebendaharaan",
    duties: [
      "Bertanggung jawab atas manajemen arus kas dan anggaran pendapatan-belanja organisasi.",
      "Menyusun laporan pertanggungjawaban keuangan berkala yang transparan dan akuntabel.",
      "Mengawasi kepatuhan alokasi dana program di setiap bidang kerja."
    ],
    initials: "ER",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 13,
    category: "bph",
    subCategory: "bendahara",
    roleCategory: "Kebendaharaan",
    name: "Sahabat Lilis Karlina, S.E",
    role: "Wakil Bendahara I",
    subRole: "Pengelolaan Iuran & Dana Abadi",
    division: "Kebendaharaan",
    duties: [
      "Mengelola pencatatan iuran wajib anggota dan kontribusi kemitraan.",
      "Mengadministrasikan rekening operasional dan pencairan dana program resmi.",
      "Membantu penyusunan neraca kas bulanan cabang."
    ],
    initials: "LK",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 14,
    category: "bph",
    subCategory: "bendahara",
    roleCategory: "Kebendaharaan",
    name: "Sahabat Maya Rahmawati, S.E",
    role: "Wakil Bendahara II",
    subRole: "Administrasi Logistik & Pengadaan",
    division: "Kebendaharaan",
    duties: [
      "Menangani verifikasi bukti belanja kegiatan dan tanda terima kas.",
      "Mengelola pengadaan atribut resmi, seragam batik, dan perlengkapan organisasi.",
      "Memelihara catatan aset tetap milik cabang."
    ],
    initials: "MR",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },

  // -----------------------------------------------------------------------
  // 3. BIDANG-BIDANG (DIVISI KERJA)
  // -----------------------------------------------------------------------
  {
    id: 15,
    category: "bidang",
    subCategory: "pokk",
    roleCategory: "Bidang POKK",
    name: "Sahabat Neneng Hasanah, S.Pd.I",
    role: "Koordinator Bidang POKK",
    subRole: "Pengembangan Organisasi & Kaderisasi",
    division: "Bidang Organisasi & Kaderisasi (POKK)",
    duties: [
      "Merencanakan dan memonitor jalannya kaderisasi berjenjang LKD di 47 PAC.",
      "Melakukan supervisi kelengkapan struktur dan regenerasi kepengurusan PAC.",
      "Menyiapkan bahan rapat koordinasi bidang organisasi berkala."
    ],
    initials: "NH",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 16,
    category: "bidang",
    subCategory: "pokk",
    roleCategory: "Bidang POKK",
    name: "Sahabat Imas Masitoh, S.Pd",
    role: "Sekretaris Bidang POKK",
    subRole: "Administrasi Data Kader & PAC",
    division: "Bidang Organisasi & Kaderisasi (POKK)",
    duties: [
      "Membantu verifikasi berkas usulan pembentukan PAC baru.",
      "Mengarsip presensi dan sertifikat kelulusan peserta LKD.",
      "Menyusun dokumentasi perkembangan kelembagaan di tiap zona."
    ],
    initials: "IM",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 17,
    category: "bidang",
    subCategory: "pendidikan",
    roleCategory: "Bidang Pendidikan",
    name: "Sahabat Uswatun Khasanah, M.Pd",
    role: "Koordinator Bidang Pendidikan",
    subRole: "Pendidikan, Pelatihan & Dakwah Aswaja",
    division: "Bidang Pendidikan & Dakwah",
    duties: [
      "Menyusun kurikulum materi penguatan akidah dan amaliah an-nahdliyyah.",
      "Menyelenggarakan pelatihan daiyah muda dan muballighah Fatayat.",
      "Mengoordinasikan peringatan hari besar Islam tingkat cabang."
    ],
    initials: "UK",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 18,
    category: "bidang",
    subCategory: "pendidikan",
    roleCategory: "Bidang Pendidikan",
    name: "Sahabat Eneng Solihat, S.Pd.I",
    role: "Sekretaris Bidang Pendidikan",
    subRole: "Pelaksana Program Dakwah & Keputrian",
    division: "Bidang Pendidikan & Dakwah",
    duties: [
      "Menjadwalkan agenda bimbingan majelis taklim di kecamatan binaan.",
      "Menginventarisasi naskah khutbah dan materi kajian keislaman.",
      "Membantu fasilitasi media dakwah cabang."
    ],
    initials: "ES",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 19,
    category: "bidang",
    subCategory: "ekonomi",
    roleCategory: "Bidang Ekonomi",
    name: "Sahabat Deuis Rostika, S.E",
    role: "Koordinator Bidang Ekonomi",
    subRole: "Ekonomi, Koperasi & Kesejahteraan Sosial",
    division: "Bidang Ekonomi & Sosial",
    duties: [
      "Menginisiasi pembinaan unit usaha mikro binaan kader Fatayat.",
      "Membangun jejaring bazar produk halal dan pelatihan literasi keuangan keluarga.",
      "Mengoordinasikan posko bantuan sosial kemasyarakatan."
    ],
    initials: "DR",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 20,
    category: "bidang",
    subCategory: "ekonomi",
    roleCategory: "Bidang Ekonomi",
    name: "Sahabat Wina Nurfauziah, S.E",
    role: "Sekretaris Bidang Ekonomi",
    subRole: "Administrasi Koperasi & Usaha Mandiri",
    division: "Bidang Ekonomi & Sosial",
    duties: [
      "Mencatat data pelaku usaha binaan di 47 PAC se-Kabupaten.",
      "Mengadministrasikan pembukuan transaksi koperasi syariat Fatayat.",
      "Menyiapkan laporan pelaksanaan aksi sosial cabang."
    ],
    initials: "WN",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 21,
    category: "bidang",
    subCategory: "hukum",
    roleCategory: "Bidang Hukum",
    name: "Sahabat Adv. Siti Julaeha, S.H",
    role: "Koordinator Bidang Hukum",
    subRole: "Hukum, Politik & Advokasi Hak Perempuan",
    division: "Bidang Hukum & Advokasi",
    duties: [
      "Memimpin layanan konsultasi hukum dan pos bantuan hukum perempuan.",
      "Memberikan pendampingan bagi korban kekerasan dan diskriminasi gender.",
      "Mengoordinasikan kajian kebijakan publik ramah keluarga di Sukabumi."
    ],
    initials: "SJ",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  },
  {
    id: 22,
    category: "bidang",
    subCategory: "hukum",
    roleCategory: "Bidang Hukum",
    name: "Sahabat Anisa Rahma, S.H",
    role: "Sekretaris Bidang Hukum",
    subRole: "Penyuluhan Hukum & Dokumentasi Perkara",
    division: "Bidang Hukum & Advokasi",
    duties: [
      "Mengelola pencatatan aduan masyarakat dan tindak lanjut penanganannya.",
      "Menyusun dokumentasi program melek hukum bagi kader akar rumput.",
      "Membantu administrasi korespondensi dengan instansi hukum terkait."
    ],
    initials: "AR",
    photo: null,
    period: "2024–2029",
    skNumber: "SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024"
  }
];

// =========================================================================
// KOMPONEN AVATAR / FRAME FOTO RESMI (PORTRAIT 3:4 COMPATIBLE)
// Sepenuhnya kompatibel dengan pasfoto portrait resmi (3:4), dan
// menampilkan siluet formal bermartabat saat foto belum diisi.
// =========================================================================
function OfficialPhotoFrame({ photo, name, initials, isLeader = false }) {
  const [hasError, setHasError] = useState(false);

  if (photo && !hasError) {
    return (
      <div className="w-full h-full overflow-hidden bg-slate-100">
        <img
          src={photo}
          alt={name}
          onError={() => setHasError(true)}
          className="w-full h-full object-cover object-top transition duration-300 group-hover:scale-103"
          loading="lazy"
        />
      </div>
    );
  }

  // Fallback Siluet Formal Bersih & Bermartabat (Standar Institusional Resmi)
  return (
    <div className="w-full h-full bg-gradient-to-b from-slate-50 via-slate-100 to-slate-200/90 flex flex-col items-center justify-center relative overflow-hidden select-none">
      {/* Siluet vektor kepala & pundak formal */}
      <div className="w-16 h-16 rounded-full bg-slate-200/80 flex items-center justify-center mb-1 border border-slate-300/60 shadow-2xs">
        <svg
          className="w-10 h-10 text-slate-400"
          viewBox="0 0 24 24"
          fill="currentColor"
          aria-hidden="true"
        >
          <path d="M12 2C9.243 2 7 4.243 7 7c0 2.459 1.782 4.502 4.125 4.921A8.995 8.995 0 003 20.5a1.5 1.5 0 001.5 1.5h15a1.5 1.5 0 001.5-1.5 8.995 8.995 0 00-8.125-8.579C15.218 11.502 17 9.459 17 7c0-2.757-2.243-5-5-5zm0 2c1.654 0 3 1.346 3 3s-1.346 3-3 3-3-1.346-3-3 1.346-3 3-3zm0 9c4.009 0 7.375 2.768 8.016 6.5H3.984C4.625 15.768 7.991 13 12 13z" />
        </svg>
      </div>

      <span className="text-[10px] font-semibold tracking-wider text-slate-500 bg-white/90 border border-slate-200 px-2 py-0.5 rounded-full shadow-2xs">
        {initials}
      </span>
    </div>
  );
}

// =========================================================================
// KOMPONEN UTAMA STRUKTUR ORGANISASI
// =========================================================================
function StructureSection() {
  const [viewMode, setViewMode] = useState("cards"); // 'cards' | 'tree'
  const [activeCategory, setActiveCategory] = useState("all");
  const [searchQuery, setSearchQuery] = useState("");
  const [selectedOfficial, setSelectedOfficial] = useState(null);

  // Filter pengurus sesuai tab & pencarian
  const filteredOfficials = useMemo(() => {
    return OFFICIALS_DATA.filter((item) => {
      // Filter Kategori
      if (activeCategory !== "all" && item.category !== activeCategory) {
        return false;
      }

      // Filter Pencarian
      if (searchQuery.trim() !== "") {
        const q = searchQuery.toLowerCase();
        return (
          item.name.toLowerCase().includes(q) ||
          item.role.toLowerCase().includes(q) ||
          item.subRole.toLowerCase().includes(q) ||
          item.division.toLowerCase().includes(q)
        );
      }

      return true;
    });
  }, [activeCategory, searchQuery]);

  // Kelompokkan data untuk presentasi hierarkis resmi
  const pembinaList = useMemo(
    () => filteredOfficials.filter((o) => o.category === "pembina"),
    [filteredOfficials]
  );
  const ketuaCabang = useMemo(
    () => filteredOfficials.find((o) => o.isLeader),
    [filteredOfficials]
  );
  const wakilKetuaList = useMemo(
    () => filteredOfficials.filter((o) => o.category === "bph" && o.subCategory === "ketua" && !o.isLeader),
    [filteredOfficials]
  );
  const sekretarisList = useMemo(
    () => filteredOfficials.filter((o) => o.category === "bph" && o.subCategory === "sekretaris"),
    [filteredOfficials]
  );
  const bendaharaList = useMemo(
    () => filteredOfficials.filter((o) => o.category === "bph" && o.subCategory === "bendahara"),
    [filteredOfficials]
  );
  const bidangList = useMemo(
    () => filteredOfficials.filter((o) => o.category === "bidang"),
    [filteredOfficials]
  );

  return (
    <div className="max-w-[1240px] mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

      {/* ------------------------------------------------------------------- */}
      {/* 1. HEADER RESMI & INSTITUSIONAL */}
      {/* ------------------------------------------------------------------- */}
      <header className="border-b border-slate-200 pb-8 mb-8">
        <nav className="flex items-center gap-2 text-xs text-slate-500 mb-4" aria-label="Breadcrumb">
          <Link to="/" className="hover:text-[#0F5E3A] transition">Beranda</Link>
          <span className="text-slate-300">/</span>
          <Link to="/tentang" className="hover:text-[#0F5E3A] transition">Tentang</Link>
          <span className="text-slate-300">/</span>
          <span className="text-slate-900 font-medium">Struktur Kepengurusan</span>
        </nav>

        <div className="flex flex-col md:flex-row md:items-end justify-between gap-6">
          <div>
            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-[#0F5E3A]/10 text-[#0F5E3A] text-xs font-semibold mb-3">
              <ShieldCheck size={14} />
              <span>Masa Khidmat 2024–2029</span>
            </div>
            <h1 className="text-2xl sm:text-3xl lg:text-4xl font-bold text-slate-900 tracking-tight">
              Susunan Pengurus Cabang
            </h1>
            <p className="text-sm sm:text-base text-slate-600 mt-2 max-w-2xl leading-relaxed">
              Pimpinan Cabang Fatayat Nahdlatul Ulama Kabupaten Sukabumi, menaungi 47 Pimpinan Anak Cabang (PAC) se-wilayah Kabupaten Sukabumi.
            </p>
          </div>

          <div className="bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 shrink-0 self-start md:self-auto text-xs">
            <span className="text-slate-500 block">Dasar Penetapan:</span>
            <span className="font-semibold text-slate-800">SK PP Fatayat NU No. 142/SK/PPFNU/VIII/2024</span>
          </div>
        </div>
      </header>

      {/* ------------------------------------------------------------------- */}
      {/* 2. BILAH KONTROL (FILTER, VIEW MODE, & PENCARIAN) */}
      {/* ------------------------------------------------------------------- */}
      <div className="bg-white border border-slate-200 rounded-2xl p-4 sm:p-5 mb-10 shadow-xs">
        <div className="flex flex-col lg:flex-row lg:items-center justify-between gap-4">

          {/* TAB KATEGORI UTAMA (HANYA AKTIF SAAT MODE DIREKTORI) */}
          <div className="flex flex-wrap items-center gap-1.5 bg-slate-100 p-1.5 rounded-xl">
            {[
              { id: "all", label: "Semua Pengurus" },
              { id: "pembina", label: "Penasihat & Pembina" },
              { id: "bph", label: "Pengurus Harian (BPH)" },
              { id: "bidang", label: "Bidang-Bidang Kerja" },
            ].map((tab) => {
              const isActive = activeCategory === tab.id;
              return (
                <button
                  key={tab.id}
                  onClick={() => {
                    setActiveCategory(tab.id);
                    if (viewMode !== "cards") setViewMode("cards");
                  }}
                  className={`px-3.5 py-2 rounded-lg text-xs sm:text-sm font-medium whitespace-nowrap transition cursor-pointer ${
                    isActive && viewMode === "cards"
                      ? "bg-white text-[#0F5E3A] font-semibold shadow-xs"
                      : "text-slate-600 hover:text-slate-900"
                  }`}
                >
                  {tab.label}
                </button>
              );
            })}
          </div>

          {/* KANAN: TOGGLE TAMPILAN & INPUT PENCARIAN */}
          <div className="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">

            {/* SWITCHER TAMPILAN: KARTU / BAGAN ALUR */}
            <div className="inline-flex items-center bg-slate-100 p-1 rounded-xl shrink-0">
              <button
                onClick={() => setViewMode("cards")}
                className={`flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium transition cursor-pointer ${
                  viewMode === "cards"
                    ? "bg-white text-slate-900 font-semibold shadow-xs"
                    : "text-slate-500 hover:text-slate-900"
                }`}
                title="Tampilan Kartu Direktori"
              >
                <LayoutGrid size={14} />
                <span>Direktori</span>
              </button>
              <button
                onClick={() => setViewMode("tree")}
                className={`flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium transition cursor-pointer ${
                  viewMode === "tree"
                    ? "bg-white text-[#0F5E3A] font-semibold shadow-xs"
                    : "text-slate-500 hover:text-slate-900"
                }`}
                title="Tampilan Bagan Hierarki Organigram"
              >
                <GitGraph size={14} />
                <span>Bagan Alur</span>
              </button>
            </div>

            {/* PENCARIAN REAL-TIME */}
            <div className="relative min-w-[220px]">
              <Search size={15} className="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none" />
              <input
                type="text"
                value={searchQuery}
                onChange={(e) => {
                  setSearchQuery(e.target.value);
                  if (viewMode !== "cards") setViewMode("cards");
                }}
                placeholder="Cari nama atau amanah..."
                className="w-full pl-9 pr-8 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-[#0F5E3A] focus:bg-white transition"
              />
              {searchQuery && (
                <button
                  onClick={() => setSearchQuery("")}
                  className="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 cursor-pointer"
                  aria-label="Bersihkan pencarian"
                >
                  <X size={14} />
                </button>
              )}
            </div>

          </div>
        </div>

        {/* INDIKATOR STATUS PENCARIAN */}
        <div className="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
          <span>
            Menampilkan <strong className="text-slate-800">{filteredOfficials.length}</strong> pejabat resmi
          </span>
          {searchQuery && (
            <span>
              Kata kunci: <span className="text-[#0F5E3A] font-medium">"{searchQuery}"</span>
            </span>
          )}
        </div>
      </div>

      {/* ------------------------------------------------------------------- */}
      {/* 3. JIKA HASIL PENCARIAN KOSONG */}
      {/* ------------------------------------------------------------------- */}
      {filteredOfficials.length === 0 && (
        <div className="text-center py-16 bg-white border border-slate-200 rounded-2xl p-6">
          <Users size={32} className="mx-auto text-slate-300 mb-2" />
          <h3 className="text-base font-bold text-slate-800">Tidak ada pengurus ditemukan</h3>
          <p className="text-xs text-slate-500 mt-1">
            Tidak ditemukan data yang cocok dengan "{searchQuery}".
          </p>
          <button
            onClick={() => {
              setSearchQuery("");
              setActiveCategory("all");
            }}
            className="mt-4 px-4 py-2 bg-[#0F5E3A] text-white text-xs font-semibold rounded-lg hover:bg-[#0c4b2e] transition cursor-pointer"
          >
            Tampilkan Semua Pengurus
          </button>
        </div>
      )}

      {/* ------------------------------------------------------------------- */}
      {/* 4. TAMPILAN I: DIREKTORI KARTU RESMI (PHOTO COMPATIBLE 3:4) */}
      {/* ------------------------------------------------------------------- */}
      {viewMode === "cards" && filteredOfficials.length > 0 && (
        <div className="space-y-14">

          {/* BAGIAN A: PENASIHAT & PEMBINA */}
          {(activeCategory === "all" || activeCategory === "pembina") && pembinaList.length > 0 && (
            <section aria-labelledby="heading-pembina">
              <div className="flex items-center gap-2.5 mb-6 pb-2.5 border-b border-slate-200">
                <ShieldCheck size={20} className="text-[#0F5E3A]" />
                <div>
                  <h2 id="heading-pembina" className="text-lg font-bold text-slate-900">
                    Dewan Penasihat & Pembina Cabang
                  </h2>
                  <p className="text-xs text-slate-500">
                    Unsur Tanfidziyah PCNU Kab. Sukabumi & Tokoh Alumni Senior Muslimat/Fatayat NU
                  </p>
                </div>
              </div>

              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {pembinaList.map((official) => (
                  <CleanOfficialCard
                    key={official.id}
                    official={official}
                    onSelect={() => setSelectedOfficial(official)}
                  />
                ))}
              </div>
            </section>
          )}

          {/* BAGIAN B: PENGURUS HARIAN (BPH) */}
          {(activeCategory === "all" || activeCategory === "bph") && (
            <section aria-labelledby="heading-bph">
              <div className="flex items-center gap-2.5 mb-6 pb-2.5 border-b border-slate-200">
                <Users size={20} className="text-[#0F5E3A]" />
                <div>
                  <h2 id="heading-bph" className="text-lg font-bold text-slate-900">
                    Badan Pengurus Harian (BPH)
                  </h2>
                  <p className="text-xs text-slate-500">
                    Ketua Pimpinan Cabang, Jajaran Wakil Ketua, Sekretariat, dan Kebendaharaan
                  </p>
                </div>
              </div>

              {/* KETUA UMUM / KETUA CABANG (TAMPILAN ELEGAN & OTORITATIF) */}
              {ketuaCabang && (
                <div className="mb-8 bg-white border border-slate-200 rounded-2xl p-6 sm:p-7 shadow-xs hover:border-[#0F5E3A]/40 transition">
                  <div className="flex flex-col md:flex-row items-center md:items-start gap-6">
                    {/* FRAME FOTO RESMI KETUA (3:4) */}
                    <div className="w-36 sm:w-44 aspect-[3/4] rounded-xl overflow-hidden border border-slate-200 shrink-0 shadow-xs">
                      <OfficialPhotoFrame
                        photo={ketuaCabang.photo}
                        name={ketuaCabang.name}
                        initials={ketuaCabang.initials}
                        isLeader={true}
                      />
                    </div>

                    {/* DESKRIPSI KETUA */}
                    <div className="flex-1 text-center md:text-left">
                      <div className="inline-block px-2.5 py-0.5 rounded bg-[#0F5E3A]/10 text-[#0F5E3A] text-xs font-semibold mb-2">
                        Pucuk Pimpinan Cabang
                      </div>
                      <h3 className="text-xl sm:text-2xl font-bold text-slate-900">
                        {ketuaCabang.name}
                      </h3>
                      <p className="text-sm font-semibold text-[#0F5E3A] mt-0.5">
                        {ketuaCabang.role}
                      </p>
                      <p className="text-xs text-slate-500 mt-0.5">
                        {ketuaCabang.subRole}
                      </p>

                      <div className="mt-4 text-xs text-slate-600 leading-relaxed max-w-2xl">
                        <ul className="space-y-1 text-left list-disc list-inside text-slate-600">
                          {ketuaCabang.duties.map((duty, idx) => (
                            <li key={idx}>{duty}</li>
                          ))}
                        </ul>
                      </div>

                      <div className="mt-5 pt-4 border-t border-slate-100 flex flex-wrap items-center justify-center md:justify-start gap-4 text-xs text-slate-500">
                        <span>Masa Khidmat: <strong className="text-slate-800">{ketuaCabang.period}</strong></span>
                        <span>Koordinasi: <strong className="text-slate-800">47 PAC Se-Kab. Sukabumi</strong></span>
                        <button
                          onClick={() => setSelectedOfficial(ketuaCabang)}
                          className="ml-auto text-[#0F5E3A] hover:underline font-semibold flex items-center gap-1 cursor-pointer"
                        >
                          <span>Rincian Profil</span>
                          <ChevronRight size={14} />
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              )}

              {/* JAJARAN WAKIL KETUA */}
              {wakilKetuaList.length > 0 && (
                <div className="mb-8">
                  <h3 className="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">
                    Jajaran Wakil Ketua
                  </h3>
                  <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    {wakilKetuaList.map((official) => (
                      <CleanOfficialCard
                        key={official.id}
                        official={official}
                        onSelect={() => setSelectedOfficial(official)}
                      />
                    ))}
                  </div>
                </div>
              )}

              {/* SEKRETARIAT & KEBENDAHARAAN */}
              {(sekretarisList.length > 0 || bendaharaList.length > 0) && (
                <div>
                  <h3 className="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">
                    Sekretariat & Kebendaharaan Cabang
                  </h3>
                  <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    {[...sekretarisList, ...bendaharaList].map((official) => (
                      <CleanOfficialCard
                        key={official.id}
                        official={official}
                        onSelect={() => setSelectedOfficial(official)}
                      />
                    ))}
                  </div>
                </div>
              )}
            </section>
          )}

          {/* BAGIAN C: BIDANG-BIDANG KERJA (DIVISI) */}
          {(activeCategory === "all" || activeCategory === "bidang") && bidangList.length > 0 && (
            <section aria-labelledby="heading-bidang">
              <div className="flex items-center gap-2.5 mb-6 pb-2.5 border-b border-slate-200">
                <Layers size={20} className="text-[#0F5E3A]" />
                <div>
                  <h2 id="heading-bidang" className="text-lg font-bold text-slate-900">
                    Bidang-Bidang Kerja (Divisi Pelaksana)
                  </h2>
                  <p className="text-xs text-slate-500">
                    Pelaksana teknis program cabang: Organisasi, Pendidikan, Ekonomi, dan Advokasi Hukum
                  </p>
                </div>
              </div>

              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                {bidangList.map((official) => (
                  <CleanOfficialCard
                    key={official.id}
                    official={official}
                    onSelect={() => setSelectedOfficial(official)}
                  />
                ))}
              </div>
            </section>
          )}

        </div>
      )}

      {/* ------------------------------------------------------------------- */}
      {/* 5. TAMPILAN II: BAGAN ALUR STRUKTUR (ORGANIGRAM INTERAKTIF) */}
      {/* ------------------------------------------------------------------- */}
      {viewMode === "tree" && (
        <div className="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-xs">
          <div className="text-center max-w-xl mx-auto mb-10">
            <span className="text-xs font-bold uppercase tracking-wider text-[#0F5E3A] block mb-1">
              Bagan Alur Kepemimpinan
            </span>
            <h2 className="text-xl sm:text-2xl font-bold text-slate-900">
              Struktur Organisasi PC Fatayat NU
            </h2>
            <p className="text-xs text-slate-500 mt-1">
              Garis koordinasi dan wewenang kepengurusan cabang masa khidmat 2024–2029. Klik nama pengurus untuk melihat rincian amanah.
            </p>
          </div>

          {/* TINGKAT 1: DEWAN PENASIHAT & PEMBINA */}
          <div className="flex flex-col items-center">
            <div className="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
              Pengarah & Pelindung Organisasi
            </div>
            <div className="flex flex-wrap justify-center gap-3 max-w-2xl">
              {OFFICIALS_DATA.filter((o) => o.category === "pembina").map((item) => (
                <button
                  key={item.id}
                  onClick={() => setSelectedOfficial(item)}
                  className="px-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-dashed border-slate-300 rounded-xl text-left cursor-pointer transition text-xs"
                >
                  <span className="text-[10px] font-bold text-[#0F5E3A] block">
                    {item.role}
                  </span>
                  <span className="font-bold text-slate-800 block">
                    {item.name}
                  </span>
                </button>
              ))}
            </div>

            {/* GARIS PENGHUBUNG */}
            <div className="w-px h-8 bg-slate-300 my-2" />

            {/* TINGKAT 2: KETUA CABANG */}
            <div className="w-full max-w-sm">
              <button
                onClick={() => setSelectedOfficial(ketuaCabang)}
                className="w-full p-4 bg-emerald-50/70 hover:bg-emerald-50 border-2 border-[#0F5E3A] rounded-xl text-center cursor-pointer transition shadow-xs"
              >
                <span className="text-[10px] font-bold uppercase tracking-wider text-[#0F5E3A] block">
                  Ketua Pimpinan Cabang
                </span>
                <span className="text-base font-bold text-slate-900 block mt-0.5">
                  Sahabat Yuli Yulianti, S.Pd.I
                </span>
                <span className="text-xs text-slate-500 block mt-0.5">
                  Masa Khidmat 2024–2029
                </span>
              </button>
            </div>

            {/* GARIS PENGHUBUNG KETUA KE SAYAP SEKRETARIS & BENDAHARA */}
            <div className="w-px h-8 bg-slate-300 my-2" />

            {/* TINGKAT 3: SEKRETARIAT & KEBENDAHARAAN (SAYAP BPH) */}
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full max-w-xl mb-4">
              {/* SEKRETARIS */}
              <div className="bg-slate-50 border border-slate-200 rounded-xl p-3.5">
                <span className="text-[10px] font-bold uppercase text-[#0F5E3A] block mb-1">
                  Sekretariat Cabang
                </span>
                {OFFICIALS_DATA.filter((o) => o.subCategory === "sekretaris").map((item) => (
                  <button
                    key={item.id}
                    onClick={() => setSelectedOfficial(item)}
                    className="w-full text-left py-1 hover:text-[#0F5E3A] transition cursor-pointer text-xs flex items-center justify-between"
                  >
                    <span className="font-semibold text-slate-800">{item.name}</span>
                    <span className="text-[10px] text-slate-400">{item.role}</span>
                  </button>
                ))}
              </div>

              {/* BENDAHARA */}
              <div className="bg-slate-50 border border-slate-200 rounded-xl p-3.5">
                <span className="text-[10px] font-bold uppercase text-[#0F5E3A] block mb-1">
                  Kebendaharaan Cabang
                </span>
                {OFFICIALS_DATA.filter((o) => o.subCategory === "bendahara").map((item) => (
                  <button
                    key={item.id}
                    onClick={() => setSelectedOfficial(item)}
                    className="w-full text-left py-1 hover:text-[#0F5E3A] transition cursor-pointer text-xs flex items-center justify-between"
                  >
                    <span className="font-semibold text-slate-800">{item.name}</span>
                    <span className="text-[10px] text-slate-400">{item.role}</span>
                  </button>
                ))}
              </div>
            </div>

            {/* GARIS PENGHUBUNG KE BIDANG-BIDANG */}
            <div className="w-px h-8 bg-slate-300 my-2" />

            {/* TINGKAT 4: 4 BIDANG-BIDANG KERJA */}
            <div className="w-full">
              <div className="text-center text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">
                Bidang-Bidang Kerja (Pelaksana Operasional Program)
              </div>
              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                {[
                  {
                    title: "Bidang I: POKK",
                    wk: OFFICIALS_DATA.find((o) => o.id === 5),
                    divs: OFFICIALS_DATA.filter((o) => o.subCategory === "pokk"),
                  },
                  {
                    title: "Bidang II: Pendidikan & Dakwah",
                    wk: OFFICIALS_DATA.find((o) => o.id === 6),
                    divs: OFFICIALS_DATA.filter((o) => o.subCategory === "pendidikan"),
                  },
                  {
                    title: "Bidang III: Ekonomi & Sosial",
                    wk: OFFICIALS_DATA.find((o) => o.id === 7),
                    divs: OFFICIALS_DATA.filter((o) => o.subCategory === "ekonomi"),
                  },
                  {
                    title: "Bidang IV: Hukum & Advokasi",
                    wk: OFFICIALS_DATA.find((o) => o.id === 8),
                    divs: OFFICIALS_DATA.filter((o) => o.subCategory === "hukum"),
                  },
                ].map((col, idx) => (
                  <div key={idx} className="bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs">
                    <div className="font-bold text-[#0F5E3A] text-[11px] mb-2 border-b border-slate-200 pb-1.5">
                      {col.title}
                    </div>
                    {col.wk && (
                      <button
                        onClick={() => setSelectedOfficial(col.wk)}
                        className="w-full text-left py-1 mb-2 bg-white px-2 py-1.5 rounded-lg border border-slate-200 hover:border-[#0F5E3A] transition cursor-pointer"
                      >
                        <span className="text-[10px] text-slate-400 block">{col.wk.role}</span>
                        <span className="font-bold text-slate-900 block truncate">{col.wk.name}</span>
                      </button>
                    )}
                    <div className="space-y-1">
                      {col.divs.map((subItem) => (
                        <button
                          key={subItem.id}
                          onClick={() => setSelectedOfficial(subItem)}
                          className="w-full text-left px-2 py-1 hover:bg-white rounded transition cursor-pointer"
                        >
                          <span className="text-[10px] text-slate-400 block">{subItem.role}</span>
                          <span className="font-medium text-slate-800 block truncate">{subItem.name}</span>
                        </button>
                      ))}
                    </div>
                  </div>
                ))}
              </div>
            </div>

          </div>
        </div>
      )}

      {/* ------------------------------------------------------------------- */}
      {/* 6. LAYANAN ADMINISTRASI PAC (FORMAL CALLOUT) */}
      {/* ------------------------------------------------------------------- */}
      <aside className="mt-14 bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xs">
        <div className="flex items-start gap-4">
          <div className="w-12 h-12 rounded-xl bg-[#0F5E3A]/10 text-[#0F5E3A] flex items-center justify-center shrink-0">
            <Building2 size={24} />
          </div>
          <div>
            <h3 className="text-base font-bold text-slate-900">
              Layanan Administrasi & Pengajuan PAC
            </h3>
            <p className="text-xs text-slate-600 mt-1 max-w-xl leading-relaxed">
              Pimpinan Anak Cabang (PAC) di tingkat kecamatan yang memerlukan pembaruan Surat Keputusan atau pembentukan kepengurusan baru dapat mengajukan permohonan melalui formulir resmi.
            </p>
          </div>
        </div>

        <Link
          to="/pengajuan-data-pac"
          className="shrink-0 px-5 py-2.5 bg-[#0F5E3A] hover:bg-[#0c4b2e] text-white text-xs font-bold rounded-xl transition flex items-center gap-1.5"
        >
          <span>Buka Form Pengajuan PAC</span>
          <ChevronRight size={14} />
        </Link>
      </aside>

      {/* ------------------------------------------------------------------- */}
      {/* 7. MODAL DETAIL RESMI PEJABAT (FORMAL & BERSIH) */}
      {/* ------------------------------------------------------------------- */}
      {selectedOfficial && (
        <div
          className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs"
          onClick={() => setSelectedOfficial(null)}
          role="dialog"
          aria-modal="true"
        >
          <div
            className="bg-white rounded-2xl max-w-lg w-full p-6 sm:p-7 border border-slate-200 shadow-xl relative animate-in fade-in zoom-in-95 duration-150"
            onClick={(e) => e.stopPropagation()}
          >
            <button
              onClick={() => setSelectedOfficial(null)}
              className="absolute top-4 right-4 p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition cursor-pointer"
              aria-label="Tutup"
            >
              <X size={18} />
            </button>

            {/* FOTO FRAME & IDENTITAS UTAMA */}
            <div className="flex flex-col sm:flex-row items-center sm:items-start gap-4 mb-5 text-center sm:text-left">
              <div className="w-24 aspect-[3/4] rounded-xl overflow-hidden border border-slate-200 shrink-0 shadow-xs">
                <OfficialPhotoFrame
                  photo={selectedOfficial.photo}
                  name={selectedOfficial.name}
                  initials={selectedOfficial.initials}
                  isLeader={selectedOfficial.isLeader}
                />
              </div>

              <div className="flex-1 min-w-0 pr-0 sm:pr-4">
                <span className="inline-block text-[11px] font-bold text-[#0F5E3A] uppercase tracking-wider mb-1">
                  {selectedOfficial.roleCategory}
                </span>
                <h4 className="text-lg font-bold text-slate-900 leading-tight">
                  {selectedOfficial.name}
                </h4>
                <p className="text-xs font-semibold text-[#0F5E3A] mt-0.5">
                  {selectedOfficial.role}
                </p>
                <p className="text-xs text-slate-500 mt-0.5">
                  {selectedOfficial.subRole}
                </p>
              </div>
            </div>

            {/* TUGAS & WEWENANG RESMI */}
            <div className="bg-slate-50 border border-slate-100 rounded-xl p-4 text-xs space-y-3 mb-5">
              <div>
                <span className="font-semibold text-slate-800 block mb-1.5">
                  Lingkup Amanah & Tanggung Jawab:
                </span>
                <ul className="space-y-1.5 text-slate-600 list-disc list-inside">
                  {selectedOfficial.duties.map((duty, idx) => (
                    <li key={idx} className="leading-relaxed">{duty}</li>
                  ))}
                </ul>
              </div>

              <div className="grid grid-cols-2 gap-2 pt-3 border-t border-slate-200 text-[11px]">
                <div>
                  <span className="text-slate-400 block">Masa Khidmat</span>
                  <span className="font-semibold text-slate-800">{selectedOfficial.period}</span>
                </div>
                <div>
                  <span className="text-slate-400 block">Surat Keputusan</span>
                  <span className="font-semibold text-slate-800 truncate block" title={selectedOfficial.skNumber}>
                    PP Fatayat NU
                  </span>
                </div>
              </div>
            </div>

            <div className="flex justify-end">
              <button
                onClick={() => setSelectedOfficial(null)}
                className="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-lg transition cursor-pointer"
              >
                Tutup
              </button>
            </div>
          </div>
        </div>
      )}

    </div>
  );
}

// =========================================================================
// KOMPONEN KARTU PEJABAT BERSIH (CLEAN OFFICIAL CARD)
// Standard 3:4 portrait photo frame, authoritative Indonesian typography,
// no repetitive badges, no AI slop.
// =========================================================================
function CleanOfficialCard({ official, onSelect }) {
  return (
    <article
      onClick={onSelect}
      className="bg-white border border-slate-200 rounded-xl overflow-hidden flex flex-col justify-between hover:border-[#0F5E3A]/40 hover:shadow-sm transition cursor-pointer group"
    >
      <div>
        {/* FRAME FOTO 3:4 */}
        <div className="w-full h-52 sm:h-56 overflow-hidden border-b border-slate-100 bg-slate-100 relative">
          <OfficialPhotoFrame
            photo={official.photo}
            name={official.name}
            initials={official.initials}
            isLeader={official.isLeader}
          />
        </div>

        {/* INFORMASI PEJABAT */}
        <div className="p-4">
          <span className="text-[11px] font-bold text-[#0F5E3A] block truncate">
            {official.role}
          </span>
          <h3 className="text-sm font-bold text-slate-900 group-hover:text-[#0F5E3A] transition mt-1 line-clamp-1">
            {official.name}
          </h3>
          <p className="text-xs text-slate-500 mt-0.5 line-clamp-1">
            {official.subRole}
          </p>
        </div>
      </div>

      {/* FOOTER KARTU */}
      <div className="px-4 pb-3.5 pt-2 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
        <span>{official.period}</span>
        <span className="text-[#0F5E3A] font-semibold flex items-center gap-0.5 group-hover:translate-x-0.5 transition-transform">
          Detail <ChevronRight size={12} />
        </span>
      </div>
    </article>
  );
}

export default StructureSection;
