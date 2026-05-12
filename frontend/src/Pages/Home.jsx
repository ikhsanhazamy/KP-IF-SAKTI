import Navbar from "../components/Navbar";
import Hero from "../components/Hero";
import Stats from "../components/Stats";
import MapSection from "../components/MapSection";
import MembershipSection from "../components/MembershipSection";
import PacSection from "../components/PacSection";
import KegiatanSection from "../components/KegiatanSection";
import TestimoniSection from "../components/TestimoniSection";
import Footer from "../components/Footer";

function Home() {
  return (
    <div className="bg-[#f6f8f7]">
      <Navbar />
      <Hero />
      <Stats />
      <MapSection />
      <MembershipSection/>
      <PacSection/>
      <KegiatanSection/>
      <TestimoniSection/>
      <Footer/>
    </div>
  );
}

export default Home;