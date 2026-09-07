import { useEffect } from "react";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import StructureSection from "../components/StructureSection";

function StrukturOrganisasi() {
  useEffect(() => {
    window.scrollTo({ top: 0, behavior: "instant" });
  }, []);

  return (
    <div className="bg-[#F8FAF9] min-h-screen flex flex-col justify-between">
      <Navbar />

      <main className="flex-1">
        <StructureSection />
      </main>

      <Footer />
    </div>
  );
}

export default StrukturOrganisasi;
