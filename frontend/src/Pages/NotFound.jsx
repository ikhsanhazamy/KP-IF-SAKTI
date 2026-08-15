import { Link } from "react-router-dom";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";

function NotFound() {
  return (
    <div className="bg-[#f6f8f7] min-h-screen flex flex-col">
      <Navbar />

      <main className="flex-1 flex items-center justify-center px-4 py-20">
        <div className="text-center max-w-md">
          <div className="text-8xl font-bold text-[#1f7a4d]/20 mb-4 select-none">
            404
          </div>
          <h1 className="text-2xl sm:text-3xl font-semibold text-gray-900 mb-3">
            Halaman Tidak Ditemukan
          </h1>
          <p className="text-gray-500 mb-8 leading-relaxed text-sm sm:text-base">
            Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
          </p>
          <Link
            to="/"
            className="inline-flex items-center gap-2 bg-[#1f7a4d] hover:bg-[#17633f] text-white font-semibold px-6 py-3 rounded-2xl shadow-md hover:shadow-lg transition duration-200"
          >
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
              <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
              <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
            Kembali ke Beranda
          </Link>
        </div>
      </main>

      <Footer />
    </div>
  );
}

export default NotFound;
