import { lazy, Suspense } from "react";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import ScrollToTop from "./components/ScrollToTop";

// Code-split all page components for smaller initial bundle
const Home = lazy(() => import("./Pages/Home"));
const Tentang = lazy(() => import("./Pages/Tentang"));
const Kegiatan = lazy(() => import("./Pages/Kegiatan"));
const KegiatanDetail = lazy(() => import("./Pages/KegiatanDetail"));
const DataPAC = lazy(() => import("./Pages/DataPAC"));
const PengajuanPAC = lazy(() => import("./Pages/PengajuanPAC"));
const NotFound = lazy(() => import("./Pages/NotFound"));

function LoadingFallback() {
  return (
    <div className="min-h-screen bg-[#f6f8f7] flex items-center justify-center">
      <div className="flex flex-col items-center gap-3">
        <div className="w-8 h-8 border-3 border-[#1f7a4d]/20 border-t-[#1f7a4d] rounded-full animate-spin" />
        <p className="text-gray-400 text-sm font-medium">Memuat...</p>
      </div>
    </div>
  );
}

function App() {
  return (
    <BrowserRouter>
      <ScrollToTop />

      <Suspense fallback={<LoadingFallback />}>
        <Routes>

          <Route path="/" element={<Home />} />

          <Route path="/tentang" element={<Tentang />} />

          <Route path="/kegiatan" element={<Kegiatan />} />

          <Route path="/kegiatan/:id" element={<KegiatanDetail />} />

          <Route path="/data-pac" element={<DataPAC />} />

          <Route path="/pengajuan-data-pac" element={<PengajuanPAC />} />

          <Route path="*" element={<NotFound />} />

        </Routes>
      </Suspense>

    </BrowserRouter>
  );
}

export default App;