import { BrowserRouter, Routes, Route } from "react-router-dom";

import Home from "./Pages/Home";
import Tentang from "./Pages/Tentang";
import Kegiatan from "./Pages/Kegiatan";
import DataPAC from "./Pages/DataPAC";
import PengajuanPAC from "./Pages/PengajuanPAC";

function App() {
  return (
    <BrowserRouter>

      <Routes>

        <Route path="/" element={<Home />} />

        <Route path="/tentang" element={<Tentang />} />

        <Route path="/kegiatan" element={<Kegiatan />} />

        <Route path="/data-pac" element={<DataPAC />} />

        <Route path="/pengajuan-data-pac" element={<PengajuanPAC />} />

      </Routes>

    </BrowserRouter>
  );
}

export default App;