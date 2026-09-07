import { useEffect } from "react";
import { useLocation, Link } from "react-router-dom";
import { Users, ChevronRight } from "lucide-react";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import TimelineSection from "../components/TimelineSection";
import ValueSection from "../components/ValueSection";

function Tentang() {
  const location = useLocation();

  useEffect(() => {
    if (location.hash) {
      const id = location.hash.replace("#", "");
      setTimeout(() => {
        const el = document.getElementById(id);
        if (el) {
          el.scrollIntoView({ behavior: "smooth", block: "start" });
        }
      }, 100);
    }
  }, [location.hash]);

  return (
    <div className="bg-[#f6f8f7] min-h-screen">

      <Navbar />

      <section id="profil" className="px-4 sm:px-8 lg:px-20 py-12 sm:py-16 lg:py-24">

        {/* HEADER */}
        <div className="text-center mb-12 sm:mb-16 lg:mb-24">

          <h1 className="text-[36px] sm:text-[46px] lg:text-[56px] font-semibold text-gray-900 leading-tight">
            Tentang Fatayat NU Sukabumi
          </h1>

          <p className="text-base sm:text-[18px] lg:text-[20px] text-gray-500 mt-5 max-w-3xl mx-auto leading-relaxed">
            Organisasi perempuan Nahdlatul Ulama yang berdedikasi untuk pemberdayaan perempuan dan pengembangan masyarakat
          </p>

        </div>

        {/* VISI MISI */}
        <div id="visi-misi" className="max-w-[1280px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-10 items-stretch">

          {/* VISI */}
          <div
            className="rounded-[24px] sm:rounded-[32px] px-8 sm:px-12 py-10 sm:py-14 text-white min-h-[300px] sm:min-h-[460px] shadow-[0_20px_60px_rgba(0,0,0,0.08)]"
            style={{
              background:
                "linear-gradient(135deg, #0F5E3A 0%, #1A6741 7.14%, #237148 14.29%, #2C7B4F 21.43%, #358556 28.57%, #3E8F5D 35.71%, #469965 42.86%, #4FA36C 50%, #469965 57.14%, #3E8F5D 64.29%, #358556 71.43%, #2C7B4F 78.57%, #237148 85.71%, #1A6741 92.86%, #0F5E3A 100%)"
            }}
          >

            <h2 className="text-[28px] sm:text-[36px] lg:text-[40px] font-semibold mb-6 sm:mb-8">
              Visi
            </h2>

            <p className="text-lg sm:text-xl lg:text-[24px] leading-[1.8] sm:leading-[1.9] text-white/90">
              Penghapusan segala bentuk kekerasan, ketidakadilan dan kemiskinan dalam masyarakat. Dengan mengembangkan wacana kehidupan sosial yang konstruktif, demokratis dan berkeadilan gender.
            </p>

          </div>

          {/* MISI */}
          <div className="bg-white border border-[#E5E7EB] rounded-[24px] sm:rounded-[32px] px-8 sm:px-12 py-10 sm:py-14 min-h-[300px] sm:min-h-[460px] shadow-[0_20px_60px_rgba(0,0,0,0.03)]">

            <h2 className="text-[28px] sm:text-[36px] lg:text-[40px] font-semibold text-gray-900 mb-6 sm:mb-8">
              Misi
            </h2>

            <p className="text-lg sm:text-xl lg:text-[24px] leading-[1.8] sm:leading-[1.9] text-gray-500">
              Membangun kesadaran kritis perempuan untuk mewujudkan kesetaraan dan keadilan gender. Penguatan SDM, Human Resource Development, dan pemberdayaan masyarakat.
            </p>

          </div>

        </div>

      </section>

      <TimelineSection />

      <ValueSection />

      {/* TAUTAN EKSKLUSIF KE HALAMAN KHUSUS STRUKTUR ORGANISASI */}
      <section className="px-4 sm:px-8 lg:px-20 pb-16 sm:pb-20 lg:pb-24">
        <div className="max-w-[1280px] mx-auto bg-white border border-[#E7E7E7] rounded-[28px] p-6 sm:p-10 flex flex-col md:flex-row items-center justify-between gap-6 shadow-[0_12px_32px_rgba(0,0,0,0.04)]">
          <div className="flex items-center gap-4">
            <div className="w-14 h-14 rounded-2xl bg-[#0F5E3A]/10 text-[#0F5E3A] flex items-center justify-center shrink-0 shadow-inner">
              <Users size={26} />
            </div>
            <div>
              <div className="inline-block px-3 py-0.5 rounded-full bg-[#0F5E3A]/10 text-[#0F5E3A] text-xs font-bold uppercase tracking-wider mb-1">
                Kepengurusan Cabang
              </div>
              <h3 className="text-xl sm:text-2xl font-bold text-gray-900">
                Struktur Organisasi PC Fatayat NU
              </h3>
              <p className="text-sm text-gray-500 mt-0.5 max-w-xl">
                Bagan susunan Penasihat & Pembina, Pengurus Harian (BPH), serta Bidang-Bidang teknis masa khidmat 2024 - 2029.
              </p>
            </div>
          </div>

          <Link
            to="/struktur-organisasi"
            className="shrink-0 px-6 py-3.5 bg-[#0F5E3A] hover:bg-[#0c4b2e] text-white rounded-xl text-sm font-bold transition shadow-[0_4px_14px_rgba(15,94,58,0.25)] flex items-center gap-2"
          >
            <span>Buka Halaman Struktur Organisasi</span>
            <ChevronRight size={16} />
          </Link>
        </div>
      </section>

      <Footer />

    </div>
  );
}

export default Tentang;