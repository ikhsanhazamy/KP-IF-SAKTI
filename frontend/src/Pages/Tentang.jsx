import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import TimelineSection from "../components/TimelineSection";
import ValueSection from "../components/ValueSection";

function Tentang() {
  return (
    <div className="bg-[#f6f8f7] min-h-screen">

      <Navbar />

      <section className="px-20 py-24">

        {/* HEADER */}
        <div className="text-center mb-24">

          <h1 className="text-[56px] font-semibold text-gray-900">
            Tentang Fatayat NU Sukabumi
          </h1>

          <p className="text-[20px] text-gray-500 mt-5 max-w-3xl mx-auto leading-relaxed">
            Organisasi perempuan Nahdlatul Ulama yang berdedikasi untuk pemberdayaan perempuan dan pengembangan masyarakat
          </p>

        </div>

        {/* VISI MISI */}
        <div className="max-w-[1280px] mx-auto grid grid-cols-2 gap-10 items-stretch">

          {/* VISI */}
          <div
            className="rounded-[32px] px-12 py-14 text-white min-h-[460px] shadow-[0_20px_60px_rgba(0,0,0,0.08)]"
            style={{
              background:
                "linear-gradient(135deg, #0F5E3A 0%, #1A6741 7.14%, #237148 14.29%, #2C7B4F 21.43%, #358556 28.57%, #3E8F5D 35.71%, #469965 42.86%, #4FA36C 50%, #469965 57.14%, #3E8F5D 64.29%, #358556 71.43%, #2C7B4F 78.57%, #237148 85.71%, #1A6741 92.86%, #0F5E3A 100%)"
            }}
          >

            <h2 className="text-[40px] font-semibold mb-8">
              Visi
            </h2>

            <p className="text-[24px] leading-[1.9] text-white/90">
              Penghapusan segala bentuk kekerasan, ketidakadilan dan kemiskinan dalam masyarakat. Dengan mengembangkan wacana kehidupan sosial yang konstruktif, demokratis dan berkeadilan gender.
            </p>

          </div>

          {/* MISI */}
          <div className="bg-white border border-[#E5E7EB] rounded-[32px] px-12 py-14 min-h-[460px] shadow-[0_20px_60px_rgba(0,0,0,0.03)]">

            <h2 className="text-[40px] font-semibold text-gray-900 mb-8">
              Misi
            </h2>

            <p className="text-[24px] leading-[1.9] text-gray-500">
              Membangun kesadaran kritis perempuan untuk mewujudkan kesetaraan dan keadilan gender. Penguatan SDM, Human Resource Development, dan pemberdayaan masyarakat.
            </p>

          </div>

        </div>

      </section>

      <TimelineSection />

      <ValueSection />

      <Footer />

    </div>
  );
}

export default Tentang;