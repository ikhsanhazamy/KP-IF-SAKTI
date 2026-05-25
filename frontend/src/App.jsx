import { BrowserRouter, Routes, Route } from "react-router-dom";

import Home from "./Pages/Home";
import Tentang from "./Pages/Tentang";
import Kegiatan from "./Pages/Kegiatan";

function App() {
  return (
    <BrowserRouter>

      <Routes>

        <Route path="/" element={<Home />} />

        <Route path="/tentang" element={<Tentang />} />

        <Route path="/kegiatan" element={<Kegiatan />} />

      </Routes>

    </BrowserRouter>
  );
}

export default App;