import { useState, useEffect } from "react";
import {
  Map,
  MapMarker,
  MarkerContent,
  MarkerLabel,
  MarkerPopup,
} from "@/components/ui/map";
import { Button } from "@/components/ui/button";
import { Navigation, Phone, Calendar, Mail } from "lucide-react";

// Koordinat kecamatan di Sukabumi
const kecamatanCoords = {
  "Cibadak": { lng: 106.7744, lat: -6.8920 },
  "Cicurug": { lng: 106.7864, lat: -6.7844 },
  "Parungkuda": { lng: 106.7725, lat: -6.8402 },
  "Palabuhanratu": { lng: 106.5514, lat: -6.9859 },
  "Simpenan": { lng: 106.5683, lat: -7.0315 },
  "Jampang Kulon": { lng: 106.6341, lat: -7.2917 },
  "Cisaat": { lng: 106.8967, lat: -6.9202 },
};

const getCoords = (kecamatan, index) => {
  if (!kecamatan) return { lng: 106.9266, lat: -6.9181 };
  
  const normalized = kecamatan.trim().toLowerCase();
  for (const name of Object.keys(kecamatanCoords)) {
    if (name.toLowerCase() === normalized) {
      return kecamatanCoords[name];
    }
  }
  
  // Tebar marker secara melingkar di sekitar pusat Sukabumi jika kecamatan baru
  const baseLng = 106.9266;
  const baseLat = -6.9181;
  const angle = (index * 0.95) % (2 * Math.PI);
  const radius = 0.05 + ((index * 0.02) % 0.08);
  return {
    lng: baseLng + radius * Math.cos(angle),
    lat: baseLat + radius * Math.sin(angle)
  };
};

export function PopupExample() {
  const [places, setPlaces] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch("/api/pac")
      .then((res) => {
        if (!res.ok) throw new Error("Gagal memuat PAC");
        return res.json();
      })
      .then((data) => {
        const mapped = data.map((pac, idx) => {
          const coords = getCoords(pac.kecamatan, idx);
          return {
            id: pac.id,
            name: pac.nama_pac,
            kecamatan: pac.kecamatan,
            status: pac.status,
            ketua: pac.ketua_pac,
            telepon: pac.telepon,
            email: pac.email,
            anggota: pac.jumlah_anggota,
            kegiatan: pac.total_kegiatan,
            sk: pac.nomor_sk,
            alamat: pac.alamat || `Kecamatan ${pac.kecamatan}`,
            lng: coords.lng,
            lat: coords.lat
          };
        });
        setPlaces(mapped);
        setLoading(false);
      })
      .catch((err) => {
        console.error(err);
        // Fallback local data
        const fallback = [
          { id: 1, name: "PAC Cibadak", kecamatan: "Cibadak", status: "aktif", ketua: "Hj. Laila Sari, S.Ag", telepon: "081234567890", anggota: 247, kegiatan: 18, sk: "SK-012/PC/FN/SKB/2024", alamat: "Jl. Raya Cibadak No. 123", lng: 106.7744, lat: -6.8920 },
          { id: 2, name: "PAC Cicurug", kecamatan: "Cicurug", status: "aktif", ketua: "Siti Maryam, S.Pd", telepon: "082345678901", anggota: 198, kegiatan: 15, sk: "SK-015/PC/FN/SKB/2024", alamat: "Jl. Siliwangi No. 45", lng: 106.7864, lat: -6.7844 },
          { id: 3, name: "PAC Parungkuda", kecamatan: "Parungkuda", status: "aktif", ketua: "Fatimah Azzahra, M.Pd", telepon: "083456789012", anggota: 156, kegiatan: 12, sk: "SK-022/PC/FN/SKB/2024", alamat: "Jl. Stasiun Parungkuda No. 10", lng: 106.7725, lat: -6.8402 },
          { id: 4, name: "PAC Palabuhanratu", kecamatan: "Palabuhanratu", status: "aktif", ketua: "Rina Herlina, S.Sos", telepon: "084567890123", anggota: 234, kegiatan: 20, sk: "SK-008/PC/FN/SKB/2024", alamat: "Jl. Siliwangi Palabuhanratu No. 8", lng: 106.5514, lat: -6.9859 },
          { id: 5, name: "PAC Simpenan", kecamatan: "Simpenan", status: "tidak_aktif", ketua: "Neneng Hasanah", telepon: "085678901234", anggota: 89, kegiatan: 3, sk: "SK-045/PC/FN/SKB/2024", alamat: "Kampung Cigaru No. 15", lng: 106.5683, lat: -7.0315 },
          { id: 6, name: "PAC Jampang Kulon", kecamatan: "Jampang Kulon", status: "aktif", ketua: "Aisyah Humaira, S.Si", telepon: "086789012345", anggota: 178, kegiatan: 14, sk: "SK-019/PC/FN/SKB/2024", alamat: "Jl. Jampang Kulon Raya No. 9", lng: 106.6341, lat: -7.2917 },
          { id: 7, name: "PAC Cisaat", kecamatan: "Cisaat", status: "aktif", ketua: "Dr. Hj. Salamah, M.Ag", telepon: "087890123456", anggota: 310, kegiatan: 25, sk: "SK-005/PC/FN/SKB/2024", alamat: "Jl. Kadudampit No. 34", lng: 106.8967, lat: -6.9202 }
        ];
        setPlaces(fallback);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <div className="flex items-center justify-center h-full text-gray-500">Memuat peta...</div>;
  }

  return (
    <div className="h-full w-full">
      <Map center={[106.9266, -6.9181]} zoom={10} theme="light">
        {places.map((place) => (
          <MapMarker key={place.id} longitude={place.lng} latitude={place.lat}>
            <MarkerContent>
              <div
                className={`size-6 cursor-pointer rounded-full border-2 border-white shadow-lg transition-transform hover:scale-110 flex items-center justify-center text-[10px] text-white font-bold ${
                  place.status === "aktif" ? "bg-[#1f7a4d]" : "bg-gray-400"
                }`}
              >
                💚
              </div>
              <MarkerLabel position="bottom" className="text-gray-800 font-semibold text-xs bg-white/90 px-2 py-0.5 rounded shadow-sm">
                {place.name}
              </MarkerLabel>
            </MarkerContent>
            
            <MarkerPopup className="w-72 p-0 rounded-2xl overflow-hidden shadow-2xl border border-gray-100">
              <div className="bg-[#1f7a4d] p-4 text-white">
                <p className="text-[10px] opacity-75 uppercase tracking-wider font-semibold">
                  Kecamatan {place.kecamatan}
                </p>
                <h3 className="text-lg font-bold leading-tight mt-0.5">
                  {place.name}
                </h3>
              </div>
              
              <div className="p-4 space-y-3.5 bg-white text-gray-600 text-sm">
                <div>
                  <p className="text-[11px] text-gray-400 font-medium">Ketua PAC</p>
                  <p className="font-semibold text-gray-800 mt-0.5">{place.ketua || "-"}</p>
                </div>

                {place.sk && (
                  <div>
                    <p className="text-[11px] text-gray-400 font-medium">Nomor SK</p>
                    <p className="font-mono text-xs text-gray-700 bg-gray-50 px-2 py-1 rounded border border-gray-100 mt-0.5 inline-block">
                      {place.sk}
                    </p>
                  </div>
                )}

                <div className="grid grid-cols-2 gap-2 text-center pt-2">
                  <div className="bg-gray-50 border border-gray-100 rounded-xl py-2">
                    <span className="block text-base font-bold text-gray-800">{place.anggota}</span>
                    <span className="text-[10px] text-gray-400">Anggota</span>
                  </div>
                  <div className="bg-gray-50 border border-gray-100 rounded-xl py-2">
                    <span className="block text-base font-bold text-gray-800">{place.kegiatan}</span>
                    <span className="text-[10px] text-gray-400">Kegiatan</span>
                  </div>
                </div>

                <div className="border-t border-gray-100 pt-3 flex flex-col gap-2">
                  <p className="text-xs text-gray-400 leading-normal flex items-start gap-1">
                    <span>📍</span>
                    <span>{place.alamat}</span>
                  </p>
                  
                  {place.telepon && (
                    <a
                      href={`https://wa.me/${place.telepon.replace(/[^0-9]/g, "")}`}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="mt-2 w-full h-[38px] bg-green-50 text-[#1f7a4d] border border-green-200 hover:bg-[#1f7a4d] hover:text-white rounded-xl text-xs font-semibold flex items-center justify-center gap-1.5 transition duration-200"
                    >
                      <Phone className="size-3.5" />
                      Hubungi Ketua
                    </a>
                  )}
                </div>
              </div>
            </MarkerPopup>
          </MapMarker>
        ))}
      </Map>
    </div>
  );
}
